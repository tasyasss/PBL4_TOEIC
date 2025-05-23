<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'username',
        'password',
        'roles_id'
    ];

    public function roles()
    {
        return $this->belongsTo(RolesModel::class, 'roles_id');
    }

    // mendapatkan nama role
    public function getRolesName(): string
    {
        return $this->roles->roles_nama;
    }

    // cek apakah user memiliki role tertentu
    public function hasRoles($roles): bool
    {
        return $this->roles->roles_kode == $roles;
    }

    // mendapatkan kode role
    public function getRoles(): string
    {
        return $this->roles->roles_kode;
    }
}
