<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $houses = House::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('houses.index', compact('houses', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('houses.create');
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
            'degree' => '', //6
            'house_number' => '', //5
            'square' => 'required', //4
            'neighborhood' => 'required', //3
            'city' => 'required', //2
            'state' => 'required', //1
        ]);

        $house = new House();
        $house->price = $request->price;
        $house->features = $request->features;
        $house->rental = $request->rental;
        $house->type = $request->type;
        $house->space = $request->space;
        $house->degree = $request->degree;
        $house->house_number = $request->house_number;
        $house->square = $request->square;
        $house->neighborhood = $request->neighborhood;

        $house->state_id = $request->state;
        $house->city_id = $request->city;
        $house->user_id = Auth::user()->id;
        $house->save();

        toastr()->info('تم اضافة المنزل', 'نجاح');
        return redirect()->route('houses.index');
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
        $house = House::find($id);
        return view('houses.edit', compact('house'));
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
            'degree' => '', //6
            'house_number' => '', //5
            'square' => 'required', //4
            'neighborhood' => 'required', //3
            'city' => 'required', //2
            'state' => 'required', //1
        ]);

        $house =  House::find($id);
        $house->price = $request->price;
        $house->features = $request->features;
        $house->rental = $request->rental;
        $house->type = $request->type;
        $house->space = $request->space;
        $house->degree = $request->degree;
        $house->house_number = $request->house_number;
        $house->square = $request->square;
        $house->neighborhood = $request->neighborhood;

        $house->state_id = $request->state;
        $house->city_id = $request->city;
        $house->user_id = Auth::user()->id;
        $house->save();

        toastr()->info('تم تعديل بيانات المنزل', 'نجاح');
        return redirect()->route('houses.edit', $house->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        House::find($id)->delete();
        toastr()->info('تم حذف المنزل', 'نجاح');
        return redirect()->route('houses.index');
    }
}