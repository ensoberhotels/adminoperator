<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_campaign_id', 'contact_id', 'co_name','co_email','co_mobile', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'email_lists';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
    
    
}
