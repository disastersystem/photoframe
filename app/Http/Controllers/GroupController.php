<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Http\Requests\GroupRequest;
use App\Http\Requests\ChangeGroupRequest;

use App\Group;
use App\GroupImage;

use Storage;

class GroupController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Return all groups in descending order.
     *
     * @return Response
     */
    public function index() {
        return Group::orderBy('id', 'desc')
            ->with('groupImages')
            ->get();
    }

    /**
     * Return a group matching an id.
     *
     * @return Response
     */
    public function specific($id) {
        return Group::where('id', $id)
            ->with('groupImages')
            ->get();

            // $users = App\User::with(['posts' => function ($query) {
            //     $query->orderBy('created_at', 'desc');
            // }])->get();
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
        // return $request->all();
    }

    /**
     * Add a photo to the referenced group.
     *
     * @param {int} $group
     * @param Request $request
     */
    public function addPhoto($group_id, Request $request)
    {
        $photo = GroupImage::fromFile($request->file('file'));

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
        $groupImages = GroupImage::where('group_id', $group->id)->get();

        /* delete the files on the filesystem */
        foreach ($groupImages as $image) {
            \File::delete([
                $image->filepath,
                $image->thumbnail_filepath
            ]);
        }

        $group->delete();
    }


}
