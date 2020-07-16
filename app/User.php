<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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

    // relation with car assign 

    public function car_assign()
    {
        return $this->hasMany('App\CarAssign');
    }

    // relation with project claim 

    public function project_claim()
    {
        return $this->hasMany('App\ProjectClaim');
    }

    // relation with employee 

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    // relation with role 

    public function role()
    {
        return $this->belongsTo('App\Role')->withDefault([
            'id' => 0,
            'role_name' => 'N/A'
        ]);
    }
}
