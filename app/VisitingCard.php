<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class VisitingCard extends Model 
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'raw_text','mobile', 'email', 'name', 'card'
    ];

    /**
     * difine table name
     */
    protected $table = 'visiting_cards';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
}
