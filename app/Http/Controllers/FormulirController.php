<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Survey;

class FormulirController extends Controller
{
    public function index(){
        return view ('auth.formulir');
    }

    public function daftar(){
        $visitors = Visitor::all();
        return view ('view.daftar', compact('visitors'));
    }

    public function survey(){
        $survey = Survey::all();
        return view ('view.survey', compact('survey'));
    }

    // public function submitForm(Request $request) {
    //     // // Mengambil nilai rating dari formulir
    //     // $rating = $request->input('rating');
        
    //     // // Menambahkan nilai rating ke dalam database
    //     // // Misalnya, jika Anda menggunakan model Survey
    //     // $survey = Survey::find($request->input('survey_id')); // Ganti 'survey_id' dengan nama atribut yang sesuai dengan id survey di formulir
    //     // $survey->{$rating} += 1; // Menambahkan nilai ke dalam kolom yang sesuai
    //     // $survey->save();
        
    //     // // Redirect atau tindakan lain setelah formulir disubmit
    //     // return redirect()->back()->with('success', 'Formulir telah disubmit.');
    // }

    public function storeForm(Request $request)
    {
         // Validasi reCAPTCHA token
        //  $validator = Validator::make($request->all(), [
        //     'g-recaptcha-response' => 'required|recaptcha',
        //     // Tambahkan aturan validasi lainnya di sini
        // ]);

        // if ($validator->fails()) {
        //     // Redirect kembali ke halaman formulir dengan pesan kesalahan
        //     return redirect('/form')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            'asal_instansi' => 'required',
            'no_hp' => 'required',
            'tanggal' => 'required',
        ]);

        Visitor::create($validatedData);

        return redirect('/daftar')->with('success', 'Formulir telah berhasil disimpan.');
    }
}
