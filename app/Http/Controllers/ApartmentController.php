<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $apartments = Apartment::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('apartments.index', compact('apartments', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apartments.create');
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
            'price' => 'required', //11
            'features' => '', //10
            'rental' => '', //9
            'type' => 'required', //8
            'space' => 'required', //7
            'apartment_number' => '', //5
            'square' => 'required', //4
            'neighborhood' => 'required', //3
            'city' => 'required', //2
            'state' => 'required', //1
        ]);

        $apartment = new Apartment();
        $apartment->price = $request->price;
        $apartment->features = $request->features;
        $apartment->rental = $request->rental;
        $apartment->type = $request->type;
        $apartment->space = $request->space;
        $apartment->apartment_number = $request->apartment_number;
        $apartment->square = $request->square;
        $apartment->neighborhood = $request->neighborhood;

        $apartment->state_id = $request->state;
        $apartment->city_id = $request->city;
        $apartment->user_id = Auth::user()->id;
        $apartment->save();

        toastr()->info('تم اضافة الشقة السكنية', 'نجاح');
        return redirect()->route('apartments.index');
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
        $apartment = Apartment::find($id);
        return view('apartments.edit', compact('apartment'));
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
            'price' => 'required', //11
            'features' => '', //10
            'rental' => '', //9
            'type' => 'required', //8
            'space' => 'required', //7
            'apartment_number' => '', //5
            'square' => 'required', //4
            'neighborhood' => 'required', //3
            'city' => 'required', //2
            'state' => 'required', //1
        ]);

        $apartment =  Apartment::find($id);
        $apartment->price = $request->price;
        $apartment->features = $request->features;
        $apartment->rental = $request->rental;
        $apartment->type = $request->type;
        $apartment->space = $request->space;
        $apartment->apartment_number = $request->apartment_number;
        $apartment->square = $request->square;
        $apartment->neighborhood = $request->neighborhood;

        $apartment->state_id = $request->state;
        $apartment->city_id = $request->city;
        $apartment->user_id = Auth::user()->id;
        $apartment->save();

        toastr()->info('تم تعديل بيانات الشقة السكنية', 'نجاح');
        return redirect()->route('apartments.edit', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Apartment::find($id)->delete();
        toastr()->info('تم حذف الشقة السكنية', 'نجاح');
        return redirect()->route('apartments.index');
    }
}