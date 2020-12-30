@extends('layouts.TableMaster')

@section('title')
    Complaints | NBC
@endsection

@section('content')
    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Add Complaint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/save-complaint" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="modal-body">
              <div class="form-group py-3">
                  <label for="recipient-name" class="col-form-label">System</label>
                  <input type="text" name="system" class="form-control @error('system') is-invalid @enderror" required id="system">
                  @error('system')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div class="form-group py-3">
                  <label for="recipient-name" class="col-form-label">Description</label>
                  <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"></textarea>
                  @error('description')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div>
                  <label for="recipient-name" class="col-form-label">Images</label>
                  <input type="file" name="images" class="form-control @error('images') is-invalid @enderror" id="images">
                  @error('images')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>
              <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                <label for="recipient-name" class="col-form-label">Date</label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" required placeholder="Select date" id="date">
                @error('date')
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
      
      <form id="delete_complaint_form" method="POST">
        {{ csrf_field() }}
        {{ method_field("DELETE") }}
      <div class="modal-body">
        <input type="hidden" id="delete_complaint_id"> 
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
          <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">ADD Complaint</button>
          <h4 class="card-title ">Complaints Details</h4>
          <p class="card-category">Complaints of projects that are submitted by clients</p>
            
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
                <th style="text-align:center" class="w-10p">ComplaintID</th>
                <th style="text-align:center" class="w-10p">System</th>
                <th style="text-align:center" class="w-10p">Description</th>
                <th style="text-align:center" class="w-10p">Images</th>
                <th style="text-align:center" class="w-10p">Date</th>
                <th style="text-align:center" class="w-10p">EDIT</th>
                <th style="text-align:center" class="w-10p">DELETE</th>
              </thead>
              <tbody>
                  @foreach ($complaints as $data)
                <tr>
                    <td style="text-align:center">{{ $data->id }}</td>
                    <td style="text-align:center">{{ $data->system_name }}</td>
                    <td style="text-align:center">
                      <div style="height:80px; overflow: hidden;">
                        {{ $data->description }}
                      </div>
                    </td>
                    <td style="text-align:center">{{ $data->images }}</td>
                    <td style="text-align:center">{{ $data->date }}</td>
                    <td style="text-align:center">
                       <a href="{{ url('complaint-edit/'.$data->id) }}" class="btn btn-info">Edit</a>  
                    </td>
                    <td style="text-align:center">
                       <a href="javascript:void(0)" class="btn btn-danger deletebtn">DELETE</a> 
                    </td> 
                  @endforeach
                </tr>
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
          
          $('#delete_complaint_id').val(data[0]);

          $('#delete_complaint_form').attr('action', '/complaint-register-delete/'+data[0]);

          $('#deletemodalpop').modal('show');

      });
  });
  $('.datepicker').datepicker();

</script>
    
@endsection
