<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class GroupMember extends Model
{
	protected $fillable = [
        'group_id',
        'user_id'
    ];

    protected $table = 'group_members';

    /**
     * A group member belongs to a group.
     *
     * @return Response
     */
    // public function group() {
    //     return $this->belongsToMany('App\Group');
    // }

    /**
     * A group member belongs to a user.
     *
     * @return Response
     */
    // public function user() {
    //     return $this->belongsTo('App\User');
    // }
}
