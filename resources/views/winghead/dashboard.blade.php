@extends('layouts.WingheadMaster')

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
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">people_outline</i>
                          </div>
                          <p class="card-category">Officers Assigned</p>
                          <h3 class="card-title">{!!Helper::getcountOfficers(Auth::user()->wing_name)!!}
                          </h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-info">people</i>
                            <a href="/winghead/wings-users" class="text-dark">Offices</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                          </div>
                          <p class="card-category">Delivered Projects</p>
                          <h3 class="card-title">{!!Helper::getcountProjects(Auth::user()->wing_name)!!}</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-success">content_copy</i>
                            <a href="/winghead/wings-users" class="text-dark">Projects</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">report_problem</i>
                          </div>
                          <p class="card-category">New Complaints</p>
                          <h3 class="card-title">{!!Helper::getCountComplaintsWinghead(Auth::user()->wing_name)!!}</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-danger">report_problem</i>
                            <a href="/winghead/wings-users" class="text-dark">Complaints</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">chat</i>
                          </div>
                          <p class="card-category">New Messages</p>
                          <h3 class="card-title">{!!Helper::getMessagesforWinghead(Auth::user()->user_id)!!}</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-warning">chat</i>
                            <a href="/winghead/wings-projects" class="text-dark">Messages</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card card-chart">
                        <div class="card-header card-header-danger">
                          <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">Latest Complaint</h4>
                          <p class="card-category">
                            <a href="/winghead/wings-complaints" style="color: rgb(122, 122, 122)">{!!Helper::getLatestComplaint_WingHead(Auth::user()->wing_name)!!}</a>
                            </p>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">access_time</i> added on {!!Helper::getLatestComplaintDate_WingHead(Auth::user()->wing_name)!!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card card-chart">
                        <div class="card-header card-header-warning">
                          <div class="ct-chart" id="websiteViewsChart"></div>
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
