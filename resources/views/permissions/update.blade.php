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
                                    <h1 class="h4 text-gray-900 mb-4">Update Role Profile</h1>
                                    <hr>

                                    @if ($flash = session('message'))
                                        <div  class="alert alert-success" role="alert">
                                            {{$flash}}
                                        </div>
                                    @endif
                                </div>

                                <form method="POST" action="/permissions/update_profile" aria-label="{{ __('Add Product') }}">
                                    @csrf

                                    <div class="box-body">
                                        @foreach($records as $rec)
                                            <div class="form-group" hidden>
                                                <label for="exampleInputEmail1">Role Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="id" value="{{$rec->id}}" required autofocus>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Role Name</label>
                                                <input id="mobile" type="text" class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="role_name" value="{{$rec->role_name}}" required autofocus>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Role Status</label>
                                                <select id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="" required autofocus  >
                                                    <option value="1">ACTIVE</option>
                                                    <option value="0">IN-ACTIVE</option>
                                                </select>
                                            </div>


                                            <div class="form-group row">

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                @php if($rec->dashboard != 'on'){
                                                        echo '<input type="checkbox" name="dashboard" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="dashboard" value="on" checked>';
                                                        } @endphp

                                                                {{ __('Dashboard & Reports') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                @php if($rec->loans_approve != 'on'){
                                                        echo '<input type="checkbox" name="loans_approve" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="loans_approve" value="on" checked>';
                                                        } @endphp

                                                                {{ __('Approve Loans') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                @php if($rec->loans_authorize != 'on'){
                                                        echo '<input type="checkbox" name="loans_authorize" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="loans_authorize" value="on" checked>';
                                                        } @endphp

                                                                {{ __('Authorize Loans') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                @php if($rec->loans_profile != 'on'){
                                                        echo '<input type="checkbox" name="loans_profile" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="loans_profile" value="on" checked>';
                                                        } @endphp

                                                                {{ __('View  Loan Profiles') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                @php if($rec->loan_configurations != 'on'){
                                                        echo '<input type="checkbox" name="loan_configurations" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="loan_configurations" value="on" checked>';
                                                        } @endphp

                                                                {{ __('Loan Profiles Configurations') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->transaction_manager != 'on'){
                                                        echo '<input type="checkbox" name="transaction_manager" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="transaction_manager" value="on" checked>';
                                                        } @endphp

                                                            {{ __('System Configurations') }}
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            @php if($rec->users != 'on'){
                                                        echo '<input type="checkbox" name="users" value="on" >';
                                                        }else{
                                                        echo '<input type="checkbox" name="users" value="on" checked>';
                                                        } @endphp

                                                            {{ __('User Management') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    @endforeach
                                    <!-- /.box-body -->
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
