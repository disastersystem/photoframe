<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TripVideo;

class TripVideoController extends Controller
{
    /** 
     *
     * @return 
     */
    public function all() {
        return TripVideo::orderBy('id', 'desc')->paginate(6);
    }

    /**
     * 
     *
     * @param  Request  $request
     * @return Response
     */
    public function destroy($video_id) {
        $video = TripVideo::findOrFail($video_id);
        $video->delete();
        // TripImage::findOrFail($photo_id)->delete();

        return ['Eyy'];
    }
}
