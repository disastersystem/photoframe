<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\GroupImage;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'user_id'];

    /**
     * A group has many group images.
     */
    public function groupImages() {
        return $this->hasMany('App\GroupImage');
    }

    /**
     * A group belongs to a user.
     *
     * @return  \Illuminate\...
     */
    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Check wheter a group belongs to the signed in user.
     *
     * @return boolean
     */
    public function ownedBy(User $user) {
        return $this->user_id == $user->id;
    }

    /**
     * Add a photo to the referenced group.
     *
     * @param GroupImage $photo
     */
    public function savePhoto(GroupImage $photo) {
        return $this->groupImages()->save($photo);
    }

}
