@extends('layouts.tab')


@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-11">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Loan Class of Service</h1>

                                    <hr>
                                </div>


                                <a href="{{"/loans/cos/create"}}"><label>Create Class of Service</label> </a> <br>

                                <br>

                                <div class="box-body"  style="overflow-x:auto;">
                                    <!-- /.table-responsive -->
                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Formula</th>
                                            <th>Interest Rate %</th>
                                            <th>Created</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>{{$values->formula}}</td>
                                                <td>{{$values->interest_rate}}</td>
                                                <td>{{$values->created_at}}</td>
                                                <td>
                                                    <form role="form" action="/loan/cos/id" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{  Auth::user()->id }}"  name="created_by" >
                                                        <center><button  type="submit" class="btn btn-success">   {{ __('Edit') }}</button></center>
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

