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
                <h4 class="card-title" style="text-align:left">Add a New Project</h4>
                <p class="card-category" style="text-align:left">Select and type on the text-boxes that you want to fill</p>
            </div>
            <div class="card-body">
                <div class="col-md-12 py-3">

                <form action="/save-projects" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Project Title</label>
                            <input type="text" name ="title" class="form-control"  required value="">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Description</label>
                            <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"  rows="6" cols="5"></textarea>
                            <script>
                                CKEDITOR.replace( 'summary-ckeditor' );
                                $("form").submit( function(e) {
                                    var messageLength = CKEDITOR.instances['summary-ckeditor'].getData().replace(/<[^>]*>/gi, '').length;
                                    if( !messageLength ) {
                                        alert( 'Please enter a message' );
                                        e.preventDefault();
                                    }
                                });
                            </script>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label text-primary">Files</label>
                            <input type="file" name="files[]" multiple class="form-control" id="files">
                            @error('files')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Developer(s)</label>
                            <textarea type="text" name ="developers" class="form-control" required></textarea>
                            @error('developers')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Client(s)</label>
                            <textarea type="text" name ="clients" class="form-control" required></textarea>
                            @error('clients')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Start Date</label>
                            <input type="date" name="startdate" class="form-control" required placeholder="Select date" id="startdate">
                            @error('startdate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">End Date</label>
                            <input type="date" name="enddate" class="form-control" required placeholder="Select date" id="date">
                            @error('enddate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
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
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>

@endsection 