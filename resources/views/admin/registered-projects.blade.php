@extends('layouts.TableMaster')

@section('title')
    Projects | NBC
@endsection

@section('content')
    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Add Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/save-projects" method="POST">
          {{ csrf_field() }}

          <div class="modal-body">
              <div class="form-group py-3">
                  <label for="recipient-name" class="col-form-label">Project Title:</label>
                  <input type="text" name="projecttitle" class="form-control @error('projecttitle') is-invalid @enderror" required id="projecttitle">
                  @error('projecttitle')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="form-group py-3">
                  <label for="recipient-name" class="col-form-label">Description</label>
                  <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" required id="description"></textarea>
                  @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="form-group py-3">
                <label for="message-text" class="col-form-label">Client</label>
                <input type="text" name="client" class="form-control @error('client') is-invalid @enderror" required id="client">
                @error('client')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group py-3">
                <label for="message-text" class="col-form-label">Developer</label>
                <input type="text" name="developer" class="form-control @error('developer') is-invalid @enderror" required id="developer">
                @error('developer')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group py-3">
                <label for="message-text" class="col-form-label">Contact Number</label>
                <input type="text" name="contactno" class="form-control @error('contactno') is-invalid @enderror" required id="contactno">
                @error('contactno')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group py-3">
                <label for="message-text" class="col-form-label">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" required id="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">SAVE</button>
          </div>
      </form>
     
    </div>
  </div>
</div>

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
        <input type="text" id="delete_project_id"> 
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
          <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">ADD Project</button>
          <!--<a href="" class="btn btn-info float-right py-2">ADD</a>-->
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
                <th class="w-10p">Project ID</th>
                <th class="w-10p">Project Title</th>
                <th class="w-10p">Description</th>
                <th class="w-10p">Client</th>
                <th class="w-10p">Developer</th>
                <th class="w-10p">Contact No</th>
                <th class="w-10p">Email</th>
                <th class="w-10p">EDIT</th>
                <th class="w-10p">DELETE</th>
              </thead>
              <tbody>
               @foreach ($project as $data)
                <tr>
                 <td>{{ $data->id }}</td>
                 <td>{{ $data->title }}</td>
                 <td>
                   <div style="height:80px; overflow: hidden;">
                    {{ $data->description }}
                   </div>
                 </td>
                 <td>{{ $data->client }}</td>
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
