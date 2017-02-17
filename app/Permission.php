<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	public function roles(){
		return $this->belongsToMany(\App\Role::class);
	}
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $guarded = array('id');
}
