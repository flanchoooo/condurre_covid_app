@extends('layouts.tab')

@section('content')
    <add-question token="{{session('token')}}" exam="{{session('examId')}}"></add-question>
@endsection
