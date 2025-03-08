<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class MenuMaster extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'user', 'password',
    // ];
    protected $table = 'sua_menu_masters';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    function childs() {
        return $this->hasMany('App\MenuMaster','parent_menu_id','id')->where('menu_flag','Y');
    }
    function sub_childs() {
        return $this->hasMany('App\MenuMaster','parent_menu_id','id')->where('menu_flag','Y');
    }
	
}
