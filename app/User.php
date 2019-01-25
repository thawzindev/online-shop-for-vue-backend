<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'role', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isSuperAdmin()
    {
        return $this->role == '1' ? true : false;
    }

    /**
     * Helper methods.
     */
    public function label() 
    {
        if ($this->role == '1') return 'danger';
        if ($this->role == '2') return 'success';
        if ($this->role == '99') return 'info';
    }

    public function roleName() 
    {
        return collect(config('form.roles'))->firstWhere('value', $this->role)['name'];
    }

}
