<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\ParcelCategory;
use App\Models\ParcelType;
use App\Models\SpaceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $parcel = Parcel::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('parcels.index', compact('parcel', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parcelType = ParcelType::all();
        $parcelCategory = ParcelCategory::all();
        $spaceType = SpaceType::all();
        return view('parcels.create', compact(
            'parcelType',
            'parcelCategory',
            'spaceType'
        ));
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
            'parcel_type_id' => 'required',    //1
            'parcel_category_id' => 'required', //2
            'square' => 'required', //3
            'neighborhood' => 'required', //4
            'parcels_number' => '', //5
            'price' => 'required', //6
            'features' => '', //7
            'space' => 'required', //8
            'space_type_id' => 'required', //9
            'degree' => '', //10
            'city' => 'required', //11
            'state' => 'required', //12
        ]);

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

        toastr()->info('تم اضافة قطعة الارض  ', 'نجاح');
        return redirect()->route('parcel.index');
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
        $parcel  = Parcel::find($id);
        $parcelType = ParcelType::all();
        $parcelCategory = ParcelCategory::all();
        $spaceType = SpaceType::all();
        return view('parcels.edit', compact(
            'parcelType',
            'parcelCategory',
            'spaceType',
            'parcel'
        ));
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
            'parcel_type_id' => 'required',    //1
            'parcel_category_id' => 'required', //2
            'square' => 'required', //3
            'neighborhood' => 'required', //4
            'parcels_number' => '', //5
            'price' => 'required', //6
            'features' => '', //7
            'space' => 'required', //8
            'space_type_id' => 'required', //9
            'degree' => '', //10
            'city' => 'required', //11
            'state' => 'required', //12

        ]);

        $parcel =  Parcel::find($id);
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

        toastr()->info('تم تعديل بيانات قطعة الارض  ', 'نجاح');
        return redirect()->route('parcel.edit', $parcel->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Parcel::find($id)->delete();
        toastr()->info('تم حذف قطعة الارض  ', 'نجاح');
        return redirect()->route('parcel.index');
    }
}
