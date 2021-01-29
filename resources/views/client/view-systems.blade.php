@extends('layouts.ClientMaster')

@section('title')
    Projects | NBC
@endsection



@section('styles')
  <style>
    .accordion-button {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
      padding: 1rem 1.25rem;
      font-size: 1rem;
      color: #212529;
      background-color: transparent;
      border: 1px solid rgba(0, 0, 0, 0.125);
      border-radius: 0;
      overflow-anchor: none;
      transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, border-radius 0.15s ease;
    }
    @media (prefers-reduced-motion: reduce) {
      .accordion-button {
        transition: none;
      }
    }
    .accordion-button.collapsed {
      border-bottom-width: 0;
    }
    .accordion-button:not(.collapsed) {
      color: #0c63e4;
      background-color: #e7f1ff;
    }
    .accordion-button:not(.collapsed)::after {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230c63e4'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
      transform: rotate(180deg);
    }
    .accordion-button::after {
      flex-shrink: 0;
      width: 1.25rem;
      height: 1.25rem;
      margin-left: auto;
      content: "";
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-size: 1.25rem;
      transition: transform 0.2s ease-in-out;
    }
    @media (prefers-reduced-motion: reduce) {
      .accordion-button::after {
        transition: none;
      }
    }
    .accordion-button:hover {
      z-index: 2;
    }
    .accordion-button:focus {
      z-index: 3;
      border-color: #86b7fe;
      outline: 0;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .accordion-header {
      margin-bottom: 0;
    }

    .accordion-item:first-of-type .accordion-button {
      border-top-left-radius: 0.25rem;
      border-top-right-radius: 0.25rem;
    }
    .accordion-item:last-of-type .accordion-button.collapsed {
      border-bottom-width: 1px;
      border-bottom-right-radius: 0.25rem;
      border-bottom-left-radius: 0.25rem;
    }
    .accordion-item:last-of-type .accordion-collapse {
      border-bottom-width: 1px;
      border-bottom-right-radius: 0.25rem;
      border-bottom-left-radius: 0.25rem;
    }

    .accordion-collapse {
      border: solid rgba(0, 0, 0, 0.125);
      border-width: 0 1px;
    }

    .accordion-body {
      padding: 1rem 1.25rem;
    }

    .accordion-flush .accordion-button {
      border-right: 0;
      border-left: 0;
      border-radius: 0;
    }
    .accordion-flush .accordion-collapse {
      border-width: 0;
    }
    .accordion-flush .accordion-item:first-of-type .accordion-button {
      border-top-width: 0;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    .accordion-flush .accordion-item:last-of-type .accordion-button.collapsed {
      border-bottom-width: 0;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
  </style>
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

            <div class="card" style="padding:20px" >
              <label class="text-primary" for="">Complaint(s) History</label>
              @if(count($complaints)>0)
              @foreach ($complaints as $data)
                <div class="card border">
                  <div class="row" style="padding: 20px">
                        <div class="col-lg-12" >                        
                          <div class="accordion" id="{{$data->id}}">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="{{$data->id}}headingOne">
                                <button class="accordion-button text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$data->id}}" aria-expanded="true" aria-controls="collapseOne">
                                  {!! substr($data->description, 0,100) . '.....'!!}
                                </button>
                              </h2>
                              <div id="collapseOne{{$data->id}}" class="accordion-collapse collapse" aria-labelledby="{{$data->id}}headingOne" data-bs-parent="#{{$data->id}}">
                                <div class="accordion-body">
                                  {!! $data->description !!}
                                </div>
                              </div>
                            </div>
                          </div>
                          <br>
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
                    <span style="text-align:center" class="text-muted">No Complaints Found</span>
                  @endif
            </div>
        </div>

     </div>
   </div>
 </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
@endsection
