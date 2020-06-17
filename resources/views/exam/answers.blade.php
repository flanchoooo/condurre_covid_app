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
                                    <h1 class="h4 text-gray-900 mb-4">Q: {{session('question_text')}}</h1>
                                    <hr>
                                </div>
                                <a href="{{"/exam/create"}}"><label>Create</label> </a> <br>

                                <br>

                                <div class="box-body"  style="overflow-x:auto;">
                                    <!-- /.table-responsive -->
                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Correct</th>
                                            <th>Answer</th>
                                            <th></th>


                          ol              </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="odd gradeX">
                                                <td>{{$record->id}}</td>
                                                <td>@php
                                                       if($record->correct != 1){
                                                            echo 'FALSE';
                                                        }else{
                                                            echo 'TRUE';
                                                        }
                                                    @endphp</td>
                                                <td>{{$record->question_choice_text}}</td>

                                                <td>
                                                    <form role="form" action="/exam/questions/possible/answers" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$record->id}}"  name="id" >
                                                        <center><button type="submit" class="btn btn-primary">Possible Answers</button></center>
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

