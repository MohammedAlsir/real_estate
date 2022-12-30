@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> الاعلانات
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
                                    <th>اسم الشركة </th>
                                    <th>صورة الاعلان</th>
                                    <th>تاريخ البداية</th>
                                    <th>تاريخ النهاية</th>
                                    <th>تاريخ الاضافة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach ($ads as $item)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <img style="width: 50px; height: 50px; object-fit: cover;"  src="{{asset('uploads/ad/'.$item->photo)}}" alt="لا يوجد صورة حاليا" srcset="">
                                        </td>
                                        <td>{{$item->start}}</td>
                                        <td>{{$item->end}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <form action="{{route('ads.destroy',$item->id)}}" method="POST">
                                                {{ csrf_field()}}
                                                {{ method_field('delete') }}
                                                <a href="{{route('ads.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit m-right-xs"></i>&nbsp; </a>
                                                <button type="button" class="show_confirm btn btn-sm btn-danger"><i class="fa fa-remove m-right-xs"></i>&nbsp; </button>
                                            </form>

                                        </td>
                                    </tr>
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
