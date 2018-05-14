<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    //
    protected $fillable = ['name','description'];

    public function permissions(){
        return $this->belongsToMany('\App\AdminPermission','admin_permission_role','role_id','permission_id');
    }

    public function grantPermission($permissions){
        return $this->permissions()->attach($permissions);
    }

    public function deletePermission($permissions){
        return $this->permissions()->detach();
    }
}
