<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiMessage;
    private $uploadPath = "uploads/users/";
    private $uploadPathLogo = "uploads/agents/logo/";


    /*
        == Login function ==
        == Receive email & password  ==
    */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:8'
        ]);

        // == begin attempt ==
        if (Auth::attempt($data)) {
            // == Create Token ==
            $token = Auth::guard()->user()->createToken('Token')->accessToken;
            //  == return user data with token ==
            // return $this->returnData('user', Auth::guard('agents')->user(), $token);
            return $this->returnData('user', Auth::guard()->user(), $token);
        } else
            // == there is error ==
            return $this->returnMessage(false, 'عفوا , هناك خطأ في كلمة المرور او  البريد الالكتروني  ', 200);
        // == end attempt ==
    }


    // Show Profile
    public function get_profile()
    {
        $user = User::find(Auth::user()->id);
        if ($user)
            return $this->returnData('user', $user);
        else
            return $this->returnMessage(false, 'هذا المستخدم غير موجود', 200);
    }



    // Edit Profile
    public function edit_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (!$user)
            return $this->returnMessage(false, 'هذا المستخدم غير موجود', 200);

        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'string|max:255',
                'email'     => 'string|email|max:255|unique:users,email,' . $user->id,
                'password'  => 'string|min:8|confirmed',
                'phone'     => '',

                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                'trade_name' => 'max:255',
                'address' => 'max:255',
                'license' => 'max:255',
                'whatsapp_phone' => 'max:255',
                'telegram_phone' => 'max:255',
                'personal_email' => 'max:255',
                'twitter_account' => 'max:255',
                'facebook_account' => 'max:255',


            ]
        );

        if ($validator->fails())
            return $this->returnMessage(false, $validator->errors()->all(), 200);
        // == add new user  ==
        if ($request->name)
            $user->name = $request->name;
        if ($request->email)
            $user->email = $request->email;
        if ($request->password)
            $user->password = $request->password;
        if ($request->phone)
            $user->phone = $request->phone;
        if ($request->trade_name)
            $user->trade_name = $request->trade_name;

        if ($request->address)
            $user->address = $request->address;
        if ($request->license)
            $user->license = $request->license;
        if ($request->whatsapp_phone)
            $user->whatsapp_phone = $request->whatsapp_phone;
        if ($request->telegram_phone)
            $user->telegram_phone = $request->telegram_phone;
        if ($request->personal_email)
            $user->personal_email = $request->personal_email;
        if ($request->twitter_account)
            $user->twitter_account = $request->twitter_account;
        if ($request->facebook_account)
            $user->facebook_account = $request->facebook_account;



        // For Photo
        $formFileName = "photo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            if ($user->$formFileName) {
                File::delete($this->uploadPath . User::find(Auth::user()->id)->photo);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }

        if ($fileFinalName != "") {
            $user->photo = $fileFinalName;
        }
        // For Photo

        // For Photo
        $formFileNameLogo = "logo";
        $fileFinalNameLogo = "";
        if ($request->$formFileNameLogo != "") {
            // Delete file if there is a new one
            if ($user->$formFileNameLogo) {
                File::delete($this->uploadPathLogo . User::find(Auth::user()->id)->logo);
            }
            $fileFinalNameLogo = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileNameLogo)->getClientOriginalExtension();
            $path = $this->uploadPathLogo;
            $request->file($formFileNameLogo)->move($path, $fileFinalNameLogo);
        }

        if ($fileFinalNameLogo != "") {
            $user->logo = $fileFinalNameLogo;
        }
        // For Photo
        $user->save();
        // == return user data with token ==
        return $this->returnData('user', $user);
    }
}