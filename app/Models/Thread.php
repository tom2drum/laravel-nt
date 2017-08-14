<?php

namespace App\Models;

use App\Http\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['creator', 'channel'];

    /*
     * Global scopes
     */
    public static function boot () {
        parent::boot();

        //  when we delete a thread, all associated replies should be deleted as well
        static::deleting(function ($thread) {
            $thread->replies->each->delete();   //  instead of each function
        });
    }

    /*
     * Methods
     */
    public function path () {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function addReply ($reply) {
        return $this->replies()->create($reply);
    }

    /*
     * Scopes
     */

    public function scopeFilter ($query, $filters) {
        return $filters->apply($query);
    }


    /*
     * Relationships
     */

    public function replies () {
        return $this->hasMany('App\Models\Reply');
    }

    public function creator () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function channel () {
        return $this->belongsTo('App\Models\Channel');
    }


}
