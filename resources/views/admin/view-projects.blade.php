@extends('layouts.AdminMaster')

@section('title')
    Projects | NBC
@endsection

@section('content')
    
 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          @if(Auth::user()->usertype == "admin" || Auth::user()->usertype=="hq")
           <a href="/admin/projects/create" class="btn btn-success float-right" style="margin:20px" data-toggle="" data-target=""><i class="material-icons">add</i> Add New Project</a>
          @endif
          <h2 class="card-title">Projects</h2>
          <p class="card-category">Details of projects that are registered in the system</p> 
        </div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
          {{ session('status') }}
          </div>
          @endif
          <div>
              @if(count($wing)>0)
              @foreach ($wing as $data)
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-primary btn-sm" style="width:100%" data-toggle="collapse" data-target="#{{$data->id}}" aria-expanded="true" aria-controls="collapseOne">
                      {{$data->wing_name}}
                    </button>
                  </h5>
                </div>
                <div id="{{$data->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    @if(count($project)>0)
                    @foreach ($project as $dataProject)
                      @if($dataProject->wingid == $data->id)
                      <div class="card" style="border:1px solid rgb(45, 76, 250)">
                        <div class="row">
                          <div class="col-md-2 col-sm-2">
                            <img style="width:100%; padding:20px" src="/storage/project_icons/{{$dataProject->project_icon}}" >
                          </div>  
                        <div class="card-header"> 
                        <div class="col-md-12 col-sm-12">
                          <span class="text-muted"> <b>Project Number:</b> {{$dataProject->pgt_number}}</span>
                          <h3><a class="card-title text-primary font-weight-bold " href="/admin/projects/{{$dataProject->id}}">{{$dataProject->title}}</a></h3>
                          <span class="text-primary" >Developed for {!!Helper::getClientName($dataProject->clientid)!!}</span>
                          <br>
                          <a href="/admin/projects-history/{{$dataProject->id}}" class="btn btn-primary btn-sm"> View Complaint History</a>
                          <a href="/admin/complaints/add/{{$dataProject->id}}" class="btn btn-danger btn-sm" style="margin:20px"><i class="material-icons">add</i> Add New Complaint</a>
                          <br>
                          <small class="text-dark">Posted on {{$dataProject->created_at}}</small>
                        </div>  
                        
                        </div>
                        </div>
                        <div style="padding-right:20px; padding-bottom:20px">
                          <div style ="float:right; font-size:20px;">
                            <span style ="font-size:10px; float: right;." class="text-muted">Status</span>
                            <br>
                            @if($dataProject->status==1)
                              <span class="text-success float-right"><i class="material-icons">check_circle_outline</i></span>
                            @elseif($dataProject->status==0)
                              <span class="text-danger float-right"><i class="material-icons">highlight_off</i></span>
                            @endif
                          </div>
                        </div>
                      </div>
                      @endif
                      @endforeach
                      @else 
                      <div class="card">
                        <p style="text-align: center">No Projects Found</p>
                      @endif
                  </div>
              </div>
              @endforeach
              @else 
                <h3 style="text-align: center">No Wings Found</h3>
              @endif
          </div>
        </div>
     </div>
   </div>
 </div>
@endsection

@section('scripts')

    
@endsection
