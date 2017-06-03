<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\InterviewImage;

class InterviewImageController extends Controller
{
    /**
     * Delete a specific interview image.
     *
     * @param {int} $photo_id
     * @return Response
     */
    public function destroy($photo_id) {
        InterviewImage::findOrFail($photo_id)->delete();

        return back();
    }
}
