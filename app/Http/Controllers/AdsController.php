<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    private $uploadPath = "uploads/ad/";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $ads = Ad::orderBy('id', 'DESC')->get();
        return view('ads.index', compact('ads', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
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
            'name' => 'required',    //1
            'start' => 'required', //2
            'end' => 'required', //3
            'photo' => 'required', //4
        ]);

        $ad =  new Ad();
        $ad->name = $request->name;
        $ad->start = $request->start;
        $ad->end = $request->end;

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
            $ad->photo = $fileFinalName;
        }
        //End Photo
        $ad->save();
        toastr()->info('تم  اضافة الاعلان', 'نجاح');
        return redirect()->route('ads.index');
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
        $ad = Ad::find($id);
        return view('ads.edit', compact('ad'));
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
            'name' => 'required',    //1
            'start' => 'required', //2
            'end' => 'required', //3
            // 'photo' => 'required', //4
        ]);

        $ad =   Ad::find($id);
        $ad->name = $request->name;
        $ad->start = $request->start;
        $ad->end = $request->end;

        // Start Photo
        $formFileName = "photo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            if ($ad->photo) {
                File::delete($this->uploadPath . $ad->$formFileName);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }

        if ($fileFinalName != "") {
            $ad->photo = $fileFinalName;
        }
        //End Photo
        $ad->save();
        toastr()->info('تم  تعديل بيانات الاعلان', 'نجاح');
        return redirect()->route('ads.edit', $ad->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);
        if ($ad->photo) {
            File::delete($this->uploadPath . $ad->photo);
        }
        $ad->delete();

        toastr()->info('تم  حذف الاعلان', 'نجاح');
        return redirect()->route('ads.index');
    }
}