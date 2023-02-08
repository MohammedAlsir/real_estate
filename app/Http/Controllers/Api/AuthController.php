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
    private $uploadPathAgent = "uploads/agents/";

    /*
        == Login function ==
        == Receive email & password  ==
    */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        // == begin attempt ==
        if (Auth::attempt($data)) {
            if (Auth::user()->status == null)
                return $this->returnMessage(false, 'عفوا ,هذا الحساب غير مفعل الرجاء مراجعة ادارة التطبيق  ', 200);

            // == Create Token ==
            $token = Auth::guard()->user()->createToken('Token')->accessToken;
            //  == return user data with token ==
            // return $this->returnData('user', Auth::guard('agents')->user(), $token);
            return $this->returnData('user', Auth::guard()->user(), $token);
        } else
            // == there is error ==
            return $this->returnMessage(false, 'عفوا , هناك خطأ في اسم المستخدم كلمة المرور   ', 200);
        // == end attempt ==
    } // end of login

    public function register(Request $request)
    {
        $request->validate(
            [
                'name'      => 'required',
                'email'     => 'required|unique:users',
                'password'  => 'required|confirmed',
                'phone'     => 'required',
                'personal_document_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'commercial_license_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'trade_name' => 'max:255|required',
                'address' => 'required|max:255',
                'license' => 'required|max:255',
            ]
        );

        // == add new user  ==
        $user = new User();
        $user->trade_name = $request->trade_name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->license = $request->license;
        $user->type = 2;
        $user->status = "pending";

        // For personal_document_image
        $formFileNamepersonal_document = "personal_document_image";
        $fileFinalName_personal_document = "";
        if ($request->$formFileNamepersonal_document != "") {
            // Delete file if there is a new one
            if ($user->$formFileNamepersonal_document) {
                File::delete($this->uploadPathAgent . User::find(Auth::user()->id)->personal_document_image);
            }

            $fileFinalName_personal_document = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileNamepersonal_document)->getClientOriginalExtension();
            $path = $this->uploadPathAgent;
            $request->file($formFileNamepersonal_document)->move($path, $fileFinalName_personal_document);
        }

        if ($fileFinalName_personal_document != "") {
            $user->personal_document_image = $fileFinalName_personal_document;
        }

        // For personal_document_image

        // For commercial_license_image
        $formFileName_commercial_license = "commercial_license_image";
        $fileFinalName_commercial_license = "";
        if ($request->$formFileName_commercial_license != "") {
            // Delete file if there is a new one
            if ($user->$formFileName_commercial_license) {
                File::delete($this->uploadPathAgent . User::find(Auth::user()->id)->commercial_license_image);
            }

            $fileFinalName_commercial_license = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName_commercial_license)->getClientOriginalExtension();
            $path = $this->uploadPathAgent;
            $request->file($formFileName_commercial_license)->move($path, $fileFinalName_commercial_license);
        }

        if ($fileFinalName_commercial_license != "") {
            $user->commercial_license_image = $fileFinalName_commercial_license;
        }

        // For commercial_license_image

        $user->save();

        $token = $user->createToken('Token')->accessToken;
        // == return user data with token ==
        return $this->returnData('user', $user, $token);
    } // end of register

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
                'email'     => 'string|max:255|unique:users,email,' . $user->id,
                'password'  => 'string|confirmed',
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

        if ($request->long)
            $user->long = $request->long;
        if ($request->lat)
            $user->lat = $request->lat;

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

        // For logo
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

        // For logo

        // save
        $user->save();
        // == return user data with token ==
        return $this->returnData('user', $user);
    }
}