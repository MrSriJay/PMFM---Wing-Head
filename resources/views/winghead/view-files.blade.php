@extends('layouts.WingheadMaster')


@section('title')
Projects - View | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">  
            <div class="card-header card-header-primary">
                <h2 class="card-title">{{$project->title}}</h2>
                <p class="card-category">Click edit button to update project details</p>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                <form>
                      
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection