@extends('layouts.main')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Company</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Company</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        {!! Form::model($model,['method'=>'PUT','route'=>['master.company.update',$model->id]]) !!}
            @include('masters::company._form')
        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
