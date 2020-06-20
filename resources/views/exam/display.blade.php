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
                                    <h1 class="h4 text-gray-900 mb-4">Create Exam</h1>
                                    <hr>
                                </div>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },10000 ); // 5 secs

                                    });
                                </script>

                                @if ($flash = session('error'))
                                    <div  class="alert alert-danger" role="alert">
                                        <center>{{$flash}}</center>
                                    </div>
                                @endif

                                <a href="{{"/exam/create"}}"><label>Create</label> </a> <br>

                                <br>

                                <div class="box-body"  style="overflow-x:auto;">
                                    <!-- /.table-responsive -->
                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Company Name</th>
                                            <th>Exam</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td>{{$record->id}}</td>
                                                <td>{{$record->company_name}}</td>
                                                <td>{{$record->exam_title}}</td>
                                                <td>
                                                    <form role="form" action="/exam/questions" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-primary">View Questions</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/exam/create/questions" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-success">Create Questions</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/exam/delete" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-danger">Delete Exam</button></center>
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

