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
                            <label for="recipient-name" class="col-form-label">Project Title:</label>
                            <input type="text" name ="projecttitle" class="form-control" value="{{$project->title}}">
                        </div>
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label">Description</label>
                            <textarea name="description" class="form-control" rows="6" cols="5">{{$project->description}}</textarea>
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label">Client</label>
                            <input type="text" name ="client" class="form-control" value="{{$project->client}}">
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label">Developer</label>
                            <input type="text" name ="developer" class="form-control" value="{{$project->developer}}">
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


