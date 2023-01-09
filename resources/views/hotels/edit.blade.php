@extends('layouts.main')

{{-- --}}


@section('content')
{{-- @include('sweetalert::alert') --}}
<div class="x_panel">
    <div class="x_title">
        <h2> تعديل بيانات الفندق
            {{-- <small> </small> --}}
        </h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br />
        <form method="POST" action="{{route('hotels.update',$hotel->id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
            @csrf
            @method('put')

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="neighborhood"> الوكيل
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input  value="{{$hotel->user->name}}" readonly
                        class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            @livewire('edit-select-state',['model'=> 'hotels','item_id' => $hotel->id])

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="neighborhood"> الحي
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="{{$hotel->neighborhood}}" type="text" name="neighborhood" id="neighborhood" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم الفندق
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text"  value="{{$hotel->name}}" name="name" id="name" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            {{-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="square"> المربع
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="{{$hotel->square}}" type="text" name="square" id="square" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div> --}}


            {{-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parcels_number">رقم المنزل
                    <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="{{$hotel->apartment_number}}" type="text" name="apartment_number" id="parcels_number"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="space">مساحة المنزل
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input value="{{$hotel->space}}" type="number" name="space" id="space" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div> --}}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> النوع
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select  name="type" required="required" class="form-control col-md-7 col-xs-12">
                        <option  value="">اختر النوع</option>
                        <option {{$hotel->type == "1"? "selected":""}} value="1">شقة</option>
                        <option {{$hotel->type == "2"? "selected":""}} value="2">جناح</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> السعر
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <input value="{{$hotel->price}}" type="number"  name="price" id="price" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>

            </div>

            {{-- @livewire('apartment-type', ['apartment_id' => $hotel->id]) --}}




            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="features"> المميزات
                    <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea rows="5" name="features"  id="features" required
                        class="form-control col-md-7 col-xs-12" >{{$hotel->features}}</textarea>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-4">
                    <img style="width: 150px; height: 150px; object-fit: cover;"  src="{{$hotel->image ?  asset('uploads/hotels/'.$hotel->image->photo) : ''}}" alt="لا يوجد صورة حاليا" srcset="">
                </div>
            </div>


            <div class="form-group" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >  الصورة
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input style="padding-top: 5px !important" type="file" name="photo"
                            class="form-control col-md-7 col-xs-12" >
                </div>
            </div>


            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    {{-- <button type="submit" class="btn btn-primary">انصراف</button> --}}
                    <button type="" id="Swal" class="btn btn-success btn-block">تعديل</button>
                </div>
            </div>

        </form>


    </div>
</div>

@endsection
