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
        $surveys = Survey::orderBy('created_at', 'desc')->paginate(5);
        return view ('view.questions', compact('surveys'));
    }

    public function create()
    {
        return view('survey.create');
    }

    public function store(Request $request)
    {
        Survey::create($request->all());

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return redirect()->route('survey.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $id)
    {
        $survey = Survey::findOrFail($id);

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return view('survey.edit', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $survey = Survey::findOrFail($id);

        $survey->update($request->all());

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
