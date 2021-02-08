@extends('layouts.AdminMaster')

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
        
      @if(Auth::user()->usertype == "admin" || Auth::user()->usertype=="hq")
        <a  class="btn btn-primary float-right" style="margin:20px" id="edit" onclick="toggleEdit()" > <i class="material-icons">edit</i>Edit</a>
      @endif

      <div style="display:none" id="editext">Edit</div >

      <label for="recipient-name" class="col-form-label text-light">Militaray/National ID No</label>
          <h3 class="card-title">
             <strong id="u_id">{!!$user->user_id!!}</strong>
          </h3> 
      </div>
      <div class="card-body"  >
        
       @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
          {{ session('status') }}
          </div>
       @endif
      {{ Form::open([ 'method'  => 'PATCH', 'route' => [ 'users.update', $user->user_id ] ]) }}
      {{ csrf_field() }}
        <div class="row">

          <!--View rank-->
          <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label text-primary">Rank</label>
              <input type="text" name ="rank" id ="rank"  class="form-control @error('rank') is-invalid @enderror" readonly value="{{ old('rank',$user->rank) }} "  placeholder="e.g. Major" required value="">
              @error('rank')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <!--View First Name-->
          <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label text-primary">First Name</label>
              <input type="text" name ="first_name" id ="first_name" class="form-control @error('first_name') is-invalid @enderror" readonly  value="{{ old('first_name',$user->first_name) }}"  placeholder="e.g. Mahela"  required value="">
              @error('first_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--View Last Name-->
          <div class="col-lg-4"> 
              <label for="recipient-name" class="col-form-label text-primary">Last Name</label>
              <input type="text" name ="last_name" id ="last_name"  class="form-control @error('last_name') is-invalid @enderror" readonly  value="{{ old('last_name',$user->last_name) }}"  placeholder="e.g. Perera"  required value="">
              @error('last_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

           <!--View Telephone-->
           <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label text-primary">Telephone</label>
              <input type="text" name ="telephone" id ="telephone" class="form-control @error('telephone') is-invalid @enderror" readonly value="{{ old('telephone',$user->telephone) }}"  placeholder="e.g. 0112111111"  pattern="[0-9]{1}[0-9]{9}" required value="">
              @error('telephone')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--View Email-->
          <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label text-primary">Email</label>
              <input type="email" name ="email" id ="email" class="form-control @error('email') is-invalid @enderror" readonly value="{{ old('email',$user->email) }} "  placeholder="e.g. mymail@gmail.com" required>
              @error('email')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

           <!--View designation-->
           <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label text-primary">Designation</label>
              <select id="usertype" class="form-control"  name="usertype"  disabled   aria-label="Default select example" >
                <option value="{{ old('usertype',$user->usertype) }}" disable selected>{!!Helper::getDesignation($user->usertype)!!}</option>
                <option value="winghead" >Wing Head</option>
                <option value="topmanagement" >Top Management</option>
                <option value="developer" >Developer</option>
                <option value="officer" >Officer</option>
              </select>
              
          </div>

          <!--View wing-->
          <div class="col-lg-6">
              <label for="message-text" class="col-form-label text-primary">Wing Name</label>
              <select id="wing_name" class="livesearch form-control" name="wing_name" disabled readonly value="{{ old('wing_name') }}" style="width:100%;"  required>
              <option value="{{ old('wing_name',$user->wing_name) }}" disable selected>{!!Helper::getWingName($user->wing_name)!!}</option>
              </select>

              <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                Please Select Wing Name 
              </div>
          </div> 

          <!--Save and Cancel Buttons-->
          <div style="text-align:right" class="col-lg-12" id="buttons"> 
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


<!--Delete Modal --->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the user </p>
      </div> 
      {{ Form::open([ 'method'  => 'delete', 'route' => [ 'users.destroy', $user->user_id ] ]) }}
      <div class="modal-footer">
            <button type="submit" class="btn btn-success">Yes, Delete</button>
            {{ Form::close() }}
            <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
      </div>
    </div>
  </div>
</div>

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
        document.getElementById("user_id").style.display = "inline";
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
