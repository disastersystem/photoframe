<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Trip;

class TripVideo extends Model
{
    protected $fillable = [
        'trip_id',
        'link',
        'caption'
    ];

    protected $table = 'trip_videos';

    /**
     *
     *
     * @return Response
     */
    public function trip() {
        return $this->belongsTo('App\Trip');
    }

    public function saveAs($request)
    {
        # split the url into an array of the different url parts
        parse_str( parse_url( $request->videoUrl, PHP_URL_QUERY ), $url_components );
        $this->link = $url_components['v'];

        return $this;
    }

}
