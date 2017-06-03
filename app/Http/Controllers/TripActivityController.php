<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TripActivity;

class TripActivityController extends Controller
{
    /**
     * Updates a image caption.
     *
     * @param {int} $img_id
     * @param Request $request
     * @return Response
     */
    public function update($activity_id, Request $request)
    {
        $tripActivity = TripActivity::find($activity_id);

        $tripActivity->title = $request->title;
        $tripActivity->price = $request->price;
        $tripActivity->discount = $request->discount;

        $tripActivity->save();

        return ['success', 'Aktivitet oppdatert.'];
    }

    /**
     * Delete a activity.
     *
     * @param {int} $activity_id
     * @return Response
     */
    public function destroy($activity_id)
    {
        if (TripActivity::destroy($activity_id)) {
            return ['success', 'Aktivitet slettet.'];
        } else {
            return ['error', 'Kunne ikke slette aktivitet.'];
        }
    }
}
