@extends('layouts.WingheadMaster')


@section('title')
Projects - Files | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">  
            <div class="card-header card-header-primary">
                <h2 class="card-title">{{$project->title}}</h2>
                <p class="card-category"></p>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                <iframe src="{{url('public/storage/project_files/'.$project->title.'/',$project->files)}}"></iframe>
                      
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection