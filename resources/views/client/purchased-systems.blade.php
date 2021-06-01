@extends('layouts.ClientMaster')

@section('title')
    Projects | NBC
@endsection

@section('content')
    
 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <a href="/client/clients-complaints/create" class="btn btn-primary float-right" style="margin:20px" data-toggle="" data-target="" ><i class="material-icons">add</i> Add New Complaint</a>
          <h2 class="card-title">Purchased Systems</h2>
          <p class="card-category">Details of Systems</p> 
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
                      <img style="width:100%; padding:20px" src="/storage/project_icons/{{$data->project_icon}}">
                    </div>  
                    
                   <div class="card-header">
                     <div class="col-md-12 col-sm-12">
<<<<<<< HEAD
                       <h3><a class="card-title text-primary font-weight-bold " href="/client/purchased-systems/{{$data->id}}">{{$data->title}}</a></h3>
=======
                       <h3><a class="card-title text-primary font-weight-bold " href="admin/projects/{{$data->id}}">{{$data->title}}</a></h3>
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
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
