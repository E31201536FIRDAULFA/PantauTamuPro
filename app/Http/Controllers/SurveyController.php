<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SurveyExport;

class SurveyController extends Controller
{
    public function index()
    {
        $survey = Survey::all();
        return view ('view.questions', compact('survey'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        Survey::create($request->all());

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return redirect()->route('survey.index')->with('success', 'Data berhasil disimpan!');
    }

    public function cetak(){
        $survey = Survey::all();
        return view ('rekap.cetak-survey', compact('survey'));
    }

    public function xlsx()
    {
        return Excel::download(new SurveyExport, 'survey_questions.xlsx');
    }
}
