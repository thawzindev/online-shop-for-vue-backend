<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name', 'email', 'phone', 'role', 'password', 'address', 'apartment', 'township'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $hidden = [
        'password', 'remember_token',
    ];

    public function isSuperAdmin()
    {
        return $this->role == '1' ? true : false;
    }

    public function isUser() 
    {
        return $this->role == '99' ? true : false;    
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

    /**
     * Query scope.
     */
    public function scopeFilter($query, $filter) 
    {
        $filter->apply($query);    
    }

}
