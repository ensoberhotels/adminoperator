<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grievance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','description','attachment','from_id','from_name'
        ];

        /**
     * difine table name
     */
    protected $table = 'grievance';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
