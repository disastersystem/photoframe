<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

}
