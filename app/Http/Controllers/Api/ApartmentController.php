<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Image;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    private $uploadPath = "uploads/apartments/";

    use ApiMessage;
    // index  Parcel
    public function index_apartment()
    {
        $apartments =  Apartment::with(['state', 'city', 'image'])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return $this->returnDataWithOutToken('apartments', $apartments, 200);
    }

    // Create
    public function create_apartment(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'type' => 'required',    //1
                'square' => 'required', //2
                'neighborhood' => 'required', //3
                'apartment_number' => '', //4
                'price' => '', //5
                'rental_type' => '', //6
                'rental' => '', //7
                'features' => '', //8
                'space' => 'required', //9
                'city' => 'required|exists:cities,id', //10
                'state' => 'required|exists:states,id', //11
            ]
        );
        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), 200);

        $apartment = new Apartment();
        $apartment->type = $request->type; //1
        $apartment->square = $request->square; //2
        $apartment->neighborhood = $request->neighborhood; //3
        $apartment->apartment_number = $request->apartment_number; //4
        $apartment->price = $request->price; //5
        $apartment->rental_type = $request->rental_type; //6
        $apartment->rental = $request->rental; //7
        $apartment->features = $request->features; //8
        $apartment->space = $request->space; //9
        $apartment->state_id = $request->state; //10
        $apartment->city_id = $request->city; //11
        $apartment->user_id = Auth::user()->id; //12
        $apartment->save();
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
            $image->apartment_id = $apartment->id;
            $image->save();
        }
        //End Photo
        return $this->returnMessage(true, "تم اضافة الشقة بنجاح", 200);
    }

    // edit apartment
    public function edit_apartment(Request $request, $id)
    {
        $apartment =  Apartment::with(['state', 'city', 'image'])->find($id);

        if ($apartment) {
            if ($apartment->user_id == Auth::user()->id) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'type' => 'required',    //1
                        'square' => 'required', //2
                        'neighborhood' => 'required', //3
                        'apartment_number' => '', //4
                        'price' => '', //5
                        'rental_type' => '', //6
                        'rental' => '', //7
                        'features' => '', //8
                        'space' => 'required', //9
                        'city' => 'required|exists:cities,id', //10
                        'state' => 'required|exists:states,id', //11
                    ]
                );

                if ($validator->fails())
                    return $this->returnMessage(false, $validator->errors()->all(), 200);

                $apartment->type = $request->type; //1
                $apartment->square = $request->square; //2
                $apartment->neighborhood = $request->neighborhood; //3
                $apartment->apartment_number = $request->apartment_number; //4
                $apartment->price = $request->price; //5
                $apartment->rental_type = $request->rental_type; //6
                $apartment->rental = $request->rental; //7
                $apartment->features = $request->features; //8
                $apartment->space = $request->space; //9
                $apartment->state_id = $request->state; //10
                $apartment->city_id = $request->city; //11
                $apartment->save();

                // Start Photo
                $formFileName = "photo";
                $fileFinalName = "";
                if ($request->$formFileName != "") {
                    // Delete file if there is a new one
                    if ($apartment->image && $apartment->image->$formFileName != "") {
                        File::delete($this->uploadPath . $apartment->image->$formFileName);
                    }
                    $fileFinalName = time() . rand(
                        1111,
                        9999
                    ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                    $path = $this->uploadPath;
                    $request->file($formFileName)->move($path, $fileFinalName);
                }

                if ($fileFinalName != "") {
                    if ($apartment->image) {
                        $image =  Image::find($apartment->image->id);
                        $image->photo = $fileFinalName;
                        // $image->parcel_id = $parcel->id;
                        $image->save();
                    } else {
                        $image = new Image();
                        $image->photo = $fileFinalName;
                        $image->apartment_id = $apartment->id;
                        $image->save();
                    }
                }
                //End Photo

                $apartment =  Apartment::with(['state', 'city', 'image'])->find($id);
                return $this->returnDataWithOutToken('apartment', $apartment, "تم تعديل بيانات المنزل  بنجاح", 200);
            } else {
                return $this->returnMessage(false, 'هذه الشقة غير موجودة', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذه الشقة غير موجودة', 200);
        }
    }


    // show apartment
    public function show_apartment($id)
    {
        $apartment =  Apartment::with(['state', 'city', 'image'])->find($id);

        if ($apartment) {
            if ($apartment->user_id == Auth::user()->id) {
                return $this->returnDataWithOutToken('apartment', $apartment, 200);
            } else {
                return $this->returnMessage(false, 'هذه الشقة  غير موجودة', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذه الشقة  غير موجودة', 200);
        }
    }

    // delete Parcel
    public function delete_apartment($id)
    {
        $apartment =  Apartment::find($id);

        if ($apartment) {
            if ($apartment->user_id == Auth::user()->id) {
                $apartment->delete();
                return $this->returnMessage(false, 'تم حذف الشقة  ', 200);
            } else {
                return $this->returnMessage(false, 'هذه الشقة غير موجودة', 200);
            }
        } else {
            return $this->returnMessage(false, 'هذه الشقة غير موجودة', 200);
        }
    }
}