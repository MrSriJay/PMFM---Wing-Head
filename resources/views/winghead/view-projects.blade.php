@extends('layouts.WingheadMaster')

@section('title')
    Projects | NBC
@endsection

@section('content')
    
{{-- Delete Modal --}}
<!-- Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Delete Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form id="delete_project_Form" method="POST">
        {{ csrf_field() }}
        {{ method_field("DELETE") }}
      <div class="modal-body">
        <input type="hidden" id="delete_project_id"> 
        <h5>Are you sure you want to delete this project?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Yes, Delete It.</button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- End - Delete Model --}}

 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <a href="project-form" class="btn btn-success float-right" style="margin:20px" data-toggle="" data-target="">Add New Project</a>
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
                    <img style="width:100%" src="/storage/project_icons/{{$data->project_icon}}">
                  </div>  
                  <div class="card-header"> 
                  <div class="col-md-12 col-sm-12">
                  <h3><a class="card-title text-primary" href="/project-register-view/{{$data->id}}">{{$data->title}}</a></h3>
                  <small class="text-danger">Posted on {{$data->created_at}}</small>
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
