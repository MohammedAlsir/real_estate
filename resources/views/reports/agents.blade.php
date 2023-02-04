@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-6">
                        <h2>الوكلاء العقاريون </h2>
                    </div>

                    <div class="col-md-6">
                        <form action="{{ route('agents') }}" method="get">
                            <select onchange="submit()" class="form-control col-md-7 col-xs-12" name="status">
                                <option {{ $status == 'pending' ? 'selected' : '' }} value="pending">قيد الانتظار
                                <option {{ $status == 'on' ? 'selected' : '' }} value="on">نشطين</option>
                                <option {{ $status == '' ? 'selected' : '' }} value="">محظورين</option>
                            </select>
                        </form>
                    </div>
                </div>

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
                                        <th>الحالة</th>
                                        <th>تاريخ الاضافة</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($agents as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><a href="{{ route('agent.show', $item->id) }}">{{ $item->name }}</a></td>
                                            <td>{{ $item->trade_name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                @if ($item->status == 'pending')
                                                    قيد الانتظار
                                                @elseif ($item->status == '')
                                                    محظور
                                                @else
                                                    نشط
                                                @endif

                                            </td>
                                            <td>{{ $item->created_at }}</td>

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
