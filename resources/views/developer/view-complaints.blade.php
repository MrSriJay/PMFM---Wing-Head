@extends('layouts.DeveloperMaster')

@section('title')
    Complaints | CRD
@endsection

@section('content')
    
  
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 
          <h2 class="card-title">Assigned Complaints</h2>
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
                  <th scope="col">System Name</th>
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
                    <th scope="row">{{$data->system_name}}</th>
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
                      @foreach ($Complaint_Developer as $data2)
                        @if($data2->complaint_id == $data->id )
                          @if($data2->status == 0 )
                           <a class="btn btn-secondary btn-sm mx-auto " href="winghead/wings-complaints/{{$data->id}}"  style="width:100%">View More <span class="material-icons">chevron_right</span></a>
                          @else 
                            <a class="btn btn-danger btn-sm mx-auto " href="winghead/wings-complaints/{{$data->id}}"  style="width:100%">View More <span class="material-icons">chevron_right</span></a>
                          @endif
                        @endif
                      @endforeach
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
