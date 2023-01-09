@extends('layouts.main')

{{-- --}}


@section('content')
{{-- @include('sweetalert::alert') --}}
<div class="x_panel">
    <div class="x_title">
        <h2>إضافة فندق جديد
            {{-- <small> </small> --}}
        </h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br />
        <form method="POST" action="{{route('hotels.store')}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
            @csrf

            @livewire('select-state')

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="neighborhood"> الحي
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="neighborhood" id="neighborhood" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم الفندق
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name" id="name" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>


            {{-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parcels_number">رقم الشقة
                    <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="apartment_number" id="parcels_number"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div> --}}

            {{-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="space">مساحة الشقة
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" name="space" id="space" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div> --}}

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> النوع
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select  name="type" required="required" class="form-control col-md-7 col-xs-12">
                        <option value="">اختر النوع</option>
                        <option value="1">شقة</option>
                        <option value="2">جناح</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"> السعر
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="number"  name="price" id="price" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            {{-- @livewire('apartment-type', ['apartment_id' => '']) --}}



            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="features"> المميزات
                    <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea rows="5" name="features"  id="features" required
                        class="form-control col-md-7 col-xs-12" ></textarea>
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
                    <button type="" id="Swal" class="btn btn-success btn-block">إضافة</button>
                </div>
            </div>

        </form>


    </div>
</div>

@endsection
