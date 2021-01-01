@extends('layouts.ClientMaster')

@section('title')
    Complaints | CRD
@endsection

@section('styles')
<link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <style>
        .container {
            max-width: 500px;
        }
        h2 {
            color: white;
        }
    </style>
@endsection


@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 
          <h2 class="card-title">Add Compalints</h2> 
      </div>
      <div class="card-body">
      <form action="/project-register-save" method="POST" enctype="multipart/form-data">
                       <div class="form-group py-4">
                          <label for="message-text" class="col-form-label text-primary">System Name</label>
                          <select id="title" class="livesearch form-control" name="title"></select>
                        </div>
                        
                        {{ csrf_field() }}
                        <!--Done Buttons-->
                        <div style="text-align:right">
                            <a class="btn btn-primary" id="doneBtn" onclick="viewNext()" style="color:white" >Next</a>
                        </div> 

                    <div style="display:none" id="add_content">
                        <!--Insert Description-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Complaint Description</label>
                            <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor" required rows="6" cols="5"></textarea>
                            @error('summary-ckeditor')
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
                    </div>
                </form>

      </div> 
    </div>
  </div>
</div>
<script type="text/javascript">
    $('#title').select2({
        placeholder: 'Select system name',
        ajax: {
            url: '/projects-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>
@endsection


@section('scripts')


<script>

function viewNext() {

var x = document.getElementById("add_content");
var button = document.getElementById("doneBtn");
var y = document.getElementById("title").value;

if (y=="") {
  x.style.display = "none";
} 
else{
  x.style.display = "block";
  button.style.display = "none";
}
}
</script>

@endsection

