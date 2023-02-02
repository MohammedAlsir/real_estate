<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Agent;
use App\Models\Apartment;
use App\Models\City;
use App\Models\Hotel;
use App\Models\House;
use App\Models\Parcel;
use App\Models\ParcelCategory;
use App\Models\ParcelType;
use App\Models\Setting;
use App\Models\SpaceType;
use App\Models\State;
use App\Models\User;
use App\Traits\ApiMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetController extends Controller
{
    use ApiMessage;


    public function get_space_type() // Get Space Type
    {
        $space_type = SpaceType::orderBy('id', 'DESC')->get();
        return $this->returnData('space_type', $space_type);
    }

    public function get_parcels_category() // Get Space Type
    {
        $parcels_category = ParcelCategory::orderBy('id', 'DESC')->get();
        return $this->returnData('parcels_category', $parcels_category);
    }

    public function get_parcels_type() // Get Space Type
    {
        $parcels_type = ParcelType::orderBy('id', 'DESC')->get();
        return $this->returnData('parcels_type', $parcels_type);
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
        $parcels = Parcel::with(['state', 'city', 'category', 'type', 'spaceType', 'user', 'image']);

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
        if ($request->neighborhood)
            $parcels->where('neighborhood', 'like', '%' . $request->neighborhood . '%');

        $final = $parcels->orderBy('id', 'DESC')->get();

        foreach ($final as $one) {
            $one['time'] = $one->created_at->diffForHumans();
        }

        return $this->returnData('parcels', $final);
    }

    // get all houses
    public function get_houses(Request $request) // Get houses
    {
        $houses = House::with(['state', 'city', 'user', 'image']);

        if ($request->state_id)
            $houses->where('state_id', $request->state_id);
        if ($request->city_id)
            $houses->where('city_id', $request->city_id);
        if ($request->type)
            $houses->where('type', $request->type);
        if ($request->rental)
            $houses->where('rental', $request->rental);
        if ($request->neighborhood)
            $houses->where('neighborhood', 'like', '%' . $request->neighborhood . '%');

        $final = $houses->orderBy('id', 'DESC')->get();

        foreach ($final as $one) {
            $one['time'] = $one->created_at->diffForHumans();
        }

        return $this->returnData('houses', $final);
    }


    // get all apartment
    public function get_apartments(Request $request) // Get apartment
    {
        $apartments = Apartment::with(['state', 'city', 'user', 'image']);

        if ($request->state_id)
            $apartments->where('state_id', $request->state_id);
        if ($request->city_id)
            $apartments->where('city_id', $request->city_id);
        if ($request->type)
            $apartments->where('type', $request->type);
        if ($request->rental)
            $apartments->where('rental', $request->rental);
        if ($request->rental_type)
            $apartments->where('rental_type', $request->rental_type);
        if ($request->neighborhood)
            $apartments->where('neighborhood', 'like', '%' . $request->neighborhood . '%');

        $final = $apartments->orderBy('id', 'DESC')->get();

        foreach ($final as $one) {
            $one['time'] = $one->created_at->diffForHumans();
        }

        return $this->returnData('apartments', $final);
    }

    // get all hotels
    public function get_hotels(Request $request) // Get hotels
    {
        $hotels = Hotel::with(['state', 'city', 'user', 'image']);

        if ($request->state_id)
            $hotels->where('state_id', $request->state_id);
        if ($request->city_id)
            $hotels->where('city_id', $request->city_id);
        if ($request->type)
            $hotels->where('type', $request->type);
        if ($request->neighborhood)
            $hotels->where('neighborhood', 'like', '%' . $request->neighborhood . '%');


        $final = $hotels->orderBy('id', 'DESC')->get();

        foreach ($final as $one) {
            $one['time'] = $one->created_at->diffForHumans();
        }

        return $this->returnData('hotels', $final);
    }


    // GET By ID
    public function get_parcels_by_id($id) //
    {
        $parcel = Parcel::with(['state', 'city', 'category', 'type', 'spaceType', 'user', 'image'])->find($id);
        if ($parcel) {
            $parcel->count += 1;
            $parcel->save();
            $parcel['time'] = $parcel->created_at->diffForHumans();
            return $this->returnData('parcel', $parcel);
        } else
            return $this->returnMessage(false, 'هذه الارض غير موجودة', 200);
    }


    public function get_houses_by_id($id) //
    {
        $house = House::with(['state', 'city', 'user', 'image'])->find($id);
        if ($house) {
            $house->count += 1;
            $house->save();
            $house['time'] = $house->created_at->diffForHumans();
            return $this->returnData('house', $house);
        } else
            return $this->returnMessage(false, 'هذا المنزل غير موجود', 200);
    }

    public function get_apartments_by_id($id) //
    {
        $apartment = Apartment::with(['state', 'city', 'user', 'image'])->find($id);
        if ($apartment) {
            $apartment->count += 1;
            $apartment->save();
            $apartment['time'] = $apartment->created_at->diffForHumans();
            return $this->returnData('apartment', $apartment);
        } else
            return $this->returnMessage(false, 'هذه الشقة غير موجودة', 200);
    }

    public function get_hotels_by_id($id) //
    {
        $hotels = Hotel::with(['state', 'city', 'user', 'image'])->find($id);
        if ($hotels) {
            $hotels->count += 1;
            $hotels->save();
            $hotels['time'] = $hotels->created_at->diffForHumans();
            return $this->returnData('hotels', $hotels);
        } else
            return $this->returnMessage(false, 'هذا الفندق غير موجود', 200);
    }

    // Get All Ads
    public function get_all_ads()
    {
        $ads = Ad::where('start', '<=', Carbon::now()->toDateString())->where('end', '>=', Carbon::now()->toDateString())->get();
        return $this->returnDataWithOutToken('ads', $ads);
        // return Carbon::now()->toDateString();
    }

    // Count Agent
    public function get_agent_count()
    {
        $agent_count = User::count();
        return $this->returnDataWithOutToken('agent_count', $agent_count);
    }

    // Compant Count
    public function get_company_profile()
    {
        $profile = User::find(1);
        return $this->returnDataWithOutToken('profile', $profile);
        // return Carbon::now()->toDateString();
    }

    // payment_data
    public function payment_data()
    {
        $data = Setting::select('bank_name', 'bank_account', 'entry_fee')->find(1);
        return $this->returnDataWithOutToken('data', $data);
    }
}
