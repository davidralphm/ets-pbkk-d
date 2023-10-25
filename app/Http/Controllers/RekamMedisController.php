<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekam_medis = RekamMedis::all();

        return view('rekammedis.index', ['rekam_medis' => $rekam_medis]);
    }

    // Rekam medis untuk pasien atau dokter
    public function my() {
        // Cek tipe user
        $user = Auth::user();

        if ($user->role == 'pasien') {
            $rekam_medis = RekamMedis::where('pasien_id', '=', $user->id)->get();
        } else {
            $rekam_medis = RekamMedis::where('dokter_id', '=', $user->id)->get();
        }

        return view('rekammedis.index', ['rekam_medis' => $rekam_medis]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = User::where('role', '=', 'pasien')->get();
        $dokter = User::where('role', '=', 'dokter')->get();

        return view('rekammedis.create', ['pasien' => $pasien, 'dokter' => $dokter]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'kondisi_kesehatan' => 'required',
            'suhu_tubuh' => 'required|decimal:0,1|between:35,45.5',
            'file' => 'required|mimes:pdf,png,jpg,jpeg',
        ], [
            'pasien_id.required' => 'Harap memilih nama pasien.',
            'dokter_id.required' => 'Harap memilih nama dokter.',
            'kondisi_kesehatan.required' => 'Harap mengisi kondisi kesehatan pasien.',
            'suhu_tubuh.required' => 'Harap mengisi suhu tubuh pasien.',
            'suhu_tubuh.decimal' => 'Suhu tubuh pasien harus berupa angka desimal.',
            'suhu_tubuh.between' => 'Suhu tubuh pasien harus berada di antara 35 - 45.5 C.',
            'file.required' => 'Harap mengupload file / gambar resep.',
            'file.mimes' => 'Format yang diperbolehkan hanya PDF, JPG, JPEG, dan PNG.',
        ]);

        // Upload file resep
        $file_name = time() . '.' . $request['file']->extension();
        $request['file']->move(public_path('storage'), $file_name);

        $rekam_medis = new RekamMedis;
        
        $rekam_medis->pasien_id = $validatedData['pasien_id'];
        $rekam_medis->dokter_id = $validatedData['dokter_id'];
        $rekam_medis->kondisi_kesehatan = $validatedData['kondisi_kesehatan'];
        $rekam_medis->suhu_tubuh = $validatedData['suhu_tubuh'];
        $rekam_medis->url_resep = $file_name;

        $rekam_medis->save();

        Session::flash('message-success', 'Rekam medis berhasil dibuat.');

        return Redirect::to('/rekamMedis');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $rekam_medis = RekamMedis::find($id);

        if ($rekam_medis === null) {
            Session::flash('message-error', 'Rekam medis dengan ID ' . $id . ' tidak ditemukan.');

            return redirect('/rekamMedis');
        }

        return view('rekammedis.show', ['rekam_medis' => $rekam_medis]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $rekam_medis = RekamMedis::find($id);

        if ($rekam_medis === null) {
            Session::flash('message-error', 'Rekam medis dengan ID ' . $id . ' tidak ditemukan.');

            return redirect('/rekamMedis');
        }

        $pasien = User::where('role', '=', 'pasien')->get();
        $dokter = User::where('role', '=', 'dokter')->get();

        return view('rekammedis.edit', ['rekam_medis' => $rekam_medis, 'pasien' => $pasien, 'dokter' => $dokter]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $rekam_medis = RekamMedis::find($id);

        if ($rekam_medis === null) {
            Session::flash('message-error', 'Rekam medis dengan ID ' . $id . ' tidak ditemukan.');

            return redirect('/rekamMedis');
        }

        $validatedData = $request->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'kondisi_kesehatan' => 'required',
            'suhu_tubuh' => 'required|decimal:0,1|between:35,45.5',
            'file' => 'nullable|mimes:pdf,png,jpg,jpeg',
        ], [
            'pasien_id.required' => 'Harap memilih nama pasien.',
            'dokter_id.required' => 'Harap memilih nama dokter.',
            'kondisi_kesehatan.required' => 'Harap mengisi kondisi kesehatan pasien.',
            'suhu_tubuh.required' => 'Harap mengisi suhu tubuh pasien.',
            'suhu_tubuh.decimal' => 'Suhu tubuh pasien harus berupa angka desimal.',
            'suhu_tubuh.between' => 'Suhu tubuh pasien harus berada di antara 35 - 45.5 C.',
            'file.mimes' => 'Format yang diperbolehkan hanya PDF, JPG, JPEG, dan PNG.',
        ]);

        $rekam_medis->pasien_id = $validatedData['pasien_id'];
        $rekam_medis->dokter_id = $validatedData['dokter_id'];
        $rekam_medis->kondisi_kesehatan = $validatedData['kondisi_kesehatan'];
        $rekam_medis->suhu_tubuh = $validatedData['suhu_tubuh'];

        // Jika file resep diubah
        if (!empty($request->file)) {
            // Upload file baru
            $file_name = time() . '.' . $request['file']->extension();
            $request['file']->move(public_path('storage'), $file_name);
            
            // Hapus file lama
            unlink(public_path('storage/') . $rekam_medis->url_resep);

            // Ubah URL
            $rekam_medis->url_resep = $file_name;
        }

        $rekam_medis->save();

        Session::flash('message-success', 'Perubahan berhasil disimpan.');

        return Redirect::to('/rekamMedis');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $rekam_medis = RekamMedis::find($id);

        if ($rekam_medis === null) {
            Session::flash('message-error', 'Rekam medis dengan ID ' . $id . ' tidak ditemukan.');

            return redirect('/rekamMedis');
        }

        // Hapus file resep
        unlink(public_path('storage/') . $rekam_medis->url_resep);

        // Hapus rekam medis dari database
        $rekam_medis->delete();

        Session::flash('message-success', 'Rekam medis berhasil dihapus.');

        return Redirect::to('/rekamMedis');
    }
}
