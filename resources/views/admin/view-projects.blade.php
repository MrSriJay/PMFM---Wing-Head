@extends('layouts.AdminMaster')

@section('title')
    Projects | NBC
@endsection

@section('content')
    
 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <a href="/admin/projects/create" class="btn btn-success float-right" style="margin:20px" data-toggle="" data-target=""><i class="material-icons">add</i> Add New Project</a>
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
                  <h3><a class="card-title text-primary font-weight-bold " href="admin/projects/{{$data->id}}">{{$data->title}}</a></h3>
                  <span class="text-primary" >Developed for {{$data->clientid}}</span>
                  <br>
                  <small class="text-dark">Posted on {{$data->created_at}}</small>
                  </div>  
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

<script>
  $(document).ready( function () {
      $('#datatable').DataTable();

      $('#datatable').on('click', '.deletebtn', function() {
      
        $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();

          //console.log(data);
          
          $('#delete_project_id').val(data[0]);

          $('#delete_project_Form').attr('action', '/project-register-delete/'+data[0]);

          $('#deletemodalpop').modal('show');

      });
  });
</script>
    
@endsection
