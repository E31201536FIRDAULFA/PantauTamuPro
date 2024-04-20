<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Profile::all();
        return view ('view.profile', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Profile::create($request->all());

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return redirect()->route('profile.index')->with('success', 'Data berhasil disimpan!');
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
        $profile = Profile::findOrFail($id);

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::findOrFail($id);

        $profile->update($request->all());

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return redirect()->route('profile.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cetak(){
        $profile = Profile::all();
        return view ('rekap.cetak-profile', compact('profile'));
    }
}
