<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PaymentSource extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable. 
     *
     * @var array
     */
    protected $fillable = [
        'hotel_id', 'source', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'payment_sources';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
	
	public function hotel(){
		return $this->belongsTo('App\Hotel');
	}
}
