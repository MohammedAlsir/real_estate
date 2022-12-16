<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ParcelController extends Controller
{
    use ApiMessage;
    // index  Parcel
    public function index_parcels()
    {
        $parcel =  Parcel::with(['state', 'city', 'category', 'type', 'spaceType'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return $this->returnDataWithOutToken('parcel', $parcel, 200);
    }

    // Create
    public function create_parcels(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'parcel_type_id' => 'required|exists:parcel_types,id',    //1
                'parcel_category_id' => 'required|exists:parcel_categories,id', //2
                'square' => 'required', //3
                'neighborhood' => 'required', //4
                'parcels_number' => '', //5
                'price' => 'required', //6
                'features' => '', //7
                'space' => 'required', //8
                'space_type_id' => 'required|exists:space_types,id', //9
                'degree' => '', //10
                'city' => 'required|exists:cities,id', //11
                'state' => 'required|exists:states,id', //12
            ]
        );

        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), 200);

        $parcel = new Parcel();
        $parcel->parcel_type_id = $request->parcel_type_id;
        $parcel->parcel_category_id = $request->parcel_category_id;
        $parcel->square = $request->square;
        $parcel->neighborhood = $request->neighborhood;
        $parcel->parcels_number = $request->parcels_number;
        $parcel->price = $request->price;
        $parcel->features = $request->features;
        $parcel->space = $request->space;
        $parcel->space_type_id = $request->space_type_id;
        $parcel->degree = $request->degree;
        $parcel->state_id = $request->state;
        $parcel->city_id = $request->city;
        $parcel->user_id = Auth::user()->id;
        $parcel->save();
        return $this->returnMessage(true, "تم اضافة قطعة الارض بنجاح", 200);
    }

    // edit Parcel
    public function edit_parcels(Request $request, $id)
    {
        $parcel =  Parcel::find($id);

        if ($parcel) {
            if ($parcel->user_id == Auth::user()->id) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'parcel_type_id' => 'required|exists:parcel_types,id',    //1
                        'parcel_category_id' => 'required|exists:parcel_categories,id', //2
                        'square' => 'required', //3
                        'neighborhood' => 'required', //4
                        'parcels_number' => '', //5
                        'price' => 'required', //6
                        'features' => '', //7
                        'space' => 'required', //8
                        'space_type_id' => 'required|exists:space_types,id', //9
                        'degree' => '', //10
                        'city' => 'required|exists:cities,id', //11
                        'state' => 'required|exists:states,id', //12

                    ]
                );

                if ($validator->fails())
                    return $this->returnMessage(false, $validator->errors()->all(), 200);
                $parcel->parcel_type_id = $request->parcel_type_id;
                $parcel->parcel_category_id = $request->parcel_category_id;
                $parcel->square = $request->square;
                $parcel->neighborhood = $request->neighborhood;
                $parcel->parcels_number = $request->parcels_number;
                $parcel->price = $request->price;
                $parcel->features = $request->features;
                $parcel->space = $request->space;
                $parcel->space_type_id = $request->space_type_id;
                $parcel->degree = $request->degree;
                $parcel->state_id = $request->state;
                $parcel->city_id = $request->city;
                $parcel->save();

                return $this->returnDataWithOutToken('parcel', $parcel, "تم تعديل بيانات قطعة الارض بنجاح", 200);
            } else {
                return $this->returnMessage(false, 'هذه الارض غير موجودة', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذه الارض غير موجودة', 200);
        }
    }


    // show Parcel
    public function show_parcels($id)
    {
        $parcel =  Parcel::with(['state', 'city', 'category', 'type', 'spaceType'])->find($id);

        if ($parcel) {
            if ($parcel->user_id == Auth::user()->id) {
                return $this->returnDataWithOutToken('parcel', $parcel, 200);
            } else {
                return $this->returnMessage(false, 'هذه الارض غير موجودة', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذه الارض غير موجودة', 200);
        }
    }

    // delete Parcel
    public function delete_parcels($id)
    {
        $parcel =  Parcel::find($id);

        if ($parcel) {
            if ($parcel->user_id == Auth::user()->id) {
                $parcel->delete();
                return $this->returnMessage(false, 'تم حذف الارض  ', 200);
            } else {
                return $this->returnMessage(false, 'هذه الارض غير موجودة', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذه الارض غير موجودة', 200);
        }
    }
}