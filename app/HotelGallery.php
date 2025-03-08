<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class HotelGallery extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotel_id', 'image', 'caption', 'status'
    ];

    /**
     * difine table name
     */
    protected $table = 'hotel_gallerys';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'ceated_at', 'updated_at'
    ];
}
