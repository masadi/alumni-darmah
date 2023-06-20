<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alumni extends Model
{
    use HasFactory;
    protected $table = 'alumni';
	protected $guarded = [];
    protected $appends = ['tanggal_lahir_str'];
    public function getTanggalLahirStrAttribute()
	{
		return (isset($this->attributes['tanggal_lahir'])) ? Carbon::parse($this->attributes['tanggal_lahir'])->translatedFormat('d F Y') : '';
	}
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'code');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'code');
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'code');
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'code');
    }
}
