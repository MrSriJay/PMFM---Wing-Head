@extends('layouts.AdminMaster')

@section('title')
    Complaints | CRD
@endsection

@section('styles')

    
@endsection

@section('content')
    
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 
          <a href="/admin/users/create" class="btn btn-success float-right" style="margin:20px" data-toggle="" data-target="" > <i class="material-icons">add</i> Add User</a>
          <h2 class="card-title">Users</h2>
          <p class="card-category">Comapint details</p> 
      </div>
      <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
            </div>
        @endif
        <div class="table-responsive">
          <table id="tablewings"  style="width:100%">
              <thead>
                  <tr>
                  <th scope="col">ID No.</th>
                  <th scope="col">Rank</th>
                  <th scope="col">Name</th>
                  <th scope="col">Telephone</th>
                  <th scope="col">Email</th>
                  <th scope="col">Designation</th>
                  <th scope="col">Wing Name</th>
                  </tr>
              </thead>
              <tbody>
              @if(count($users)>0)
                @foreach ($users as $data)
                  <tr>
                    <th scope="row">{{$data->user_id}}</th>
                    <th scope="row">{{$data->rank}}</th>
                    <td scope="row">{{$data->first_name}} {{$data->last_name}}</td>
                    <th scope="row">{{$data->telephone}}</th>
                    <th scope="row">{{$data->email}}</th>
                    <th scope="row">{{$data->usertype}}</th>
                    <th scope="row">{{$data->wing_name}}</th>
                  </tr>
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
@endsection
@section('scripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#tablewings').DataTable({

    });

} );

$('#addWingModal').on('shown.bs.modal', function () {
  $('#name').trigger('focus')
})

</script>


@endsection
