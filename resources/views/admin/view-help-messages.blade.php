@extends('layouts.AdminMaster')

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
         
          <h2 class="card-title"> <i class="material-icons">help</i> Help Messages</h2>

      </div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>  
        @endif
        <div class="table-responsive">
          
          @if(count($help)>0)
            <div class="alert alert-secondary">
              Unreplied Messages: <b>{{ count($help) }} Messages</b>
            </div>
            @foreach ($help as $data)
            <div class="card " id="accordionFlushExample">
              <div class="card-body border border-primary">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label text-primary">Message</label>
                  <br>
                  <strong style="font-size:15px;" >{{$data->message}}</strong>
                </div>
                <div class="mb-3 border bg-light" style="padding: 15px">
                  <form action="/help-reply/{{$data->id}}" method="POST">
                    {{ csrf_field() }}
                    <label for="exampleFormControlTextarea1" class="form-label text-primary">Reply</label>
                    <br>
                    <input type="hidden" name="question" id="" value=" {{$data->message}}">
                    <input type="hidden" name="email" id="" value=" {{$data->email}}">
                   
                    <textarea class="form-control border" name="reply" style="padding:15px" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <button class="btn btn-primary">Reply</button>
                  </form>
                </div>
                <div class="mb-3 row">
                  <div class="col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Name </label>
                    {{$data->name}}
                  </div>
                  <div class="col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Email </label> 
                    {{$data->email}}
                  </div>
                  <div class="col-lg-4">
                    <label for="exampleFormControlInput1" class="form-label">Telephone </label> 
                    {{$data->telephone}}
                  </div>
                </div>
              </div>
            </div>
              
               
                
            @endforeach
           @else 
            <p>No Messages Found</p>
          @endif
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

var alertList = document.querySelectorAll('.alert')
alertList.forEach(function (alert) {
  new bootstrap.Alert(alert)
})

</script>


@endsection
