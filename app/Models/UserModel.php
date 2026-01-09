<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserModel extends Authenticatable // 2. Ubah extends Model menjadi Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
        'avatar', // <--- Tambahkan ini
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['password']; // Jangan tampilkan password saat select

    protected $casts = ['password' => 'hashed']; // Casting password agar otomatis di-hash

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    public function getRole()
    {
        return $this->level->level_kode;
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn($avatar) => $avatar ? asset('storage/photos/' . $avatar) : asset('adminlte/dist/img/user2-160x160.jpg'),
        );
    }
}