@extends('layouts.AdminMaster')


@section('title')
Add Projects | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <!--<a href="" class="btn btn-info float-right py-2">ADD</a>-->
                <h4 class="card-title" style="text-align:left">Add a New Project</h4>
                <p class="card-category" style="text-align:left">Select and type on the fields that you want to edit</p>
            </div>
            <div class="card-body">
                <div class="col-md-12 py-3">
                <form action="/admin/projects" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <!--Insert Project Title-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Project Title</label>
                            <input type="text" name ="title" class="form-control"  required value="">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--Insert Project Icon-->
                         <div class="py-4">
                            <label for="recipient-name" class="col-form-label text-primary py-3">Project Icon</label>
                            <br>
                            <input type="file" name="projecticon">
                         </div>
                        <!--Insert Description-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Description</label>
                            <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor" required rows="6" cols="5"></textarea>
                            @error('summary-ckeditor')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--Insert Developers-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Developer(s)</label>
                            <textarea type="text" name ="developers" class="form-control" required></textarea>
                            @error('developers')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--Insert Clients-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Client(s)</label>
                            <textarea type="text" name ="clients" class="form-control" required></textarea>
                            @error('clients')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--Insert Start Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Start Date</label>
                            <input type="date" name="startdate" class="form-control" required placeholder="Select date" id="startdate">
                            @error('startdate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                        <!--Insert End Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">End Date</label>
                            <input type="date" name="enddate" class="form-control" required placeholder="Select date" id="date">
                            @error('enddate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                        <!--Upload Files-->
                        <div>
                          <label for="recipient-name" class="col-form-label text-primary py-3">Project File(s)</label>
                          <br>
                          <input type="file" name="file[]" multiple>
                        </div>
                        <!--Save and Cancel Buttons-->
                        <div style="text-align:right">
                            <button type="submit" class="btn btn-info" style="margin:20px">Save</button>  
                            <a href="{{ url('project-register') }}" class="btn btn-danger" style="margin:20px">Cancel</a>
                        </div> 
                </form>
                </div>
            </div>
        </div>
    </div>
</div>    


@endsection 