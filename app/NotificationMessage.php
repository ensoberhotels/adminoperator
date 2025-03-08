<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class NotificationMessage extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'message', 'type', 'event', 'status'
    ];

    /**
     * difine table name 
     */
    protected $table = 'notification_messages';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
}
