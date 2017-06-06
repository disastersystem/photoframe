<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\GroupImage;

class GroupImageController extends Controller
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
    // public function updateCaption($img_id, Request $request)
    // {
    //     $groupImage = GroupImage::find($img_id);

    //     $groupImage->caption = $request->photo_caption;

    //     $groupImage->save();

    //     // flash()->success("", "");

    //     // return back();
    // }

    /**
     * Delete an image belonging to a group.
     *
     * @param Request $request
     * @return Response
     */
    public function destroy($photo_id) {
        GroupImage::findOrFail($photo_id)->delete();

        return back();
    }
}
