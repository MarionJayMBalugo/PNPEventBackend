<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, Notifiable;

    /**
     * The attribute that identifies the database table.
     *
     * @var string
     */
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The function for has many relationship between User model and Events model.
     *
     * @return App\Models\Events\Events
     */
    public function events() {
        return $this->hasMany( 'App\Models\Events\Events');
    }
    
     /**
     * The function that inserts data to users table.
     *
     * @param string $data
     * @return boolean
     */
    protected function register( $data) {
        $data[ 'password'] = bcrypt($data[ 'password']);
        return $this->create($data);
    }
    
}
