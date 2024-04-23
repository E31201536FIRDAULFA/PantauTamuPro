<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeedbackExport;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $feedback = Feedback::all();
            return view ('view.feedback', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'keterangan' => 'required',
        ]);

        Feedback::create($validatedData);

        // $feedback = new Feedback();
        // $feedback->keterangan = $request->input('feedback');
        // $feedback->save();

        return redirect()->back()->with('success', 'Masukan berhasil disimpan.');
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
        $feedbacks = Feedback::findOrFail($id);

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return view('feedback.edit', compact('feedbacks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feedbacks = Feedback::findOrFail($id);

        $feedbacks->update($request->all());

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return redirect()->route('feedback.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetak(){
        $feedbacks = Feedback::all();
        return view ('rekap.cetak-feedback', compact('feedbacks'));
    }

    public function xlsx()
    {
        return Excel::download(new FeedbackExport, 'feedback.xlsx');
    }
}
