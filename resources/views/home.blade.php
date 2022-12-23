@extends('layouts.main')
@section('content')
<style>
    .icon_style{
        display: block !important;
        text-align: center;
        font-size: 40px !important;
    }
</style>


<div class="row top_tiles">
    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-users"></i></div>
            <div class="count">{{number_format($agent_nonactive + $agent_active)}}</div>
            <h3>الوكلاء</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-user"></i></div>
            <div class="count">{{number_format($agent_active)}}</div>
            <h3>الوكلاء النشطين</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-user-o"></i></div>
            <div class="count">{{number_format($agent_nonactive)}}</div>
            <h3>الوكلاء المحظورين</h3>
        </div>
    </div>
    {{-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square-o"></i></div>
            <div class="count">179</div>
            <h3>ثبت نام ها جدید</h3>
            <p>لورم ایپسوم متن ساختگی با.</p>
        </div>
    </div> --}}
</div>


@endsection

