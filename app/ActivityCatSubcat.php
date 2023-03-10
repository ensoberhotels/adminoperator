
<?php

namespace App;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Model;

class ActivityCatSubcat extends Model
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id','activity_cat', 'activity_subcat'
    ];

    /**
     * difine table name
     */
    protected $table = 'activity_cat_subcat';
}
