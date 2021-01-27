@extends('layouts.ClientMaster')

@section('title')
    Projects | NBC
@endsection

@section('content')
    
 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <a href="/client/clients-complaints/create" class="btn btn-primary float-right"  data-toggle="" data-target="" ><i class="material-icons">add</i> Add New Complaint</a>
          <h2 class="card-title">{!!$project->title!!}</h2>
        </div>
        <div class="card-body">
            <div class="card" style="padding:20px">
                <label class="text-primary" for="">Project Decription</label>
                <span id="dec0" >{!!$project->description!!}</span>
            </div>

            <div class="card" style="padding:20px">
                <label class="text-primary" for="">Developed by</label>
                <span id="dec0" >{!!Helper::getWingName( $project->wingid )!!} <i>of Center for Researsh and Development</i></span>
            </div>

            <div class="card" style="padding:20px">
                <label class="text-primary" for="">Project Incharge</label>
                <span id="dec0" >{!!Helper::getName($project->projectInchargeId)!!}</span>
            </div>
        </div>
     </div>
   </div>
 </div>
@endsection

@section('scripts')

    
@endsection
