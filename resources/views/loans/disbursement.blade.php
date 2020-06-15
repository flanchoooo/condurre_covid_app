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
                                    <h1 class="h4 text-gray-900 mb-4">Loans Pending Disbursements</h1>

                                    <hr>
                                </div>


                                <a href="{{"/loans/disburse"}}"><label>Disburse</label> </a> <br>

                                <br>

                                <div class="box-body"  style="overflow-x:auto;">

                                    <!-- /.table-responsive -->

                                    <table class="table responsive" id="example" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>


                                            <th>ID</th>
                                            <th>Applicant</th>
                                            <th>Tenure</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Created</th>
                                            <th>Description</th>



                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $values)
                                            <tr class="odd gradeX">
                                                <td>{{$values->id}}</td>
                                                <td>@php

                                                        $result = \App\LendingKYC::whereId($values->applicant_id)->first();
                                                         echo $result["first_name"] . ' '. $result["last_name"]
                                                    @endphp</td>
                                                <td>{{$values->tenure}}</td>
                                                <td>{{$values->status}}</td>
                                                <td>{{$values->amount}}</td>
                                                <td>{{$values->created_at}}</td>
                                                <td>{{$values->description}}</td>
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

