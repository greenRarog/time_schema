<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Worktime;
use App\Models\InfoPage;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function worktimes()
    {
        return $this->hasMany(Worktime::class, 'admin_id');
    }

    public function infoPage()
    {
        return $this->belongsTo(InfoPage::class, 'id', 'admin_id');
    }

    public function getIsAdminAttribute()
    {
        if ("{$this->role}" == 'admin') {
            return true;
        }
        return false;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'admin_user', 'admin_id', 'user_id');
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'admin_user', 'user_id', 'admin_id');
    }
}
