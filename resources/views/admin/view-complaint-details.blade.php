@extends('layouts.AdminMaster')

@section('title')
    Clients | CRD
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
      <a  class="btn btn-primary float-right" style="margin:20px" id="edit" onclick="toggleEdit()" > <i class="material-icons">edit</i>Edit</a>
      <div style="display:none" id="editext">Edit</div >
        {{ Form::open([ 'method'  => 'PATCH', 'route' => [ 'complaints.update', $complaints->id ] ]) }}
        {{ csrf_field() }}
          
      <label for="recipient-name" class="col-form-label text-light">System Name:</label>
          <h3 class="card-title">
             <strong id="o_name">{!!$complaints->system_name!!}</strong>
             <input style="display: none" type="text" name ="system_name" style="font-size: 50px" id ="system_name" class="form-control text-light text-lg"  value="{{ old('system_name',$complaints->system_name) }}"  placeholder="e.g. Mahela"  required value="">
          </h3> 
      </div>
      <div class="card-body"  >
      
          <!--View Complaint Description-->
          <div class="form-group"> 
            <label for="message-text" class="col-form-label text-primary">Complaint Description:</label>
            <br>
            <span id="dec0" >{!!$complaints->description!!}</span>
            <div id="dec1" style="display:none" >
                <textarea  class="form-control" id="summary-ckeditor" name="summary-ckeditor" required rows="6" cols="5">{{$complaints->description}}</textarea>
            </div>
        </div>
        <hr>
            <!--View Complaint Files-->
            <div class="form-group py-4">
                <label for="message-text" class="col-form-label text-primary">Complaint File(s):</label>
                <br>
                <?php $files = Storage::files("/public/\\".$complaints->files); ?>
                @foreach ($files as $file)
                <?php $path = storage_path($file); ?>
                <div class="row border border-light " style="margin-top: 5px" >
                    <div class="col-lg-9 float-left">
                        <samp>{!! basename($file)!!}<br></samp>   
                    </div>
                    <div class="col-lg-3"> 
                        <a id="downbtn"  name="downbtn" style="margin-right:20px" class="btn btn-success float-right" href="/storage/{{$complaints->files}}/{!! basename($file)!!}"  target="_blank">Open  <span class="material-icons">import_contacts</span></a>
                    </div>
                </div>
                @endforeach                   
            </div>
            <hr>
          <!--View Urgency Level-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Urgency Level:</label>
              <input readonly type="text" name="urgency_level" id="urgency_level"  class="form-control" value="{!!$complaints->urgency_level!!}">
          </div>

           <!--View Sender Details-->
           <div class="form-group py-4">
            <label for="recipient-name" class="col-form-label text-primary">Sender Details:</label>
            <textarea type="text" class="form-control" rows="7" cols="5">{!!(Helper::getSenderDetails($complaints->organization_name))!!}</textarea>
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
        <h5 class="modal-title">Client Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to update the client details? </p>
      </div> 
     
      <div class="modal-footer">
            <button type="submit" class="btn btn-success">Yes, Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
      </div>
    </div>
  </div>
</div>

{{ Form::close() }}

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
