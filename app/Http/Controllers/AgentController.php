<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgentRequest;
use App\Models\Agent;
use App\Models\Payment;
use App\Models\User;
use App\Traits\Oprations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class AgentController extends Controller
{
    use Oprations;
    private $uploadPath = "uploads/agents/logo/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $agents = User::where('type', 2)->orderBy('id', 'DESC')->get();
        return view('agents.index', compact('index', 'agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agents.create');
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
            'trade_name' => 'required',
            'name' => 'required',
            'address' => 'required',
            'license' => 'required',
            'phone' => 'required',
            'whatsapp_phone' => 'max:9|min:9',
            'telegram_phone' => '',
            'personal_email' => '',
            'twitter_account' => '',
            'facebook_account' => '',
            'logo' => '',
            'email' => 'unique:users',
            'password' => 'required',
            'status' => '',
            'subscription_end' => 'required'
        ], [
            'email.unique' => 'اسم المستخدم موجود مسبقا',
            'whatsapp_phone.max' => 'رقم الواتساب اطول من المطلوب',
            'whatsapp_phone.min' => 'رقم الواتساب اقصر من المطلوب',
        ]);
        $agent = new User();
        $agent->trade_name = $request->trade_name;
        $agent->name = $request->name;
        $agent->address = $request->address;
        $agent->license = $request->license;
        $agent->phone = $request->phone;
        $agent->whatsapp_phone = $request->whatsapp_phone;
        $agent->telegram_phone = $request->telegram_phone;
        $agent->personal_email = $request->personal_email;
        $agent->twitter_account = $request->twitter_account;
        $agent->facebook_account = $request->facebook_account;
        $agent->email = $request->email;
        $agent->password = $request->password;
        $agent->status = $request->status;
        $agent->subscription_end = $request->subscription_end;
        $agent->type = 2;


        // Start of Upload Files
        $formFileName = "logo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            if ($agent->$formFileName != "") {
                File::delete($this->uploadPath . $agent->$formFileName);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }


        if ($fileFinalName != "") {
            $agent->logo = $fileFinalName;
        }

        $agent->save();

        toastr()->info('تم اضافة الوكيل العقاري ', 'نجاح');
        return redirect()->route('agent.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 1) {
            return abort(404);
        }
        $agent = User::find($id);
        $payments = Payment::where('user_id', $id)->orderBy('id', 'DESC')->get();

        $index_parcel = 1;
        $index_house = 1;
        $index_apartment = 1;
        return view('agents.show', compact(
            'agent',
            'index_parcel',
            'index_house',
            'index_apartment',
            'payments'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id == 1) {
            return abort(404);
        }
        $agent = User::find($id);
        return view('agents.edit', compact('agent'));
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
        $agent =  User::find($id);

        $request->validate([
            'trade_name' => 'required',
            'name' => 'required',
            'address' => 'required',
            'license' => 'required',
            'phone' => 'required',
            'whatsapp_phone' => 'max:9|min:9',
            'telegram_phone' => '',
            'personal_email' => '',
            'twitter_account' => '',
            'facebook_account' => '',
            'logo' => '',
            'password' => '',
            'email' => ['required', Rule::unique('users')->ignore($agent)],
            'status' => '',
            'subscription_end' => 'required'

        ], [
            'email.unique' => 'اسم المستخدم موجود مسبقا',
            'whatsapp_phone.max' => 'رقم الواتساب اطول من المطلوب',
            'whatsapp_phone.min' => 'رقم الواتساب اقصر من المطلوب',
        ]);
        $agent->trade_name = $request->trade_name;
        $agent->name = $request->name;
        $agent->address = $request->address;
        $agent->license = $request->license;
        $agent->phone = $request->phone;
        $agent->whatsapp_phone = $request->whatsapp_phone;
        $agent->telegram_phone = $request->telegram_phone;
        $agent->personal_email = $request->personal_email;
        $agent->twitter_account = $request->twitter_account;
        $agent->facebook_account = $request->facebook_account;
        $agent->email = $request->email;
        if ($request->password) {
            $agent->password = $request->password;
        }
        $agent->status = $request->status;
        $agent->subscription_end = $request->subscription_end;


        // Start of Upload Files
        $formFileName = "logo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            // Delete file if there is a new one
            if ($agent->$formFileName != "") {
                File::delete($this->uploadPath . $agent->$formFileName);
            }
            $fileFinalName = time() . rand(
                1111,
                9999
            ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
        }


        if ($fileFinalName != "") {
            $agent->logo = $fileFinalName;
        }

        $agent->save();

        toastr()->info('تم تعديل بيانات الوكيل العقاري ', 'نجاح');
        return redirect()->route('agent.edit', $agent->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        toastr()->info('تم حذف  الوكيل العقاري ', 'نجاح');
        return redirect()->route('agent.index');
    }


    public function payment($id)
    {
        $payment = Payment::find($id);
        return view('agents.payment', compact('payment'));
    }
}