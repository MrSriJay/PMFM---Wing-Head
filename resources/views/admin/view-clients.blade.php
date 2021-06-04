@extends('layouts.AdminMaster')

@section('title')
    Clients | CRD
@endsection

@section('styles')

 <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" />
    
@endsection

@section('content')
    
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 
          @if(Auth::user()->usertype == "admin" || Auth::user()->usertype=="hq")
            <a href="/admin/clients/create" class="btn btn-success float-right" style="margin:20px" data-toggle="" data-target="" > <i class="material-icons">add</i> Add Client</a>
          @endif
          <h2 class="card-title">Clients</h2>
          <p class="card-category">Registered user details</p> 
      </div>
      <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
            </div>
        @endif
        <div class="table-responsive">
          <table id="tablewings" class="hover" style="width:100%">
              <thead>
                  <tr>
                  <th scope="col">Oraganization Name</th>
                  <th scope="col">Department</th>
                  <th scope="col">Address</th>
                  <th scope="col">Contact No</th>
                  <th scope="col">Email</th>
                  <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
                @if(count($clients)>0)
                @foreach ($clients as $data)
                  <tr>
                    <th scope="row">{{$data->organization_name}}</th>
                    <th scope="row">{{$data->department_name}}</th>
                    <th scope="row">{{$data->address}}</th>
                    <th scope="row">{!!nl2br(e($data->contact_no))!!}</th>
                    <th scope="row">{{$data->email}}</th>
                    <th scope="row">
                     <a class="btn btn-secondary btn-sm mx-auto " href="/admin/clients/{{$data->id}}"  style="width:100%">View More <span class="material-icons">chevron_right</span></a>
                    </th>
                  </tr>
                  @endforeach
                @else 
                  <p>No Users Found</p>
                @endif
              </tbody>
          </table>
          <br><br>
          
      </div>
      </div> 
    </div>
  </div>
</div>
@endsection
@section('scripts')

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

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
