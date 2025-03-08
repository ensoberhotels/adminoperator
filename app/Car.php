<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_name', 'car_image', 'seat','car_segment_id','car_model_id','car_seats_id', 'car_type', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'cars';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
    
    public function car_segment(){
        return $this->belongsTo('App\CarSegment');
    }
    
    public function car_model(){
        return $this->belongsTo('App\CarModel');
    }
    
    public function car_seats(){
        return $this->belongsTo('App\CarSeats');
    }
}
