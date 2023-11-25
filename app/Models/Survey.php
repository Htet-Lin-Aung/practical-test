<?php

namespace App\Models;

use App\Events\SurveyCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id','code','answer'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}