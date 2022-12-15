@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>الوكلاء العقاريون
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
                                    <th>اسم الوكيل </th>
                                    <th>الاسم التجاري</th>
                                    <th>رقم الهاتف</th>
                                    <th>تاريخ الاضافة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach ($agents as $item)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->trade_name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <form action="{{route('agent.destroy',$item->id)}}" method="POST">
                                                {{ csrf_field()}}
                                                {{ method_field('delete') }}
                                                <a href="{{route('agent.show',$item->id)}}" class="btn btn-primary sm-btn-sm btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route('agent.edit',$item->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit m-right-xs"></i>&nbsp; </a>
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
