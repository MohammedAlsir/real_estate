<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    private $uploadPath = "uploads/hotels/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $index = 1;
        $type = 0;



        // >الخاصة بالوكلاء
        if ($request->hotel == 2) {
            $hotels = Hotel::where('user_id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
            $type = 2;
        }
        // >الخاصة بالشركة و بالوكلاء
        else if ($request->hotel == 3) {
            $hotels = Hotel::orderBy('id', 'DESC')->get();
            $type = 3;
        }
        // الخاصة بالشركة
        else {
            $hotels = Hotel::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            $type = 1;
        }

        return view('hotels.index', compact('hotels', 'index', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'price' => '', //11
            'features' => 'required', //10
            'type' => 'required', //8
            'neighborhood' => 'required', //3
            'city' => 'required', //2
            'state' => 'required', //1
            'name' => 'required', //0
        ]);

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

        toastr()->info('تم اضافة الفندق', 'نجاح');
        return redirect()->route('hotels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::find($id);
        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => '', //11
            'features' => 'required', //10
            'type' => 'required', //8
            'neighborhood' => 'required', //3
            'city' => 'required', //2
            'state' => 'required', //1
            'name' => 'required', //0
        ]);

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

        toastr()->info('تم تعديل بيانات الفندق', 'نجاح');
        return redirect()->route('hotels.edit', $hotel->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hotel::find($id)->delete();
        toastr()->info('تم حذف الفندق', 'نجاح');
        return redirect()->route('hotels.index');
    }
}
