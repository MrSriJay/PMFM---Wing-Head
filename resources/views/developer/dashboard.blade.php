@extends('layouts.DeveloperMaster')

@section('title')
    Dashboard | NBC
@endsection

@section('content')
    

 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <h4 class="card-title">Dashboard</h4>
          <p class="card-category">Welcome to Project Monitoring and Fault Management System</p> 
        </div>

        <div class="card-body">
            <div class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">report_problem</i>
                          </div>
                          <p class="card-category">Assigned Complaint</p>
                          <h3 class="card-title">{!!Helper::getCompalints(Auth::user()->user_id)!!}
                          </h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-danger">report_problem</i>
                            <a href="/developer/developer-complaints" class="text-dark">Complaints</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card card-chart">
                        <div class="card-header card-header-danger">
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">Latest Complaint</h4>
                          <p class="card-category">
                            <a href="/winghead/wings-complaints" style="color: rgb(122, 122, 122)">{!!Helper::getLatestComplaint_Developer(Auth::user()->user_id)!!}</a>
                            </p>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">access_time</i> added on {!!Helper::getLatestComplaintDate_Developer(Auth::user()->user_id)!!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card card-chart">
                        <div class="card-header card-header-warning">
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">Latest Message</h4>
                          <p class="card-category">{!!Helper::getLatestMessage(Auth::user()->user_id)!!}</p>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">person_pin</i> sent by {!!Helper::getName(Helper::getLatestMessage_By(Auth::user()->user_id))!!} 
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
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
