<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class BulkEmailSendReport extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','bulk_email_send_id', 'email_template_id', 'email_campaign_id', 'contact_id', 'send_date_time', 'send_status','company_id','property_id','user_id'
    ];

    /**
     * difine table name
     */
    protected $table = 'bulk_email_send_reports';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
}
