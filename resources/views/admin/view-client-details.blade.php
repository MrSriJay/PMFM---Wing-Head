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

      <label for="recipient-name" class="col-form-label text-light">Client Name</label>
          <h3 class="card-title">
             <strong>{!!$clients->organization_name!!}</strong>
          </h3> 
      </div>
      <div class="card-body"  >
      {{ Form::open([ 'method'  => 'PATCH', 'route' => [ 'clients.update', $clients->id ] ]) }}
      {{ csrf_field() }}
        
          <!--View Department Name-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Department</label>
              <input type="text" name ="department_name" id ="department_name" class="form-control @error('department_name') is-invalid @enderror" readonly  value="{{ old('department_name',$clients->department_name) }}"  placeholder="e.g. Mahela"  required value="">
              @error('department_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--View Address-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Address</label>
              <input type="text" name ="address" id="address"  class="form-control @error('address') is-invalid @enderror" readonly  value="{{ old('address',$clients->address) }}"  placeholder="e.g. Perera"  required value="">
              @error('address')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

           <!--View Contact No-->
           <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Contact No</label>
              <input type="text" name="contact_no" id="contact_no" class="form-control @error('contact_no') is-invalid @enderror" readonly value="{{ old('contact_no',$clients->contact_no) }}"  placeholder="e.g. 0112111111" required value="">
              @error('contact_no')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--Insert Email-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Email</label>
              <input type="email" name ="email" id ="email" class="form-control @error('email') is-invalid @enderror" readonly value="{{ old('email',$clients->email) }} "  placeholder="e.g. mymail@gmail.com" required value="">
              @error('email')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
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


<!--Delete Modal --->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Client Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this client?</p>
      </div> 
      {{ Form::open([ 'method'  => 'delete', 'route' => [ 'clients.destroy', $clients->id ] ]) }}
      <div class="modal-footer">
            <button type="submit" class="btn btn-success">Yes, Delete</button>
            {{ Form::close() }}
            <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>


   function toggleEdit() {    
    var i= document.getElementById("editext");
    if(i.innerHTML=="Edit"){
        document.getElementById("department_name").readOnly = false;
        document.getElementById("address").readOnly = false;
        document.getElementById("contact_no").readOnly = false;
        document.getElementById("email").readOnly = false;
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
