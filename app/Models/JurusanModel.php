<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'jurusan_kode',
        'jurusan_nama',
        'kampus_id'
    ];

    public function kampus()
    {
        return $this->belongsTo(KampusModel::class, 'kampus_id');
    }
}
