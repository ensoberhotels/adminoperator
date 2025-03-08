<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CarSeats extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seats', 'car_model_id', 'car_segment_id'
        ];

    /**
     * difine table name
     */
    protected $table = 'car_seats';

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
}
