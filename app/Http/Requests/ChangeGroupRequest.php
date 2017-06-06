<?php

namespace App\Http\Requests;

use App\Group;
use App\Http\Requests\Request;

class ChangeGroupRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if (!$this->userCreatedTrip($trip_id)) {
        //     return $this->unauthorized($request);
        // }
        return Group::where([
            'id' => $this->trip_id,
            'user_id' => \Auth::user()->id
        ])->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'photo' => 'mimes:jpg,jpeg,png,gif,bmp|max:10000'
        ];
    }
}
