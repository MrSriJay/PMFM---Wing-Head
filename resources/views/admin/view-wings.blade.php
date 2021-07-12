@extends('layouts.AdminMaster')

@section('title')
    Wings | CRD
@endsection
@section('styles')

<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />

    
@endsection

@section('content')
    
<div class="row">
  <div class="col-md-12"> 
    <div class="card">
      <div class="card-header card-header-primary"> 
           @if(Auth::user()->usertype == "admin" || Auth::user()->usertype=="hq")
              <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#addWingModal"><i class="material-icons">add</i> Add Wing</a>
            @endif
          <h2 class="card-title">Wings</h2>
      </div>
      <div class="card-body">
      @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
          {{ session('status') }}
          </div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger py-2" role="alert">
          {{ session('error') }}
          </div>
      @endif
      <div class="table-responsive">
          <table id="tablewings"  style="width:100%">
              <thead>
                  <tr>
                  <th scope="col">Name</th>
                  @if(Auth::user()->usertype == "admin" || Auth::user()->usertype=="hq")
                   <th scope="col"></th>
                  @endif
                  </tr>
              </thead>
              <tbody>
              @if(count($wing)>0)
                @foreach ($wing as $data)
                  <tr>
                    <td><a href="#" >{{$data->wing_name}}</a></td>
                    @if(Auth::user()->usertype == "admin" || Auth::user()->usertype=="hq")
                        <th scope="row">
                          <a class="btn btn-secondary btn-sm mx-auto " href="/admin/wing-details/{{$data->id}}"  style="width:100%">View More <span class="material-icons">chevron_right</span></a>
                         </th>
                    @endif
                  </tr>

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
                          <p>Are you sure you want to delete the wing</p>
                        </div> 
                        {{ Form::open([ 'method'  => 'delete', 'route' => [ 'wings.destroy', $data->id ] ]) }}
                        <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Yes, Delete</button>
                              {{ Form::close() }}
                              <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                 @endforeach
                @else 
                  <p>No Wings Found</p>
                @endif
          </table>
          <br><br>
          
      </div>

      </div> 
    </div>
  </div>
</div>
    

<!-- DATA TABLE SCRIPTS -->


<!--Add Wing Modal -->
<div class="modal fade" id="addWingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel"> <i class="material-icons">add</i> Add Wing</h5>
        <a class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="card-body">
      <form action="/admin/wings" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <!--Insert Wing Name-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Wing Name</label>
              <input type="text" name ="name" class="form-control"  required value="" placeholder="Please Enter Wing Name">
              @error('title')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <!--Save and Cancel Buttons-->
          <div style="width:100%">
              <button type="submit" class="btn btn-success" style="width:100%">Add Wing</button>    
          </div> 
        
      </form>
      </div>
    </div>
  </div>
</div>




@endsection
@section('scripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablewings').DataTable({
      "order": [[ 0, "asc" ]]
    });

} );

$('#addWingModal').on('shown.bs.modal', function () {
  $('#name').trigger('focus')
})


$('#deleteModal').on('shown.bs.modal', function () {
  $('#name').trigger('focus')
})

</script>


@endsection
