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
            @if(count($project)>0)
              @foreach ($project as $data)
                <div class="card">

                  <div class="row">
                    <div class="col-md-2 col-sm-2">
                      <img style="width:100%; padding:20px" src="/storage/project_icons/{{$data->project_icon}}" >
                    </div>  
                  <div class="card-header"> 
                    
                  <div class="col-md-12 col-sm-12">
                  <span class="text-muted"> <b>Project Number:</b> {{$data->pgt_number}}</span>
                  <h3><a class="card-title text-primary font-weight-bold " href="/admin/projects/{{$data->id}}">{{$data->title}}</a></h3>
                  <span class="text-primary" >Developed for {!!Helper::getClientName($data->clientid)!!}</span>
                  <br>
                  <br>
                  <a href="/admin/projects-history/{{$data->id}}" class="btn btn-primary btn-sm"> View Complaint History</a>
                  <br>
                  <br>
                  <small class="text-dark">Posted on {{$data->created_at}}</small>
                  </div>  
                  
                </div>
                  </div>
                  <div style="padding-right:20px; padding-bottom:20px">
                    <div style ="float:right; font-size:20px;">
                      <span style ="font-size:10px; float: right;." class="text-muted">Status</span>
                      <br>
                      @if($data->status==1)
                        <span class="text-success float-right"><i class="material-icons">check_circle_outline</i></span>
                      @elseif($data->status==0)
                        <span class="text-danger float-right"><i class="material-icons">highlight_off</i></span>
                      @endif
                    </div>
                  </div>
                </div>


              @endforeach
            @else 
              <h3 style="text-align: center">No Projects Found</h3>
            @endif
          </div>
        </div>
     </div>
   </div>
 </div>
@endsection

@section('scripts')

    
@endsection
