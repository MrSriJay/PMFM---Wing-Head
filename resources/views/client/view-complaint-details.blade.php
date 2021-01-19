@extends('layouts.ClientMaster')

@section('title')
    Complaints | CRD
@endsection

@section('styles')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    
@endsection

@section('content')
    
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
      <div style="display:none" id="editext">Edit</div >

      <label for="recipient-name" class="col-form-label text-light">Complaints</label>
          <h3 class="card-title">
             <strong>{!!$complaints->system_name!!}</strong>
          </h3> 
      </div>
      <div class="card-body"  >
        
       @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
          {{ session('status') }}
          </div>
       @endif
   
      {{ csrf_field() }}
          <!--View Fault Description-->
          <div class="form-group"> 
            <label for="message-text" class="col-form-label text-primary">Fault Description</label>
            <br>
            <span id="dec0" >{!!$complaints->description!!}</span>
            @error('summary-ckeditor')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

          <!--View Complaint Files-->
          <div class="form-group py-4">
            <label for="message-text" class="col-form-label text-primary">Complaint File(s)</label>
            <br>
            <?php $files = Storage::files("/public/\\".$complaints->files); ?>
            @foreach ($files as $file)
            <?php $path = storage_path($file); ?>
            <div class="row border border-light " style="margin-top: 5px" >
                <div class="col-lg-9 float-left">
                    <samp>{!! basename($file)!!}<br></samp>   
                </div>
                <div class="col-lg-3"> 
                    <a id="downbtn"  name="downbtn" class="btn btn-success float-right" href="/storage/{{$project->files}}/{!! basename($file)!!}"  target="_blank"> <span class="material-icons">save_alt</span> Download</a>
                    <a id="imgdel" name="imgdel" class="btn btn-secondary float-right text-danger" style="display: none;" > <span class="material-icons">delete</span></a>
                </div>
            </div>
            @endforeach                   
        </div>

          <!--Save and Cancel Buttons-->
          <div style="text-align:right" id="buttons"> 
             <button type="button" class="btn btn-danger" id="delete" style="display:none"  data-toggle="modal" data-target="#deleteModal">
                <span class="material-icons">delete_forever</span> Delete
             </button>
             <button type="button" class="btn btn-success" id="update" style="display:none" data-toggle="modal" data-target="#updatemodal">
                <span class="material-icons">update</span> Update
             </button>
              
          </div> 
    
      </div> 
    </div>
  </div>
</div>
<!--Update Modal --->
<div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to update the user details </p>
      </div> 
     
      <div class="modal-footer">
            <button type="submit" class="btn btn-success">Yes, Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
      </div>
    </div>
  </div>
</div>

{{ Form::close() }}


<script type="text/javascript">
    $('#wing_name').select2({
        placeholder: 'Select System Name',
        ajax: {
            url: '/wings-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.wing_name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    
</script>

<script>


   function toggleEdit() {    
    var i= document.getElementById("editext");
    if(i.innerHTML=="Edit"){
        document.getElementById("rank").readOnly = false;
        document.getElementById("first_name").readOnly = false;
        document.getElementById("last_name").readOnly = false;
        document.getElementById("telephone").readOnly = false;
        document.getElementById("email").readOnly = false;
        document.getElementById("usertype").disabled = false;
        document.getElementById("wing_name").disabled = false;
        document.getElementById("update").style.display = "inline";
        document.getElementById("delete").style.display = "inline";
        document.getElementById("edit").classList.add("btn-danger");
        i.innerHTML="Cancel"
    }
    else{
        document.getElementById("rank").readOnly = true;
        document.getElementById("first_name").readOnly = true;
        document.getElementById("last_name").readOnly = true;
        document.getElementById("telephone").readOnly = true;
        document.getElementById("email").readOnly = true;
        document.getElementById("usertype").disabled = true;
        document.getElementById("wing_name").disabled = true;
        document.getElementById("update").style.display = "none";
        document.getElementById("delete").style.display = "none";
        document.getElementById("edit").classList.remove("btn-danger");
        document.getElementById("edit").classList.add("btn-primary");
        i.innerHTML="Edit"
        i=0
    }
}

</script>
@endsection
@section('scripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>

$('#deleteModal').on('shown.bs.modal', function () {
  $('#name').trigger('focus')
})

$('#updatemodal').on('shown.bs.modal', function () {
  $('#name').trigger('focus')
})


</script>
@endsection