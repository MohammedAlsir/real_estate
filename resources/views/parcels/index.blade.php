@extends('layouts.main')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2> قطع اراضي {{Helper::GeneralSiteSettings('name')}}
                {{-- <small>کاربران</small> --}}
            </h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">


                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>نوع القطعة</th>
                                    <th>رقم القطعة</th>
                                    <th>الولاية</th>
                                    <th>المدينة</th>
                                    <th>تاريخ الاضافة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($parcel as $item)
                                <tr>
                                    <td>{{$index++}}</td>
                                    <td>{{$item->type->name}}</td>
                                    <td>{{$item->parcels_number}}</td>
                                    <td>{{$item->city->state->name}}</td>
                                    <td>{{$item->city->name}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <form action="{{route('parcel.destroy',$item->id)}}" method="POST">
                                            {{ csrf_field()}}
                                            {{ method_field('delete') }}
                                            <button type="button" class="btn btn-primary sm-btn-sm btn-sm"
                                                data-toggle="modal" data-target="#show-{{$item->id}}"><i
                                                    class="fa fa-eye"></i>
                                            </button>
                                            <a href="{{route('parcel.edit',$item->id)}}"
                                                class="btn btn-sm btn-success"><i
                                                    class="fa fa-edit m-right-xs"></i>&nbsp; </a>
                                            <button type="button" class="show_confirm btn btn-sm btn-danger"><i
                                                    class="fa fa-remove m-right-xs"></i>&nbsp; </button>
                                        </form>

                                    </td>
                                </tr>
                                <!--- Show Model -->
                                <div class="modal fade" id="show-{{$item->id}}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                        aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">بيانات قطعة الارض </h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled msg_list">
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الولاية</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->city->state->name}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>المدينة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->city->name}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الحي</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->neighborhood}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>المربع</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->square}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>نوع القطعة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->type->name}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>الدرجة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->degree}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>مساحة القطعة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{number_format($item->space)}} {{$item->spaceType->name}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>السعر</span>
                                                            </span>
                                                            <span class="message">
                                                                {{number_format($item->price)}}
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>المميزات</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->features}}
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>تصنيف القطعة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->category->name}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a>
                                                            <span>
                                                                <span>تاريخ الاضافة</span>
                                                            </span>
                                                            <span class="message">
                                                                {{$item->created_at}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
