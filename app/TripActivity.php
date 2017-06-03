<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Trip;

class TripActivity extends Model
{
    protected $fillable = [
        'trip_id',
        'title',
        'price',
        'discount'
    ];

    protected $table = 'trip_activities';

    /**
     * A trip activity belongs to a trip.
     *
     * @return Response
     */
    public function trip() {
        return $this->belongsTo('App\Trip');
    }
}
