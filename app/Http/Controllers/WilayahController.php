<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;

class WilayahController extends Controller
{
    public function provinsi(){
        $data = [
            'data' => Provinsi::all(),
        ];
        return response()->json($data);
    }
    public function kabupaten(){
        $data = [
            'data' => Kabupaten::where('province_code', request()->provinsi_id)->get(),
        ];
        return response()->json($data);
    }
    public function kecamatan(){
        $data = [
            'data' => Kecamatan::where('city_code', request()->kabupaten_id)->get(),
        ];
        return response()->json($data);
    }
    public function desa(){
        $data = [
            'data' => Desa::where('district_code', request()->kecamatan_id)->get(),
        ];
        return response()->json($data);
    }
}
