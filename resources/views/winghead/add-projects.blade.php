@extends('layouts.WingheadMaster')


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
                <form action="/save-projects" method="POST" enctype="multipart/form-data">
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
                        <!--
                        <div class="row py-5">
                            <div class="col-md-6 col-sm-12">
                              <div id="drag-and-drop-zone" class="dm-uploader p-5 text-center">
                                <h3 class="mb-5 mt-5 text-muted text-primary">Drag &amp; drop files here</h3>
                                <div class="btn btn-primary btn-block mb-5">
                                    <span>Open the file Browser</span>
                                    <input type="file" title='Click to add Files' multiple>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <div class="card h-100">
                                <div class="card-header text-primary text-center">
                                  <h5>File List</h5>
                                </div>
                                <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                                  <li class="text-muted text-center empty" style="padding-top:50px">No files uploaded.</li>
                                </ul>
                              </div>
                            </div>
                         </div> -->
                         <div class="py-4">
                         <label for="recipient-name" class="col-form-label text-primary py-4">Upload File(s)</label>
                         <br>
                         <input type="file" name="file[]" multiple>
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