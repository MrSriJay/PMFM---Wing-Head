@extends('layouts.WingheadMaster')

@section('title')
    Complaints | CRD
@endsection

@section('styles')

 <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" />
    
@endsection

@section('content')
    
  
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 
          <a href="/winghead/wings-complaints/create" class="btn btn-success float-right" style="margin:20px" data-toggle="" data-target="" ><i class="material-icons">add</i> Add Client Complaint</a>
          <h2 class="card-title">Complaints Reported</h2>
          <p class="card-category">The Complaint details</p> 
      </div>
      <div class="card-body">
        
        @if (session('status'))
            <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
            </div>
        @endif
        
        <div class="table-responsive">
          <table id="tablewings" class="hover table-bordered" style="width:100%">
              <thead>
                  <tr>
                  <th scope="col">System Name</th>
                  <th scope="col">Client Name</th>
                  <th scope="col">Date Subitted</th>
                  <th scope="col">Wing Name</th>
                  <th scope="col">Type of Fault</th>
                  <th scope="col">Urgency Level</th>
                  <th scope="col">Complaint Status</th>
                  <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              @if(count($complaints)>0)
                @foreach ($complaints as $data)
                  <tr>
                    <th scope="row" > <a href="/winghead/wings-complaints/{{$data->id}}" @if($data->status == 3) class="text-warning" @endif >{{$data->system_name}}</a></th>
                    <th scope="row">{!!Helper::getClientName($data->client_id) !!}</th>
                    <th scope="row">{{$data->created_at}}</th>
                    <th scope="row">{!!Helper::getWingName($data->wing_id)!!}</th>
                    <th scope="row">{{$data->fault_type}}</th>

                    @if($data->urgency_level=="medium")
                        <th scope="row"  class="text-warning">Medium</th>
                    @elseif($data->urgency_level=="high")
                        <th scope="row"  class="text-danger">High</th>
                    @elseif($data->urgency_level=="low")
                        <th scope="row"  class="text-success">Low</th>
                    @elseif($data->urgency_level=="critical")
                        <th scope="row"  class="text-danger">Critial</th>
                    @endif

                    <th scope="row"  class="text-primary" >{!!Helper::getComplaintStatus($data->status)!!}</th>
                    
                    <th scope="row">
                     <a class="btn btn-secondary btn-sm mx-auto " href="/winghead/wings-complaints/{{$data->id}}"  style="width:100%">View More <span class="material-icons">chevron_right</span></a>
                    </th>

                  </tr>
                  @endforeach
                @else 
                  <p>No Complaints Submitted Yet</p>
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