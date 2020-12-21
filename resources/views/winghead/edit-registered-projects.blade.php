@extends('layouts.WingheadMaster')


@section('title')
Projects - Edit | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h2 class="card-title">{{$project->title}}</h2>
                <p class="card-category">Select and type on the fields that you want to edit</p>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                <form action="{{ url('project-register-update/'.$project->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                   
                         <!--Edit Description-->
                        <div class="form-group"> 
                            <label for="message-text" class="col-form-label text-primary">Project Description</label>
                            <samp>{!!$project->description!!}</samp>
                        <hr>
                        </div>
                         <!--Edit Developers-->
                        <div class="form-group">
                            <label for="message-text" class="col-form-label text-primary">Developers</label>
                            <br>
                            <samp>{!!$project->developers!!}</samp>
                            <hr>
                        </div>
                         <!--Edit Clients-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Clients</label>
                            <br>
                            <samp>{!!$project->clients!!}</samp>
                            <hr>
                        </div>
                         <!--Edit Start Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Start Date</label>
                            <br>
                            <samp>{!!$project->startdate!!}</samp>
                            <hr>
                        </div>
                         <!--Edit End Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">End Date</label>
                            <br>
                            <samp>{!!$project->enddate!!}</samp>
                            <hr>
                        </div>
                         <!--Update and Cancel Buttons-->
                        <a href="/project-register" class="btn btn-danger float-right" style="margin:20px;">Cancel</a>
                        <button type="submit" class="btn btn-info float-right" style="margin:20px;">Update</button>     
                </form>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection


