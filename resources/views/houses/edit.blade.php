@extends('layouts.main')

{{-- --}}


@section('content')
{{-- @include('sweetalert::alert') --}}
<div class="x_panel">
    <div class="x_title">
        <h2>تعديل بيانات المنزل
            {{-- <small> </small> --}}
        </h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br />
        <form method="POST" action="{{route('houses.update',$house->id)}}"  enctype="multipart/form-data" class="form-horizontal form-label-left">
            @csrf
            @method('put')

            @livewire('edit-select-state',['model'=> 'House','item_id' => $house->id])


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="neighborhood"> الحي
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="{{$house->neighborhood}}" name="neighborhood" id="neighborhood" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="square"> المربع
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="{{$house->square}}" name="square" id="square" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parcels_number">رقم المنزل
                    <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="{{$house->house_number}}" name="house_number" id="parcels_number"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="degree"> الدرجة
                    <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="{{$house->degree}}" name="degree" id="degree"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="space">مساحة المنزل
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" value="{{$house->space}}" name="space" id="space" required="required"
                        class="form-control col-md-7 col-xs-12" value="">
                </div>
            </div>



            @livewire('house-type',['house_id'=>$house->id])

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="features"> المميزات
                    <span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea rows="5" name="features"  id="features"
                        class="form-control col-md-7 col-xs-12" >{{$house->features}}</textarea>
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
