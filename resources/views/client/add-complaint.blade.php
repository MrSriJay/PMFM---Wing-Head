@extends('layouts.ClientMaster')

@section('title')
    Complaints | CRD
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
                    {{ csrf_field() }}
                        <!--Insert Project Title-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">System Name</label>
                            <input type="text" name ="title"  id="title"  class="form-control"  required value=""  placeholder="Enter Projet Name" >
                            <div id="projectList"></div>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--Done Buttons-->
                        <div style="text-align:right">
                            <Button class="btn btn-primary" id="doneBtn" onclick="viewNext()" >Done</Button>
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


$(document).ready(function(){

 $('#title').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#projectList').fadeIn();  
                    $('#projectList').html(data);
          }
         });

        }
    });

    $(document).on('click', 'li', function(){  
        $('#title').val($(this).text());  
        $('#projectList').fadeOut();  
    });  

});
</script>

@endsection


