<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\GroupPhoto;

class GroupPhotoController extends Controller
{
    /** 
     * @return array
     */
    public function all() {
        return GroupPhoto::orderBy('id', 'desc')
            ->select(
                'id', 'group_id',
                'filename', 'filepath AS src', 'thumbnail_filepath', 
                'width AS w', 'height AS h',
                'created_at', 'updated_at'
            )->paginate(20);
    }


    /**
     * Delete a photo belonging to a group.
     *
     * @param Request $request
     * @return Response
     */
    public function destroy($photo_id) {
        GroupPhoto::findOrFail($photo_id)->delete();

        return back();
    }
}
