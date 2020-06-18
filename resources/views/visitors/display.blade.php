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
                                    <h1 class="h4 text-gray-900 mb-4">Visitors</h1>
                                    <hr>
                                </div>

                                <div class="box-body"  style="overflow-x:auto;">
                                    <!-- /.table-responsive -->
                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Middle Names</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Active</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td>{{$record->id}}</td>
                                                <td>{{$record->first_name}}</td>
                                                <td>{{$record->middle_names}}</td>
                                                <td>{{$record->last_name}}</td>
                                                <td>{{$record->email}}</td>
                                                @if ($record->enabled=== true)
                                                    <td>
                                                        <input type="checkbox" id="scales" name="scales" checked disabled>
                                                    </td>
                                                @else
                                                    <td>
                                                        <input type="checkbox" id="scales" name="scales" disabled>
                                                    </td>
                                                @endif
                                                <td>
                                                    <form role="form" action="/visitor-edit" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control" value="{{$record->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-success">Edit</button></center>
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
        </div>
    </div>
@endsection

