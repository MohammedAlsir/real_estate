<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Image;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    private $uploadPath = "uploads/hotels/";

    use ApiMessage;
    // index  Parcel
    public function index_hotels()
    {
        $hotels =  Hotel::with(['state', 'city', 'image'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        foreach ($hotels as $one) {
            $one['time'] = $one->created_at->diffForHumans();
        }
        return $this->returnDataWithOutToken('hotels', $hotels, 200);
    }

    // Create
    public function create_hotels(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type' => 'required',    //1
                'neighborhood' => 'required', //2
                'name' => 'required', //3
                'price' => 'required', //4
                'features' => 'required', //5
                'city' => 'required|exists:cities,id', //6
                'state' => 'required|exists:states,id', //7
            ]
        );
        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), 200);

        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->features = $request->features;
        $hotel->type = $request->type;
        $hotel->neighborhood = $request->neighborhood;
        $hotel->state_id = $request->state;
        $hotel->city_id = $request->city;
        $hotel->user_id = Auth::user()->id;
        $hotel->save();

        // Start Photo
        $formFileName = "photo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }

        if ($fileFinalName != "") {
            $image = new Image();
            $image->photo = $fileFinalName;
            $image->hotel_id = $hotel->id;
            $image->save();
        }
        //End Photo
        return $this->returnMessage(true, "تم اضافة الفندق بنجاح", 200);
    }

    // edit house
    public function edit_hotels(Request $request, $id)
    {
        $hotel =  Hotel::with(['state', 'city', 'image'])->find($id);

        if ($hotel) {
            if ($hotel->user_id == Auth::user()->id) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'type' => 'required',    //1
                        'neighborhood' => 'required', //2
                        'name' => 'required', //3
                        'price' => 'required', //4
                        'features' => 'required', //5
                        'city' => 'required|exists:cities,id', //6
                        'state' => 'required|exists:states,id', //7
                    ]
                );

                if ($validator->fails())
                    return $this->returnMessage(false, $validator->errors()->all(), 200);

                $hotel =  Hotel::find($id);
                $hotel->name = $request->name;
                $hotel->price = $request->price;
                $hotel->features = $request->features;
                $hotel->type = $request->type;
                $hotel->neighborhood = $request->neighborhood;
                $hotel->state_id = $request->state;
                $hotel->city_id = $request->city;
                $hotel->save();

                // Start Photo
                $formFileName = "photo";
                $fileFinalName = "";
                if ($request->$formFileName != "") {
                    // Delete file if there is a new one
                    if ($hotel->image && $hotel->image->$formFileName != "") {
                        File::delete($this->uploadPath . $hotel->image->$formFileName);
                    }
                    $fileFinalName = time() . rand(
                        1111,
                        9999
                    ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                    $path = $this->uploadPath;
                    $request->file($formFileName)->move($path, $fileFinalName);
                }

                if ($fileFinalName != "") {
                    if ($hotel->image) {
                        $image =  Image::find($hotel->image->id);
                        $image->photo = $fileFinalName;
                        // $image->parcel_id = $parcel->id;
                        $image->save();
                    } else {
                        $image = new Image();
                        $image->photo = $fileFinalName;
                        $image->hotel_id = $hotel->id;
                        $image->save();
                    }
                }
                //End Photo

                $house =  Hotel::with(['state', 'city', 'image'])->find($id);

                return $this->returnDataWithOutToken('house', $house, "تم تعديل بيانات الفندق  بنجاح", 200);
            } else {
                return $this->returnMessage(false, 'هذا الفندق  غير موجود', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذا الفندق  غير موجود', 200);
        }
    }


    // show house
    public function show_hotels($id)
    {
        $hotel =  Hotel::with(['state', 'city', 'image'])->find($id);

        if ($hotel) {
            if ($hotel->user_id == Auth::user()->id) {
                $hotel['time'] = $hotel->created_at->diffForHumans();
                return $this->returnDataWithOutToken('hotel', $hotel, 200);
            } else {
                return $this->returnMessage(false, 'هذا الفندق  غير موجود', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذا الفندق  غير موجود', 200);
        }
    }

    // delete Parcel
    public function delete_hotels($id)
    {
        $hotel =  Hotel::find($id);

        if ($hotel) {
            if ($hotel->user_id == Auth::user()->id) {
                $hotel->delete();
                return $this->returnMessage(false, 'تم حذف الفندق  ', 200);
            } else {
                return $this->returnMessage(false, 'هذا الفندق غير موجود', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذا الفندق غير موجود', 200);
        }
    }
}