@extends('layouts.main')

{{-- --}}


@section('content')
{{-- @include('sweetalert::alert') --}}
<div class="x_panel">
    <div class="x_title">
        <h2>تعديل بيانات الاعلان
            {{-- <small> </small> --}}
        </h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br />
        <form method="POST" action="{{route('ads.update',$ad->id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
            @csrf
            @method('put')

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم الشركة
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name" id="name" value="{{$ad->name}}" required="required" class="form-control col-md-7 col-xs-12"
                        value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start"> تاريخ البداية
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="date" name="start" id="start"  value="{{$ad->start}}" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end"> تاريخ النهاية
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="date" name="end" id="end" value="{{$ad->end}}" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-4">
                    <img style="width: 150px; height: 150px; object-fit: cover;"  src="{{asset('uploads/ad/'.$ad->photo)}}" alt="لا يوجد صورة حاليا" srcset="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo"> صورة الاعلان
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="photo" id="photo" 
                        class="form-control col-md-7 col-xs-12" value="">
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
