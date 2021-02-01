@extends('layouts.AdminMaster')

@section('title')
    Projects | NBC
@endsection

@section('content')
    
 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <h4><b><span class="material-icons">history</span> Complaint(s) History</b></h4>
          <h2 class="card-title"><b>{!!Helper::getprojectName($proid)!!}</b></h2>
        </div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
          {{ session('status') }}
          </div>
          @endif
          <div>
            @if(count($complaints)>0)
              @foreach ($complaints as $data)
                <div class="card border">
                  <div class="row" style="padding: 20px">
                        <div class="col-lg-12" >
                          <h5 style="font-weight: bolder"><a class="card-title text-primary" href="admin/complaints/{{$data->id}}" >{!! substr($data->description, 0,100) . '.....'!!} <small> View More</small></a></h5>
                        </div>
                        <div class="col-lg-4">
                          <small class="text-muted">Urgency Level</small> <br>
                          @if($data->urgency_level=="medium")
                               <span scope="row"  class="text-warning">Medium</span>
                            @elseif($data->urgency_level=="high")
                                <span scope="row"  class="text-danger">High</span>
                            @elseif($data->urgency_level=="low")
                                <span scope="row"  class="text-success">Low</span>
                            @elseif($data->urgency_level=="critical")
                                <span scope="row"  class="text-danger">Critial</span>
                            @endif
                        </div>
                        <div class="col-lg-4">
                          <span class="text-center">
                            <small class="text-muted">Fault Type </small> <br>
                            <b>{{$data->fault_type}}</b>
                          </span>
                        </div>
                        <div class="col-lg-4">
                          <span class="float-right">
                          <small class="text-muted">Complaint Status</small> <br>
                          <strong>{!!Helper::getComplaintStatus($data->status)!!}</strong>
                          </span>
                        </div>
                        <div class="col-lg-12">
                          <small class="text-dark">Reported on {{$data->created_at}}</small>
                        </div>
                  </div>
                </div>
              @endforeach
            @else 
              <h3 style="text-align: center">No Complaints Found</h3>
            @endif
          </div>
        </div>
     </div>
   </div>
 </div>
@endsection

@section('scripts')

    
@endsection
