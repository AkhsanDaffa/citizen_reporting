<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Tambahkan list kolom yang BOLEH diisi oleh user/controller
    protected $fillable = [
        'reporter_name',
        'title',
        'description',
        'image_path',
        'status',
        'admin_response'
    ];
}
