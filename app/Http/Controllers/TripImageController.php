<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TripImage;

class TripImageController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Updates a image caption.
     *
     * @param {int} $img_id
     * @param Request $request
     * @return Response
     */
    public function updateCaption($img_id, Request $request)
    {
        $tripImage = TripImage::find($img_id);

        $tripImage->caption = $request->photo_caption;

        $tripImage->save();

        // flash()->success("", "");

        // return back();
    }

    /**
     * Delete a image belonging to a trip.
     *
     * @param Request $request
     * @return Response
     */
    public function destroy($photo_id) {
        TripImage::findOrFail($photo_id)->delete();

        return back();
    }
}
