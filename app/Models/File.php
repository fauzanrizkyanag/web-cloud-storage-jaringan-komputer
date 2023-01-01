<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'nama_file', 'nama_file_asli', 'tipe_file', 'ukuran_file'];
}
