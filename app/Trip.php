<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\TripImage;

class Trip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'leaving', 'user_id', 'returning', 'program', 'other', 'recruitment_type',
        'airplane_tickets_help', 'double_price', 'single_price', 'discount'
    ];

    /**
     * A trip has many trip images.
     */
    public function tripImages() {
        return $this->hasMany('App\TripImage');
    }

    /**
     * A trip has many trip videos.
     */
    public function tripVideos() {
        return $this->hasMany('App\TripVideo');
    }

    /**
     * A trip has many trip activities.
     */
    public function tripActivities() {
        return $this->hasMany('App\TripActivity');
    }

    /**
     * A trip belongs to a user.
     *
     * @return  \Illuminate\...
     */
    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Check wheter a the trip belongs to the signed in user.
     *
     * @return boolean
     */
    public function ownedBy(User $user) {
        return $this->user_id == $user->id;
    }

    /**
     * Add a photo to the referenced trip.
     *
     * @param TripImage $photo
     */
    public function savePhoto(TripImage $photo) {
        return $this->tripImages()->save($photo);
    }

    /**
     * Add a video to the referenced trip.
     *
     * @param  numeric $trip
     * @param  Request $request
     */
    public function saveVideo(TripVideo $video) {
        return $this->tripVideos()->save($video);
    }

}
