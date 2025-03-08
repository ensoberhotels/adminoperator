<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Voucher extends Model
{ 
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reservation_no', 'hotel_name', 'hotel_logo', 'hotel_address', 'agent_name', 'confirmed_by', 'client_name', 'check_in', 'check_out', 'check_out', 'no_of_pax', 'kids', 'no_of_room', 'room_type', 'package', 'cost', 'advance_received', 'date'
    ];

    /**
     * difine table name
     */
    protected $table = 'hotel_vouchers';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ceated_at', 'updated_at'
    ];
}
