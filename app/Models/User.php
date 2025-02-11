<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'id_museum',
    ];



    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = $value;

        if ($value === 'museum') {
            // Ambil id_museum terakhir lalu tambahkan 1
            $lastId = DB::table('users')->where('role', 'museum')->max('id_museum');
            $this->attributes['id_museum'] = str_pad(($lastId + 1), 2, '0', STR_PAD_LEFT);
        } else {
            // Jika bukan museum, id_museum dihapus
            $this->attributes['id_museum'] = null;
        }
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
