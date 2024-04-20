<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

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
        $visitors = Visitor::all();
        return view ('view.survey', compact('visitors'));
    }

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
