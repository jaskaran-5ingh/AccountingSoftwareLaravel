@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create {!! getCurrentRouteTitle() !!}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>{!! getCurrentRouteTitle() !!}</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        {!! Form::open(['route' => 'reports.trial-balance-master']) !!}
        @include('reports::trial-balance._form')
        {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
