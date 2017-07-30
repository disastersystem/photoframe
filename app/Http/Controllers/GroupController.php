<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Http\Requests\GroupRequest;
use App\Http\Requests\ChangeGroupRequest;

use App\Group;
use App\GroupPhoto;

use Storage;

class GroupController extends Controller
{
    /**
     * Return all groups in descending order.
     *
     * @return Response
     */
    public function index() {
        return Group::orderBy('id', 'desc')
            // ->with('groupPhotos')
            ->get();
    }

    /**
     * Return a group matching an id.
     *
     * @return Response
     */
    public function specific($id) {
        return Group::where('id', $id)
            //->with(['groupPhotos' => function($query) { $query->orderBy('created_at', 'desc'); }])
            ->get();
    }

    /** 
     *
     * @return 
     */
    public function photos($id) {
        return GroupPhoto::where('group_id', $id)
            ->orderBy('id', 'desc')
            ->simplePaginate(8);
    }

    /**
     * Create a new group, and return that group.
     *
     * @param GroupRequest $request
     * @return Object
     */
    public function store(GroupRequest $request)
    {
        # append the user id to the request before saving
        $request->merge(['user_id' => \Auth::user()->id]);

        return Group::create($request->all());
    }

    public function add(Request $request)
    {
        $request->merge(['user_id' => 1]);

        return Group::create($request->all());
    }

    /**
     * Add a photo to the referenced group.
     *
     * @param {int} $group
     * @param Request $request
     */
    public function addPhoto($group_id, Request $request)
    {
        $photo = GroupPhoto::fromFile($request->file('file'));

        return Group::where('id', $group_id)
            ->firstOrFail()
            ->savePhoto($photo);
    }

    /**
     * Updates a group.
     *
     * @param  Request $request
     * @param  Group $group
     * @return Response
     */
    public function update($group_id)
    {
        $group = Group::find($group_id);

        $group->title = request('title');

        $group->save();

        return $group;
    }

    /**
     * Destroy the given group.
     *
     * @param  Request $request
     * @param  Group    $group
     * @return Response
     */
    public function destroy(Request $request, Group $group)
    {
        $groupPhotos = GroupPhoto::where('group_id', $group->id)->get();

        /* delete the files on the filesystem */
        foreach ($groupPhotos as $photo) {
            \File::delete([
                $photo->filepath,
                $photo->thumbnail_filepath
            ]);
        }

        $group->delete();
    }

}
