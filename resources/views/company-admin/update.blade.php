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
                                    <h1 class="h4 text-gray-900 mb-4">Update {{session('name')}} Company Admin</h1>
                                    <hr>

                                    <script>
                                        $("document").ready(function () {
                                            setTimeout(function () {
                                                $("div.alert").remove();
                                            }, 2000); // 5 secs

                                        });
                                    </script>

                                    @if ($flash = session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif


                                    @if ($flash = session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif

                                </div>

                                <form method="POST" action="/company-admin/updates">
                                    @csrf
                                    <input id="id" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id"  value="{!! $companyAdmin->id !!}" required autofocus hidden >
                                    <div class="box-body">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">First Name</label>
                                                    <input id="mobile" type="text"
                                                           class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}"
                                                           name="name" required autofocus
                                                           @if (isset($companyAdmin->first_name)) value="{!! $companyAdmin->first_name !!}" @endif >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Middle Names</label>
                                                    <input id="middle_names" type="text"
                                                           class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}"
                                                           name="middle_names" required autofocus
                                                           @if (isset($companyAdmin->middle_names)) value="{!! $companyAdmin->middle_names !!}" @endif >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Last Name</label>
                                                    <input id="last_name" type="text"
                                                           class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}"
                                                           name="last_name" required autofocus
                                                           @if (isset($companyAdmin->last_name)) value="{!! $companyAdmin->last_name !!}" @endif >
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input id="email" type="email"
                                                           class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}"
                                                           name="email" required autofocus
                                                           @if (isset($companyAdmin->email)) value="{!! $companyAdmin->email !!}" @endif >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Password</label>
                                                    <input id="password" type="password"
                                                           class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}"
                                                           name="password" required autofocus>

                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <div class="form-group">
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
