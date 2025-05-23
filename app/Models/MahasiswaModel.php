<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'users_id',
        'mahasiswa_nim',
        'mahasiswa_nama',
        'alamat',
        'no_telp',
        'email',
        'file_ktm',
        'file_ktp',
        'file_pas_foto',
        'prodi_id'
    ];

    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'users_id');
    }

    public function prodi()
    {
        return $this->belongsTo(ProdiModel::class, 'prodi_id');
    }
}
