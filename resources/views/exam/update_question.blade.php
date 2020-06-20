@extends('layouts.tab')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Update Q: {{session('question_text')}}</h1>
                                    <hr>

                                    <script>
                                        $("document").ready(function(){
                                            setTimeout(function(){
                                                $("div.alert").remove();
                                            },9000 ); // 5 secs

                                        });
                                    </script>

                                    @if ($flash = session('error'))
                                        <div  class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif


                                    @if ($flash = session('success'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                </div>

                                <form method="POST" action="/exam/updates/questions">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Question</label>
                                                    <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="question_text"   value="{{session('question_text')}}" required autofocus >
                                                </div>
                                            </div>

                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Question</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="question_id"  value="{{session('id')}}" required autofocus >
                                            </div>

                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Question</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="exam_id"  value="{{session('exam_id')}}" required autofocus >
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Difficulty Level</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="difficult_level"  required autofocus >
                                                        <option value="EASY">EASY</option>
                                                        <option value="MEDIUM">MEDIUM</option>
                                                        <option value="DIFFICULT">DIFFICULT</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Question Status</label>
                                                    <select id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="active"  required autofocus >
                                                        <option value="true">ACTIVE</option>
                                                        <option value="false">IN-ACTIVE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">   {{ __('Submit') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
