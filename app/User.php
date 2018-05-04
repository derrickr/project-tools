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
        'first_name', 'last_name', 'email', 'password', 'role', 'last_visit','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function actions(){
        return $this->hasMany(Actions::class,'owner','email');
	}
		
    public function requests(){
        return $this->hasMany(Requests::class,'requester','email');
    }
    
    public function display_name(){
        return $this->first_name.' '.$this->last_name;
    }
        
    public function roles($flag = true) {
        if ($flag) {
            return explode(',', $this->role);
        }
        return $this->role;
    }

    public function isRole($string) {
        if ($string) {
            if (in_array($string, $this->roles())) {
                return true;
            }
        }
        return false;
    }
    public function isRoleIn($roles) {
        foreach($roles as $role){
            if($this->isRole($role))
                return true;
        }
        return false;
    }
    
    public function setRoleAttribute($value) {
        $this->attributes['role'] = $value;
        if (is_array($value)) {
            $this->attributes['role'] = implode(',', $value);
        }
        return;
    }
    
    public function scopeOfRole($query ,$roles = [])
    {
        
        foreach($roles as $role){
            $query = $query->orWhere('role', 'like','%'.$role.'%');
        }
        return $query;
    }
}
