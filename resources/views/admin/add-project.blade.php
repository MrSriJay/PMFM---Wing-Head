@extends('layouts.TableMaster')


@section('title')
Add Projects | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <!--<a href="" class="btn btn-info float-right py-2">ADD</a>-->
                <h4 class="card-title" style="text-align:center">Add a New Project</h4>
                <p class="card-category" style="text-align:center">Select and type on the text-boxes that you want to fill</p>
            </div>
            <div class="card-body">
                <div class="col-md-6 py-3">

                <form action="/save-projects" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Project Title</label>
                            <input type="text" name ="title" class="form-control" style="width:720pt" required value="">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Description</label>
                            <textarea name="description" class="form-control" style="width:720pt" required rows="6" cols="5"></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label text-primary">Files</label>
                            <input type="file" name="files" class="form-control" style="width:720pt" id="files">
                            @error('files')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Developer(s)</label>
                            <textarea type="text" name ="developers" class="form-control" style="width:720pt" required></textarea>
                            @error('developers')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Client(s)</label>
                            <textarea type="text" name ="clients" class="form-control" style="width:720pt" required></textarea>
                            @error('clients')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Start Date</label>
                            <input type="date" name="startdate" class="form-control" style="width:720pt" required placeholder="Select date" id="startdate">
                            @error('startdate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">End Date</label>
                            <input type="date" name="enddate" class="form-control" style="width:720pt" required placeholder="Select date" id="date">
                            @error('enddate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                </form>
                </div>
                <div style="text-align:right">
                    <button type="submit" class="btn btn-info" style="margin:20px">Save</button>  
                    <a href="{{ url('project-register') }}" class="btn btn-danger" style="margin:20px">Cancel</a>
                </div> 
            </div>
        </div>
    </div>
</div>    

@endsection 