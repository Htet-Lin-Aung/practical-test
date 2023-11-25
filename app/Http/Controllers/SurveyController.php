<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Events\SurveyCreated;
use Illuminate\Support\Facades\DB;
use App\Exceptions\WebExceptionHandler;
use App\Http\Requests\V1\SurveyRequest;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $forms = Form::with('fields')->paginate(10);

        return view('welcome',compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Form $form)
    {
        return view('survey_form',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyRequest $request, Form $form)
    {        
        try{
            DB::beginTransaction();

            $user = User::create([
                'name' => 'Survey User',
                'email' => $request->email,
                'password' => bcrypt('password')
            ]);

            $data = collect($request->except('email'))->map(function ($value, $key) {
                return [
                    'code' => $key,
                    'answer' => $value,
                ];
            })->all();            

            $form->surveys()->createMany($data);

            DB::commit();

            event(new SurveyCreated($user));
        
            return redirect()->route('home')->with('Thank you for your answer.');
        } catch (\Exception $e) {
            DB::rollback();

            throw new WebExceptionHandler($e->getMessage());  
        }
    }
}
