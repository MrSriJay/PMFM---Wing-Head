@extends('layouts.ClientMaster')

@section('title')
    Complaints | CRD
@endsection

@section('content')
    
  
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 
          <a href="/client/client-complaint/create" class="btn btn-success float-right" style="margin:20px" data-toggle="" data-target="" >Add New Complaint</a>
          <h2 class="card-title">Compalints Submitted</h2>
          <p class="card-category">The Comapint details</p> 
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
                  <th scope="col">Complaint ID</th>
                  <th scope="col">System Name</th>
                  <th scope="col">Complaint Type</th>
                  <th scope="col">Date Subitted</th>
                  <th scope="col">Complaint Status</th>
                  <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              @if(count($complaints)>0)
                @foreach ($complaints as $data)
                  <tr>
                    <th scope="row">{{$data->id}}</th>
                    <th scope="row">{{$data->system_name}}</th>
                    <th scope="row">{{$data->fault_type}}</th>
                    <th scope="row">{{$data->created_at}}</th>
                    <th scope="row">{{$data->status}}</th>
                    <th scope="row">{!!Helper::getDesignation($data->usertype)!!}</th>
                    <th scope="row">{!!Helper::getWingName($data->wing_name)!!}</th>
                    <th scope="row">
                     <a class="btn btn-secondary btn-sm mx-auto " href="admin/users/{{$data->user_id}}"  style="width:100%">View More <span class="material-icons">chevron_right</span></a>
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
