<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

        protected $fillable = [
        'template_id', 
        'nomor_surat',
        'nama_pengirim', 
        'jabatan_pengirim',
        'nama_acara', 
        'tempat_acara', 
        'tanggal_acara',
        'tujuan_undangan', 
        'jabatan_penerima',
        'instansi_penerima',
        'agenda_rapat',
        'dresscode',
        'pesan_tambahan',
        'nama_user', 
        'email_user',
        'topik_acara',
        'link_dokumen'
    ];

    protected $casts = [
        'tanggal_acara' => 'datetime',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}