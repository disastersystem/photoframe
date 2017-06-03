<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Interview;
use App\InterviewImage;

class InterviewController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Create a new destination.
     *
     * @param  TripRequest  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Interview::create($request->all());

        return back();
    }

    /**
     * Return a edit interview view.
     *
     * @param  Request $request
     * @return Response
     */
    public function edit($interview_id, Request $request) {
        return view('admin.interviews.edit', [
            'interview' => Interview::where('id', $interview_id)->first()
        ]);
    }

    /**
     * Add a photo to the referenced trip.
     *
     * @param {int} $interview_id
     * @param Request $request
     */
    public function addPhoto($interview_id, Request $request)
    {
        $photo = InterviewImage::fromFile($request->file('photo'));

        Interview::where('id', $interview_id)->firstOrFail()->savePhoto($photo);
    }

    /**
     * Updates a interview.
     *
     * @param  Request $request
     * @param  Interview $interview
     * @return Response
     */
    public function update($interview_id, Request $request)
    {
        $interview = Interview::find($interview_id);

        $interview->title = $request->title;
        $interview->name = $request->name;
        $interview->text = $request->text;

        $interview->save();

        flash()->success("", "");

        return back();
    }


    /**
     * Destroy the given interview.
     *
     * @param  Request $request
     * @param  Interview $interview
     * @return Response
     */
    public function destroy(Request $request, Interview $interview) {
        $interview->delete();

        return back();
    }
}
