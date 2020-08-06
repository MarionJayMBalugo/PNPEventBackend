<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Events extends Model {

    /**
     * attribute that identifies the database table
     * @var string
     */
    protected $table = 'events';

    /**
     * attribute that is mass assignable
     * @var array
     */
    protected $fillable = [
        "users_id",
        "event_name",
        "host",
        "event_date",
    ];

    /**
     * function that defines the one to many relationship between Users and Events Model
     * @return App\Models\User
     */
    public function user() {
        return $this->belongsTo( 'App\Models\User');
    }

    /**
     * function that retrieve list of events from events table.
     * @param int $user_id
     * @return array
     */
    protected function getEventsList( $user_id) {
        $user = User::find( $user_id);
        return $user->events()->get();
    }

    /**
     * function that inserts event to events table.
     * @param string $data
     * @param int $user_id
     * @return bool
     */
    protected function addEvents( $data, $user_id) {
        $user = User::find( $user_id);
        return $user->events()->save( new Events( $data));
    }

    /**
     * function that updates an event from events table.
     * @param string $data
     * @param int $user_id
     * @param int $event_id
     * @return array
     */
    protected function updateEvent( $data, $user_id, $event_id) {
        $user = User::findorFail( $user_id);
        $event = $user->events()->findorFail( $event_id);
        $event->event_name = $data[ "event_name"];
        $event->host = $data[ "host"];
        $event->event_date = $data[ "event_date"];
        $event->save();
        return $event->refresh();
    }

    /**
     * function that delete an event from database table.
     * @return bool
     */
    public function deleteEvent(){
        return $this->delete();
    }
}
