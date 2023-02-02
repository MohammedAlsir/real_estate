<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paymen;
use App\Models\Payment;
use App\Models\User;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ApiMessage;
    private $uploadPath = "uploads/payment/";


    // payment
    public function payment(Request $request)
    {
        $request->validate(
            [
                'photo'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        $payment = new Payment();
        $payment->user_id = Auth::user()->id;

        // For photo
        $formFileName = "photo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            // if (Auth::user()->id->$formFileName) {
            //     File::delete($this->uploadPathAgent . User::find(Auth::user()->id)->photo);
            // }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }

        if ($fileFinalName != "") {
            $payment->photo = $fileFinalName;
        }
        // For photo

        $payment->save();

        return $this->returnMessage(true, "تم اضافة  الاشعار", 200);
    }
}