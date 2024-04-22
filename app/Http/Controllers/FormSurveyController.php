<?php

namespace App\Http\Controllers;
use App\Models\Survey;
use Illuminate\Http\Request;

class FormSurveyController extends Controller
{
    public function index()
    {
        $survey = Survey::all();
        return view ('view.survey', compact('survey'));
    }
}
