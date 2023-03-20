<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptFilePrivilage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',	'admin_id', 	'module_id',	'menu_id',	'company_id',	'operator_id',	'create_by'
    ];	

    /**
     * difine table name
     */
    protected $table = 'opt_file_privilage';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 
    ];
}
