@extends('layouts.AdminMaster')

@section('title')
    Ranks | CRD
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
        {{ Form::open([ 'method'  => 'PATCH', 'route' => [ 'ranks.update', $rank->id ] ]) }}
        {{ csrf_field() }}
          
      <span class="text-light">Rank Name</span>
          <h3 class="card-title">
             <strong id="o_name">{!!$rank->rankname!!}</strong>
             <div id="wing_name_edit" class="col-lg-12" style="display: none">
               <input id="wing_name" type="text" name ="rankname" style="font-size: 25px" id ="organization_name" class="form-control text-light text-lg"  value="{{ old('organization_name',$rank->rankname) }}"  placeholder="e.g. Mahela"  required value="">
             </div>
          </h3> 
          
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

      <div class="card-body"  >
  
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
        <h5 class="modal-title">Rank Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to update the Rank details? </p>
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
        <h5 class="modal-title">Delete Rank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this client?</p>
      </div> 
      {{ Form::open([ 'method'  => 'delete', 'route' => [ 'ranks.destroy', $rank->id ] ]) }}
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
        
        document.getElementById("wing_name_edit").style.display = "inline";
        document.getElementById("o_name").style.display = "none";
        document.getElementById("edit").classList.add("btn-danger");
        document.getElementById("update").style.display = "inline";
        document.getElementById("delete").style.display = "inline";


        i.innerHTML="Cancel"
    }
    else{
        document.getElementById("wing_name_edit").style.display = "none";
        document.getElementById("o_name").style.display = "inline";

        document.getElementById("edit").classList.add("btn-primary");
        document.getElementById("edit").classList.remove("btn-danger");
        document.getElementById("update").style.display = "none";
        document.getElementById("delete").style.display = "none";

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
