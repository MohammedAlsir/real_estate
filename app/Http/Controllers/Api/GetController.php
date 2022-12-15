<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Parcel;
use App\Models\SpaceType;
use App\Models\State;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;

class GetController extends Controller
{
    use ApiMessage;


    public function get_space_type() // Get Space Type
    {
        $space_type = SpaceType::orderBy('id', 'DESC')->get();
        return $this->returnData('space_type', $space_type);
    }

    public function get_state() // Get All State
    {
        $states = State::orderBy('id', 'DESC')->get();
        return $this->returnData('states', $states);
    }

    public function get_cities($state_id) // Get All cities by state id
    {
        $cities = City::where('state_id', $state_id)->orderBy('id', 'DESC')->get();
        return $this->returnData('cities', $cities);
    }

    public function get_parcels(Request $request) // Get parcels كل الاراضي
    {
        $parcels = Parcel::with(['state', 'city', 'category', 'type', 'spaceType']);

        if ($request->state_id)
            $parcels->where('state_id', $request->state_id);
        if ($request->city_id)
            $parcels->where('city_id', $request->city_id);
        if ($request->parcel_type_id)
            $parcels->where('parcel_type_id', $request->parcel_type_id);
        if ($request->parcel_category_id)
            $parcels->where('parcel_category_id', $request->parcel_category_id);
        if ($request->space_type_id)
            $parcels->where('space_type_id', $request->space_type_id);




        return $this->returnData('parcels', $parcels->orderBy('id', 'DESC')->get());
    }
}