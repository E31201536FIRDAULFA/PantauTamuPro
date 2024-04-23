<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProfileExport;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::orderBy('created_at', 'desc')->paginate(10);
        return view ('view.profile', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profiles.create');
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
        $profiles = Profile::findOrFail($id);

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return view('profile.edit', compact('profiles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profiles = Profile::findOrFail($id);

        $profiles->update($request->all());

        // Redirect atau kembali ke halaman sebelumnya dengan notifikasi
        return redirect()->route('profile.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profiles = Profile::findOrFail($id);
        $profiles->delete();
    
        return redirect()->route('profile.index')->with('success', 'Profil berhasil dihapus!');
    }

    public function cetak(){
        $profiles = Profile::all();
        return view ('rekap.cetak-profile', compact('profiles'));
    }

    public function xlsx()
    {
        return Excel::download(new ProfileExport, 'profile.xlsx');
    }
}
