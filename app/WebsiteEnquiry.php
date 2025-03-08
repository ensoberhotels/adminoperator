<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class WebsiteEnquiry extends Model 
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'mobile', 'message',
    ];

    /**
     * difine table name
     */
    protected $table = 'website_enquiries';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];

    public function getUser(){
		return $this->belongsTo('App\APIUser', 'create_by');
	}
	
}
