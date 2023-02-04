@extends('layouts.main')
@section('content')
    <style>
        .checked {
            color: orange;
        }

        .icon-show {
            margin-left: 3px;
            text-align: center
        }
    </style>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> بيانات الوكيل العقاري </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            <!-- Current avatar -->
                            <img class="img-responsive avatar-view" src="{{ asset('uploads/agents/logo/' . $agent->logo) }}"
                                alt="user profile" title="Change the avatar">
                        </div>
                    </div>
                    <h3>{{ $agent->name }}</h3>

                    <ul class="list-unstyled user_data">
                        <li><i class="icon-show fa fa-building user-profile-icon"></i>
                            {{ $agent->trade_name }}
                        </li>

                        <li><i class="icon-show fa fa-thumb-tack  user-profile-icon"></i>
                            {{ $agent->address }}
                        </li>

                        <li><i class="icon-show fa fa-briefcase user-profile-icon"></i>
                            {{ $agent->license }}
                        </li>

                        <li><i class="icon-show fa fa-envelope user-profile-icon"></i>
                            {{ $agent->email }}
                        </li>

                        <li><i class="icon-show fa fa-phone user-profile-icon"></i>
                            {{ $agent->phone }}
                        </li>

                        <li><i class="icon-show fa fa-facebook user-profile-icon"></i>
                            {{ $agent->facebook_account }}
                        </li>

                        <li><i class="icon-show fa fa-twitter user-profile-icon"></i>
                            {{ $agent->twitter_account }}
                        </li>

                        <li><span class="">تاريخ نهاية الاشتراك</span>
                            <span style="color: red">{{ $agent->subscription_end }}</span>
                        </li>



                        {{-- <li> {{$hotel->location_ar}}</li> --}}

                        {{-- <li class="m-top-xs">
                        <i class="fa fa-external-link user-profile-icon"></i>
                        <a href="https://morteza-karimi.ir/" target="_blank">morteza-karimi.ir</a>
                    </li> --}}
                    </ul>

                    {{-- <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>&nbsp; پروفایل</a> --}}
                    {{-- <a href="{{route('hotels.edit',$hotel->id)}}" class="btn btn-success"><i
                        class="fa fa-edit m-right-xs"></i>&nbsp;تعديل بيانات الفندق</a> --}}

                    <br>

                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#parcel" id="home-tab" role="tab"
                                    data-toggle="tab" aria-expanded="false">قطع الاراضي</a>
                            </li>
                            <li role="presentation" class=""><a href="#house" role="tab" id="profile-tab"
                                    data-toggle="tab" aria-expanded="true">المنازل</a>
                            </li>

                            <li role="presentation" class=""><a href="#appartment" role="tab" id="profile-tab"
                                    data-toggle="tab" aria-expanded="true">الشقق السكنية</a>
                            </li>

                            <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab"
                                    data-toggle="tab" aria-expanded="true">البيانات الشخصية</a>
                            </li>

                            <li role="presentation" class=""><a href="#payment" role="tab" id="profile-tab"
                                    data-toggle="tab" aria-expanded="true">اشعارات الدفع</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="parcel" aria-labelledby="home-tab">

                                <!-- start recent activity -->
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>الرقم</th>
                                            <th>نوع القطعة</th>
                                            <th>رقم القطعة</th>
                                            <th>المدينة</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($agent->parcel as $item)
                                            <tr>
                                                <td>
                                                    {{ $index_parcel }}
                                                </td>
                                                <td>{{ $item->type->name }}</td>
                                                <td>{{ $item->parcels_number }}</td>
                                                <td>{{ $item->city->name }}</td>
                                                <td>
                                                    <form action="{{ route('parcel.destroy', $item->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#show-parcel-{{ $item->id }}"><i
                                                                class="fa fa-eye"></i>
                                                        </button>
                                                        <a href="{{ route('parcel.edit', $item->id) }}"
                                                            class="btn btn-sm btn-success"><i
                                                                class="fa fa-edit m-right-xs"></i>&nbsp; </a>
                                                        <button type="button" class="show_confirm btn btn-sm btn-danger"><i
                                                                class="fa fa-remove m-right-xs"></i>&nbsp; </button>
                                                    </form>

                                                </td>
                                            </tr>
                                            <!--- Show Model -->
                                            <div class="modal fade" id="show-parcel-{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span
                                                                    aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel">بيانات قطعة الارض
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-unstyled msg_list">
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الوكيل</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->user->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الولاية</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->city->state->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المدينة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->city->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الحي</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->neighborhood }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المربع</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->square }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>نوع القطعة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->type->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الدرجة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->degree }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>مساحة القطعة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ number_format($item->space) }}
                                                                            {{ $item->spaceType->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>السعر</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ number_format($item->price) }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المميزات</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->features }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>تصنيف القطعة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->category->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الصورة</span>
                                                                        </span>
                                                                        @isset($item->image->photo)
                                                                            <img style="width: 60%"
                                                                                src="{{ asset('uploads/parcels/' . $item->image->photo) }}">
                                                                        @else
                                                                            <span class="message">
                                                                                لا يوجد صورة حاليا
                                                                            </span>
                                                                        @endisset


                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>تاريخ الاضافة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->created_at }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">اغلاق</button>
                                                            {{-- <button type="button" class="btn btn-primary">ذخیره
                                                    تغییرات</button> --}}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end show Model -->
                                        @endforeach


                                    </tbody>
                                </table>
                                <!-- end recent activity -->

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="house" aria-labelledby="profile-tab">

                                <!-- start user projects -->

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>الرقم</th>
                                            <th>رقم المنزل</th>
                                            <th>النوع</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($agent->house as $item)
                                            <tr>
                                                <td>{{ $index_house++ }}</td>
                                                <td>{{ $item->house_number }}</td>
                                                <td>
                                                    @if ($item->type == 1)
                                                        ايجار
                                                    @else
                                                        بيع
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('houses.destroy', $item->id) }}"
                                                        method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#show-house-{{ $item->id }}"><i
                                                                class="fa fa-eye"></i>
                                                        </button>
                                                        <a href="{{ route('houses.edit', $item->id) }}"
                                                            class="btn btn-sm btn-success"><i
                                                                class="fa fa-edit m-right-xs"></i>&nbsp; </a>
                                                        <button type="button"
                                                            class="show_confirm btn btn-sm btn-danger"><i
                                                                class="fa fa-remove m-right-xs"></i>&nbsp; </button>
                                                    </form>

                                                </td>
                                            </tr>
                                            <!--- Show Model -->
                                            <div class="modal fade" id="show-house-{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel">بيانات المنزل </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-unstyled msg_list">
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الولاية</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->city->state->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المدينة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->city->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الحي</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->neighborhood }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المربع</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->square }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>رقم المنزل</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->house_number }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الدرجة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->degree }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>مساحة المنزل</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ number_format($item->space) }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>النوع </span>
                                                                        </span>
                                                                        <span class="message">
                                                                            @if ($item->type == 1)
                                                                                ايجار
                                                                            @else
                                                                                بيع
                                                                            @endif
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>السعر</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ number_format($item->price) }}
                                                                            @if ($item->type == 1)
                                                                                @switch($item->rental)
                                                                                    @case('daily')
                                                                                        يوميا
                                                                                    @break

                                                                                    @case('monthly')
                                                                                        شهريا
                                                                                    @break

                                                                                    @case('yearly')
                                                                                        سنويا
                                                                                    @break
                                                                                @endswitch
                                                                            @endif
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المميزات</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->features }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الصورة</span>
                                                                        </span>
                                                                        @isset($item->image->photo)
                                                                            <img style="width: 60%"
                                                                                src="{{ asset('uploads/houses/' . $item->image->photo) }}">
                                                                        @else
                                                                            <span class="message">
                                                                                لا يوجد صورة حاليا
                                                                            </span>
                                                                        @endisset
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>تاريخ الاضافة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->created_at }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">اغلاق</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end show Model -->
                                        @endforeach


                                    </tbody>
                                </table>
                                <!-- end user projects -->

                            </div>
                            <div role="tabpanel" class="tab-pane fade " id="appartment" aria-labelledby="profile-tab">

                                <!-- start user projects -->

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>الرقم</th>
                                            <th>رقم الشقة</th>
                                            <th>النوع</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($agent->apartment as $item)
                                            <tr>
                                                <td>{{ $index_apartment++ }}</td>

                                                <td>{{ $item->apartment_number }}</td>
                                                <td>
                                                    @if ($item->type == 1)
                                                        ايجار عادي
                                                    @else
                                                        ايجار مفروش
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('apartments.destroy', $item->id) }}"
                                                        method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#show-apartment-{{ $item->id }}"><i
                                                                class="fa fa-eye"></i>
                                                        </button>
                                                        <a href="{{ route('apartments.edit', $item->id) }}"
                                                            class="btn btn-sm btn-success"><i
                                                                class="fa fa-edit m-right-xs"></i>&nbsp; </a>
                                                        <button type="button"
                                                            class="show_confirm btn btn-sm btn-danger"><i
                                                                class="fa fa-remove m-right-xs"></i>&nbsp; </button>
                                                    </form>

                                                </td>
                                            </tr>
                                            <!--- Show Model -->
                                            <div class="modal fade" id="show-apartment-{{ $item->id }}"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel">بيانات الشقة </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-unstyled msg_list">
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الولاية</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->city->state->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المدينة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->city->name }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الحي</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->neighborhood }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المربع</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->square }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>رقم الشقة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->apartment_number }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>مساحة الشقة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ number_format($item->space) }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>النوع </span>
                                                                        </span>
                                                                        <span class="message">
                                                                            @if ($item->type == 1)
                                                                                ايجار عادي
                                                                            @else
                                                                                ايجار مفروش
                                                                            @endif
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>السعر</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ number_format($item->price) }}
                                                                            @switch($item->rental)
                                                                                @case('daily')
                                                                                    يوميا
                                                                                @break

                                                                                @case('monthly')
                                                                                    شهريا
                                                                                @break

                                                                                @case('yearly')
                                                                                    سنويا
                                                                                @break
                                                                            @endswitch
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>المميزات</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->features }}
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>الصورة</span>
                                                                        </span>
                                                                        @isset($item->image->photo)
                                                                            <img style="width: 60%"
                                                                                src="{{ asset('uploads/apartments/' . $item->image->photo) }}">
                                                                        @else
                                                                            <span class="message">
                                                                                لا يوجد صورة حاليا
                                                                            </span>
                                                                        @endisset
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a>
                                                                        <span>
                                                                            <span>تاريخ الاضافة</span>
                                                                        </span>
                                                                        <span class="message">
                                                                            {{ $item->created_at }}
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">اغلاق</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end show Model -->
                                        @endforeach


                                    </tbody>
                                </table>
                                <!-- end user projects -->

                            </div>

                            <div role="tabpanel" class="tab-pane fade " id="profile" aria-labelledby="profile-tab">

                                <!-- start user projects -->

                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th colspan="2"><a href="{{ route('agent.edit', $agent->id) }}">اضغط هنا
                                                لتعديل البيانات</a></th>
                                    </tr>
                                    <tr>
                                        <th>الاسم التجاري </th>
                                        <td>{{ $agent->trade_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>اسم الوكيل </th>
                                        <td>{{ $agent->name }}</td>
                                    </tr>

                                    <tr>
                                        <th>العنوان </th>
                                        <td>{{ $agent->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>الترخيص </th>
                                        <td>{{ $agent->license }}</td>
                                    </tr>
                                    <tr>
                                        <th>رقم الهاتف </th>
                                        <td>{{ $agent->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>رقم الواتساب </th>
                                        <td>{{ $agent->whatsapp_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>رقم التلغرام </th>
                                        <td>{{ $agent->telegram_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>البريد الالكتروني </th>
                                        <td>{{ $agent->personal_email }}</td>
                                    </tr>
                                    <tr>
                                        <th>حساب تويتر </th>
                                        <td>{{ $agent->twitter_account }}</td>
                                    </tr>
                                    <tr>
                                        <th> حساب الفيسبوك </th>
                                        <td>{{ $agent->facebook_account }}</td>
                                    </tr>
                                    <tr>
                                        <th> الشعار </th>
                                        <td>
                                            <img style="width: 150px; height: 150px; object-fit: cover;"
                                                src="{{ asset('uploads/agents/logo/' . $agent->logo) }}"
                                                alt="لا يوجد حاليا" srcset="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> اسم المستخدم </th>
                                        <td>{{ $agent->email }}</td>
                                    </tr>
                                    <tr>
                                        <th> الحالة </th>
                                        <td>
                                            <input disabled readonly name="status"
                                                {{ $agent->status == 'on' ? 'checked' : '' }} type="checkbox"
                                                class="js-switch" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> تاريخ نهاية الاشتراك </th>
                                        <td>{{ $agent->subscription_end }}</td>
                                    </tr>
                                    <tr>
                                        <th> وثيقة شخصية </th>
                                        <td>
                                            <img style="width: 150px; height: 150px; object-fit: cover;"
                                                src="{{ asset('uploads/agents/' . $agent->personal_document_image) }}"
                                                alt="لا يوجد  حاليا" srcset="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> الرخصة التجارية </th>
                                        <td>
                                            <img style="width: 150px; height: 150px; object-fit: cover;"
                                                src="{{ asset('uploads/agents/' . $agent->commercial_license_image) }}"
                                                alt="لا يوجد  حاليا" srcset="">
                                        </td>
                                    </tr>

                                </table>
                                <!-- end user projects -->

                            </div>

                            <div role="tabpanel" class="tab-pane fade " id="payment" aria-labelledby="profile-tab">

                                <!-- start user projects -->

                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>التاريخ</th>
                                        <th>صورة الاشعار</th>
                                    </tr>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->created_at }}</td>
                                            <td>
                                                <a href="{{ route('payment', $payment->id) }}">الاشعار</a>
                                            </td>
                                        </tr>
                                    @endforeach


                                    {{-- <tr>
                                        <th> وثيقة شخصية </th>
                                        <td>
                                            <img style="width: 150px; height: 150px; object-fit: cover;"
                                                src="{{ asset('uploads/agents/' . $agent->personal_document_image) }}"
                                                alt="لا يوجد  حاليا" srcset="">
                                        </td>
                                    </tr> --}}


                                </table>
                                <!-- end user projects -->

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
