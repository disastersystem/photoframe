<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\GroupImage;

class GroupImageController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    /** 
     * what
     * @return 
     */
    public function all() {
        return GroupImage::orderBy('id', 'desc')->paginate(20);
    }

    public function byGroupYear($group_id, $year) {
        return DB::select("SELECT * FROM group_images WHERE group_id = " . $group_id . " && created_at LIKE '" . $year . "%';");
        // return DB::table('group_images')
        //     ->select('id', 'filename', 'filepath', 'thumbnail_filepath', 'created_at')
        //     ->where('created_at', 'LIKE', $year)
        //     ->get();
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
