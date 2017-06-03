<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\InterviewImage;

class Interview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'name',
        'text'
    ];

    /**
     *
     *
     * @return  \Illuminate\....
     */
    public function interviewImages() {
        return $this->hasMany('App\InterviewImage');
    }

    /**
     * Add a photo the referenced interview.
     *
     * @param InterviewImage $photo
     */
    public function savePhoto(InterviewImage $photo)
    {
        return $this->interviewImages()->save($photo);
    }


}
