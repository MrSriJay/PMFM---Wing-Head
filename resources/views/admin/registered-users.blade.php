@extends('layouts.TableMaster')

@section('title')
    Registered Users | NBC
@endsection

@section('content')

{{-- Delete Modal --}}
<!-- Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form id="delete_user_Form" method="POST">
        {{ csrf_field() }}
        {{ method_field("DELETE") }}
      <div class="modal-body">
        <input type="hidden" id="delete_user_id"> 
        <h5>Are you sure you want to delete this user?</h5>
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
          <!--<a href="" class="btn btn-info float-right py-2">ADD</a>-->
          <h4 class="card-title">Registered Users</h4>
          <p class="card-category">Details of users who are already registered in the system</p>
        </div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
          </div>
        @endif
          <div class="table-responsive">
            <table id="datatable" class="table">
              <thead class="text-primary">
                <th style="text-align:center">UserID</th>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Contact Number</th>
                <th style="text-align:center">Email</th>
                <th style="text-align:center">Usertype</th>
                <th style="text-align:center">EDIT</th>
                <th style="text-align:center">DELETE</th>
              </thead>
              <tbody>
                @foreach ($users as $row)
                <tr>
                  <td style="text-align:center">{{ $row->id }}</td>
                  <td style="text-align:center">{{ $row->name }}</td>
                  <td style="text-align:center">{{ $row->phone }}</td>
                  <td style="text-align:center">{{ $row->email }}</td>
                  <td style="text-align:center">-{{ $row->usertype }}</td>
                  <td style="text-align:center">
                    <a href="/user-edit/{{ $row->id }}" class="btn btn-info">EDIT</a>  
                  </td> 
                  <td style="text-align:center">
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
          
          $('#delete_user_id').val(data[0]);

          $('#delete_user_Form').attr('action', '/user-delete/'+data[0]);

          $('#deletemodalpop').modal('show');

      });
  });
</script>

@endsection
