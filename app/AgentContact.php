<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AgentContact extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'send_quotation_no', 'name', 'email', 'mobile'
    ];

    /**
     * difine table name
     */
    protected $table = 'agent_contacts';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
}
