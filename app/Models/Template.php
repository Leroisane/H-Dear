<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_template',
        'deskripsi',
        'html_content',
        'thumbnail',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function undangans()
    {
        return $this->hasMany(Undangan::class);
    }
}