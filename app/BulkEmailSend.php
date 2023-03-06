<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class BulkEmailSend extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','title', 'email_template_id', 'email_campaign_id', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'bulk_email_sends';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function EmailCampaign(){
        return $this->belongsTo('App\EmailCampaign', 'email_campaign_id');
    }
	
	public function EmailTemplat(){
        return $this->belongsTo('App\EmailTemplat', 'email_template_id');
    }
	
	public function BulkEmailSendReport(){ 
		return $this->hasMany('App\BulkEmailSendReport','bulk_email_send_id')->join('contacts', 'bulk_email_send_reports.contact_id', '=', 'contacts.id');
	}
}
