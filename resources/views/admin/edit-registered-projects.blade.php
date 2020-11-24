@extends('layouts.TableMaster')


@section('title')
Projects - Edit | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <!--<a href="" class="btn btn-info float-right py-2">ADD</a>-->
                <h4 class="card-title">Edit Project Details</h4>
                <p class="card-category">Select and type on the text-boxes that you want to edit</p>
            </div>
            <div class="card-body">
                <div class="col-md-6 py-3">

                <form action="{{ url('project-register-update/'.$project->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label">Project Title</label>
                            <input type="text" name ="projecttitle" class="form-control @error('projecttitle') is-invalid @enderror" required id="projecttitle" value="{{$project->title}}">
                            @error('projecttitle')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required id="description" rows="6" cols="5">{{$project->description}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label">Client</label>
                            <input type="text" name ="client" class="form-control @error('client') is-invalid @enderror" required id="client" value="{{$project->client}}">
                            @error('client')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label">Developer</label>
                            <input type="text" name ="developer" class="form-control @error('developer') is-invalid @enderror" required id="developer" value="{{$project->developer}}">
                            @error('developer')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label">Contact Number</label>
                            <input type="text" name ="contactno" class="form-control @error('contactno') is-invalid @enderror" required id="contactno" value="{{$project->contact_no}}">
                            @error('contactno')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="text" name ="email" class="form-control @error('email') is-invalid @enderror" required id="email" value="{{$project->email}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <a href="/project-register" class="btn btn-danger float-right" style="margin:20px;">Cancel</a>
                        <button type="submit" class="btn btn-info float-right" style="margin:20px;">Update</button>     
                </form>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection


