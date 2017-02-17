<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;
use App\Role;
class User extends Authenticatable
{
    public function roles()
    {
        return $this->belongsToMany(\App\Role::class);
    }
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
   
    public function hasPermission(Permission $permission){
         return $this->hasAnyRoles($permission->roles);
    }
    public function hasAnyRoles($roles){
        if (is_array($roles) || is_object($roles)) {
            foreach ($roles as $role) {
                return $this->roles->contains('nome', $role->nome);
            }
        }
        return $this->roles->contains('nome', $roles);
    }

}
