<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;

class AlumniController extends Controller
{
    public function index(){
        $data = Alumni::with('desa', 'kecamatan', 'kabupaten', 'provinsi')->orderBy(request()->sortby, request()->sortbydesc)
        ->when(request()->q, function($query) {
            $query->where('nama', 'ILIKE', '%' . request()->q . '%');
            $query->orWhere('nik', 'ILIKE', '%' . request()->q . '%');
            $query->orWhere('hp', 'ILIKE', '%' . request()->q . '%');
        })->paginate(request()->per_page);
        return response()->json(['status' => 'success', 'data' => $data]);
    }
    public function register(){
        request()->validate(
            [
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nik' => 'required|unique:alumni|digits:16',
                'hp' => 'required',
                'alamat' => 'required',
                'provinsi_id' => 'required',
                'kabupaten_id' => 'required',
                'kecamatan_id' => 'required',
                'desa_id' => 'required',
                'tahun_masuk' => 'required',
            ],
            [
                'nama.required' => 'Nama Lengkap tidak boleh kosong!',
                'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong!',
                'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong!',
                'nik.required' => 'NIK tidak boleh kosong!',
                'nik.unique' => 'NIK sudah terdaftar!',
                'nik.digits' => 'NIK harus 16 digit!',
                'hp.required' => 'Nomor HP tidak boleh kosong!',
                'alamat.required' => 'Alamat tidak boleh kosong!',
                'provinsi_id.required' => 'Provinsi tidak boleh kosong!',
                'kabupaten_id.required' => 'Kabupaten/Kota tidak boleh kosong!',
                'kecamatan_id.required' => 'Kecamatan tidak boleh kosong!',
                'desa_id.required' => 'Desa/Kelurahan tidak boleh kosong!',
                'tahun_masuk.required' => 'Tahun Masuk tidak boleh kosong!',
            ]
        );
        Alumni::create(request()->all());
        $data = [
            'errors' => NULL,
            'success' => TRUE,
            'request' => request()->all(),
        ];
        return response()->json($data);
    }
}
