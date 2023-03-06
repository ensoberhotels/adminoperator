<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CompanyPrivilage extends Model
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
    protected $table = 'sua_company_privileges';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    public function getCompany(){
        return $this->hasOne('App\CompanyMaster','id','company_id');
    }
	public function getModule(){
        return $this->hasOne('App\ModuleMaster','id','module_id');
    }
}
