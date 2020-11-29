@extends('layouts.TableMaster')

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
          <a href="project-form" class="btn btn-success float-right">ADD Complaint</a>
          <h4 class="card-title ">Project Details</h4>
          <p class="card-category">Details of projects that are registered in the system</p>
            
        </div>
        <style>
        .w10-p{
            width: 10% !important;
          }
        </style>
        
        <div class="card-body">
          
          @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
          {{ session('status') }}
          </div>
        @endif
          <div class="table-responsive">
            <table id="datatable" class="table table-stripped">
              <thead class="text-primary">
                <th style="text-align:center" class="w-10p">Project ID</th>
                <th style="text-align:center" class="w-10p">Project Title</th>
                <th style="text-align:center" class="w-10p">Description</th>
                <th style="text-align:center" class="w-10p">Clients</th>
                <th style="text-align:center" class="w-10p">Developer</th>
                <th style="text-align:center" class="w-10p">Contact Number</th>
                <th style="text-align:center" class="w-10p">Email</th>
                <th style="text-align:center" class="w-10p">EDIT</th>
                <th style="text-align:center" class="w-10p">DELETE</th>
              </thead>
              <tbody>
               @foreach ($project as $data)
                <tr>
                 <td>{{ $data->id }}</td>
                 <td>{{ $data->title }}</td>
                 <td>
                   
                    {{ $data->description }}
                  
                 </td>
                 <td>
                 
                   {{ $data->clients }}
                  
                 </td>
                 <td>{{ $data->developer }}</td> 
                 <td>{{ $data->contact_no }}</td>
                 <td>{{ $data->email }}</td>
                  <td>
                    <a href="{{ url('project-register-edit/'.$data->id) }}" class="btn btn-info">EDIT</a>  
                  </td>
                  <td>
                    <a href="javascript:void(0)" class="btn btn-danger deletebtn">DELETE</a> 
                  </td> 
                </tr>
                @endforeach
              </tbody>
            </table>
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
