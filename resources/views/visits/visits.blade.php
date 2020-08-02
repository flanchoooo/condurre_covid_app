@extends('layouts.tab')


@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-11">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0"><!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Visits Report</h1>
                                    <hr>
                                </div>

                                <div class="box-body"  style="overflow-x:auto;">
                                    <!-- /.table-responsive -->
                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>QR Ref</th>
                                            <th>Visitor</th>
                                            <th>Admin</th>
                                            <th>Temp</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td>{{$record->id}}</td>
                                                <td>{{$record->qr_code}}</td>
                                                <td>@php
                                                        $name = \App\Visitor::find($record->visitor_id);
                                                        echo $name["first_name"] .' '. $name["last_name"];
                                                    @endphp
                                                </td>
                                                <td>@php
                                                    $name = \App\CompanyAdmin::find($record->company_admin_id);
                                                    echo $name["first_name"] .' '. $name["last_name"];
                                                    @endphp
                                                </td>
                                                <td>{{$record->temperature}}</td>
                                                <td>{{$record->created_date}}</td>
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
        </div>
    </div>
@endsection

