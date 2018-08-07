<?php
/**
 * Created by PhpStorm.
 * Auth: nathanael79
 * Date: 23/07/18
 * Time: 14:20
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    protected $table = 'event_participant';
    public $timestamps = false;
    protected $fillable =
        [
            'event_id',
            'user_id',
            'payment_status',
            'attendance',
            'date_created',
        ];

    public function getUserId()
    {
        return $this->hasOne('App\Models\User','user_id','user_id');
    }

    public function getEventId()
    {
        return $this->hasOne('App\Models\Event','event_id','event_id');
    }



}