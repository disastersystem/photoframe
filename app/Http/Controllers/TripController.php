<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Http\Requests\TripRequest;
use App\Http\Requests\ChangeTripRequest;

use App\Trip;
use App\TripImage;
use App\TripVideo;
use App\TripActivity;

use Storage;

class TripController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    /**
     * Return all trips in descending order.
     *
     * @return Response
     */
    public function index() {
        return Trip::orderBy('id', 'desc')
            ->with('tripImages')
            ->get();
    }

    /**
     * Return a trip matching an id.
     *
     * @return Response
     */
    public function specific() {
        return Trip::where('id', request('id'))
            ->with('tripImages', 'tripVideos', 'tripActivities')
            ->get();
    }

    /**
     * Create a new trip, and return that trip.
     *
     * @param TripRequest $request
     * @return Object
     */
    public function store(TripRequest $request)
    {
        # append the user id to the request before saving
        $request->merge(['user_id' => \Auth::user()->id]);

        return Trip::create($request->all());
    }

    public function add(Request $request)
    {
        $request->merge(['user_id' => 1]);
        return Trip::create($request->all());
    }

    /**
     * Add a photo to the referenced trip.
     *
     * @param {int} $trip
     * @param Request $request
     */
    public function addPhoto($trip_id, Request $request)
    {
        $photo = TripImage::fromFile($request->file('photo'));

        return Trip::where('id', $trip_id)
            ->firstOrFail()
            ->savePhoto($photo);
    }

    /**
     * Updates a trip.
     *
     * @param  Request $request
     * @param  Trip $trip
     * @return Response
     */
    public function update($trip_id)
    {
        $trip = Trip::find($trip_id);

        $trip->title = request('title');
        $trip->leaving = request('leaving');
        $trip->returning = request('returning');
        $trip->recruitment_type = (request('recruitmentType') == true) ? 1 : 0;
        $trip->airplane_tickets_help = (request('airplaneTicketsHelp')  == true) ? 1 : 0;
        $trip->double_price = request('doublePrice');
        $trip->single_price = request('singlePrice');
        $trip->discount = request('discount');
        $trip->program = request('program');
        $trip->other = request('other');

        $trip->save();

        return $trip;
    }


    /**
     * Destroy the given trip.
     *
     * @param  $trip_id
     * @param  Request $request
     * @return Response
     */
    public function addVideo($trip_id, Request $request)
    {
        $video = new TripVideo;
        $video = $video->saveAs($request);

        $video = Trip::where('id', $trip_id)
            ->firstOrFail()
            ->saveVideo($video);

        return $video;
    }

    public function addActivity($trip_id)
    {
        $activity = new TripActivity;

        $activity->trip_id = $trip_id;
        $activity->title = request('title');
        $activity->price = request('price');
        $activity->discount = request('discount');

        $activity->save();

        return $activity;
    }


    /**
     * Destroy the given trip.
     *
     * @param  Request $request
     * @param  Trip    $trip
     * @return Response
     */
    public function destroy(Request $request, Trip $trip)
    {
        $tripImages = TripImage::where('trip_id', $trip->id)->get();

        /* delete the files on the filesystem */
        foreach ($tripImages as $image) {
            \File::delete([
                $image->filepath,
                $image->thumbnail_filepath
            ]);
        }

        $trip->delete();
    }


}
