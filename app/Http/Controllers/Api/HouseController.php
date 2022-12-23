<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Image;
use App\Models\Parcel;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HouseController extends Controller
{
    private $uploadPath = "uploads/houses/";

    use ApiMessage;
    // index  Parcel
    public function index_house()
    {
        $house =  House::with(['state', 'city', 'image'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return $this->returnDataWithOutToken('house', $house, 200);
    }

    // Create
    public function create_house(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type' => 'required',    //1
                'square' => 'required', //2
                'neighborhood' => 'required', //3
                'house_number' => '', //4
                'price' => '', //5
                'rental' => '', //6
                'features' => '', //7
                'space' => 'required', //8
                'degree' => '', //9
                'city' => 'required|exists:cities,id', //10
                'state' => 'required|exists:states,id', //11
            ]
        );
        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), 200);

        $house = new House();
        $house->type = $request->type; //1
        $house->square = $request->square; //2
        $house->neighborhood = $request->neighborhood; //3
        $house->house_number = $request->house_number; //4
        $house->price = $request->price; //5
        $house->rental = $request->rental; //6
        $house->features = $request->features; //7
        $house->space = $request->space; //8
        $house->degree = $request->degree; //9
        $house->state_id = $request->state; //10
        $house->city_id = $request->city; //11
        $house->user_id = Auth::user()->id; //12
        $house->save();
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
            $image->house_id = $house->id;
            $image->save();
        }
        //End Photo
        return $this->returnMessage(true, "تم اضافة المنزل بنجاح", 200);
    }

    // edit house
    public function edit_house(Request $request, $id)
    {
        $house =  House::with(['state', 'city', 'image'])->find($id);

        if ($house) {
            if ($house->user_id == Auth::user()->id) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'type' => 'required',    //1
                        'square' => 'required', //2
                        'neighborhood' => 'required', //3
                        'house_number' => '', //4
                        'price' => '', //5
                        'rental' => '', //6
                        'features' => '', //7
                        'space' => 'required', //8
                        'degree' => '', //9
                        'city' => 'required|exists:cities,id', //10
                        'state' => 'required|exists:states,id', //11

                    ]
                );

                if ($validator->fails())
                    return $this->returnMessage(false, $validator->errors()->all(), 200);

                $house->type = $request->type; //1
                $house->square = $request->square; //2
                $house->neighborhood = $request->neighborhood; //3
                $house->house_number = $request->house_number; //4
                $house->price = $request->price; //5
                $house->rental = $request->rental; //6
                $house->features = $request->features; //7
                $house->space = $request->space; //8
                $house->degree = $request->degree; //9
                $house->state_id = $request->state; //10
                $house->city_id = $request->city; //11
                $house->save();

                // Start Photo
                $formFileName = "photo";
                $fileFinalName = "";
                if ($request->$formFileName != "") {
                    // Delete file if there is a new one
                    if ($house->image && $house->image->$formFileName != "") {
                        File::delete($this->uploadPath . $house->image->$formFileName);
                    }
                    $fileFinalName = time() . rand(
                        1111,
                        9999
                    ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                    $path = $this->uploadPath;
                    $request->file($formFileName)->move($path, $fileFinalName);
                }

                if ($fileFinalName != "") {
                    if ($house->image) {
                        $image =  Image::find($house->image->id);
                        $image->photo = $fileFinalName;
                        // $image->parcel_id = $parcel->id;
                        $image->save();
                    } else {
                        $image = new Image();
                        $image->photo = $fileFinalName;
                        $image->house_id = $house->id;
                        $image->save();
                    }
                }
                //End Photo

                $house =  House::with(['state', 'city', 'image'])->find($id);
                return $this->returnDataWithOutToken('house', $house, "تم تعديل بيانات المنزل  بنجاح", 200);
            } else {
                return $this->returnMessage(false, 'هذا المنزل  غير موجود', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذا المنزل  غير موجود', 200);
        }
    }


    // show house
    public function show_house($id)
    {
        $house =  House::with(['state', 'city', 'image'])->find($id);

        if ($house) {
            if ($house->user_id == Auth::user()->id) {
                return $this->returnDataWithOutToken('house', $house, 200);
            } else {
                return $this->returnMessage(false, 'هذا المنزل  غير موجود', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذا المنزل  غير موجود', 200);
        }
    }

    // delete Parcel
    public function delete_house($id)
    {
        $house =  House::find($id);

        if ($house) {
            if ($house->user_id == Auth::user()->id) {
                $house->delete();
                return $this->returnMessage(false, 'تم حذف المنزل  ', 200);
            } else {
                return $this->returnMessage(false, 'هذا المنزل غير موجود', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذا المنزل غير موجود', 200);
        }
    }
}