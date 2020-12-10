@extends('layouts.WingheadMaster')


@section('title')
Projects - Edit | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h2 class="card-title">Project Details</h2>
                <p class="card-category">Select and type on the fields that you want to edit</p>
            </div>
            <div class="card-body">
                <div class="col-md-12 py-3">

                <form action="{{ url('project-register-update/'.$project->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                         <!--Edit Project Title-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Project Title</label>
                            <input type="text" name="projecttitle" class="form-control @error('projecttitle') is-invalid @enderror" required id="projecttitle" value="{{$project->title}}">
                            @error('projecttitle')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--Edit Description-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required id="description" rows="6" cols="5">{{$project->description}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--Edit Developers-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Developers</label>
                            <textarea type="text" name ="developers" class="form-control @error('developers') is-invalid @enderror" required id="developers">{{$project->developers}}</textarea>
                            @error('developers')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--Edit Clients-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label">Clients</label>
                            <textarea type="text" name ="clients" class="form-control @error('clients') is-invalid @enderror" required id="clients">{{$project->clients}}</textarea>
                            @error('clients')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--Edit Start Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Start Date</label>
                            <input type="date" name="startdate" class="form-control @error('startdate') is-invalid @enderror" required placeholder="Select date" id="startdate" value="{{$project->startdate}}">
                            @error('startdate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                         <!--Edit End Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">End Date</label>
                            <input type="date" name="enddate" class="form-control @error('enddate') is-invalid @enderror" required placeholder="Select date" id="enddate" value="{{$project->enddate}}">
                            @error('enddate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
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


