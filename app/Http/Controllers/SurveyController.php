<?php

namespace App\Http\Controllers;

use App\Events\SurveyCreated;
use App\Exceptions\WebExceptionHandler;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\User;
use App\Http\Requests\V1\SurveyRequest;
use App\Listeners\SendSurveyCreatedNotifications;

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

            event(new SurveyCreated($user));
        
            return redirect()->route('home')->with('Thank you for your answer.');
        } catch (\Exception $e) {
            throw new WebExceptionHandler($e->getMessage());  
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
