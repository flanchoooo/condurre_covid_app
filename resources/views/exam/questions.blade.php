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
                                    <h1 class="h4 text-gray-900 mb-4">Exam Questions</h1>
                                    <hr>
                                </div>
                                <br>
                                <div class="box-body"  style="overflow-x:auto;">
                                    <!-- /.table-responsive -->
                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Question</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)`
                                            <tr class="odd gradeX">
                                                <td>{{$record->id}}</td>
                                                <td>{{$record->question_text}}</td>

                                                <td>
                                                    <form role="form" action="/possible/answers" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->question_text}}"  name="question_text" >
                                                        <center><button type="submit" class="btn btn-primary">View Answers</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/exam/create/answers" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->question_text}}"  name="question_text" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-success">Add Answers</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/exam/update/questions" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->question_text}}"  name="question_text" >
                                                        <center><button type="submit" class="btn btn-primary">Edit Question</button></center>
                                                    </form>
                                                </td>

                                                <td>
                                                    <form role="form" action="/questions/delete" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-danger">Delete Question</button></center>
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

