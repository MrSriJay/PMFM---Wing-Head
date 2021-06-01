@extends('layouts.AdminMaster')

@section('title')
    Dashboard | PMFM
@endsection

@section('content')
 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <h4 class="card-title">Dashboard</h4>
          <p class="card-category">Details related to system's performance and fault management</p> 
        </div>

        <div class="card-body">
            <div class="content">
                <div class="container-fluid">
                  <a href="#systems" class="btn btn-secondary btn-sm "  data-toggle="" data-target="" >Systems</a>
                  <a href="#complaints" class="btn btn-secondary btn-sm "  data-toggle="" data-target=""> Complaints </a>
                  <a href="#messages" class="btn btn-secondary btn-sm "  data-toggle="" data-target="" >Messages</a>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">people</i>
                          </div>
                          <p class="card-category">Users</p>
                          <h3 class="card-title">25</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">update</i>Updated 2 minutes ago
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">account_balance</i>
                          </div>
                          <p class="card-category">Wings</p>
<<<<<<< HEAD
                          <h3 class="card-title">{!!Helper::getWingsCount()!!}
=======
                          <h3 class="card-title">10
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
                          </h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-warning">account_balance</i>
                            <a href="/admin/wings" class="text-dark">Wings</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">content_paste</i>
                          </div>
<<<<<<< HEAD
                          <p class="card-category">Systems</p>
                          <h3 class="card-title">{!!Helper::getProjectsCount()!!}</h3>
=======
                          <p class="card-category">Projects</p>
                          <h3 class="card-title">100</h3>
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-success">content_paste</i>
                            <a href="/admin/projects" class="text-dark">Projects</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                          <div class="card-icon">
<<<<<<< HEAD
                            <i class="material-icons">people</i>
                          </div>
                          <p class="card-category">Officers</p>
                          <h3 class="card-title">{!!Helper::getOfficerCount()!!}</h3>
=======
                            <i class="material-icons">report_problem</i>
                          </div>
                          <p class="card-category">Complaints</p>
                          <h3 class="card-title">75</h3>
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-info">people</i>
                            <a href="/admin/users" class="text-dark">Officers</a>                          </div>
                        </div>
                      </div>
                    </div>
<<<<<<< HEAD
                    <div class="col-lg-3 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-primary card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">corporate_fare</i>
                          </div>
                          <p class="card-category">Clients</p>
                          <h3 class="card-title">{!!Helper::getClientCount()!!}</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-primary">corporate_fare</i>
                            <a href="/admin/clients" class="text-dark">Clients</a> 
                          </div>
                        </div>
                      </div>
                    </div>
=======
                    
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
                  </div>
                  <div class="row">
                    <div class="col-md-12" id="systems">
                      <div class="card card-chart">
                        <div class="card-header card-header-success">
                        </div>
                        <div class="card-body"> 
                          <h4 class="card-title">Systems</h4>
                          <table class="text-muted table "  style="font-size: 12px">
                            <tr class="bg-light">
                              <th>Total Systems</th>
                              <th style="text-align: right"><b>{!!Helper::getProjectsCount()!!}  </b></th>
                            </tr>
                            <tr>
                              <th class="text-succsss"><i class="material-icons text-success" >check_circle_outline</i> Wokring Systems:</th>
                              <th style="text-align: right"><b>{!!Helper::getSystemStatus_admin(1)!!}  </b></th>
                            </tr>
                            <tr>
                              <th class="text-danger"><i class="material-icons text-danger">highlight_off</i> Fault Systems:</th>
                              <th style="text-align: right"><b>{!!Helper::getSystemStatus_admin(0)!!} </b></th>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6" id="complaints">
                      <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">report_problem</i>
                          </div>
                          <p class="card-category">Complaints</p>
                          <h3 class="card-title">{!!Helper::getComplaintCount()!!}
                          </h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-danger">report_problem</i>
                            <a href="/admin/complaints" class="text-dark">Complaints</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="card card-chart">
                        <div class="card-header card-header-danger">
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">Latest Complaint</h4>
                          <p class="card-category">
                            <a href="/admin/complaints" style="color: rgb(122, 122, 122)">{!!Helper::getLatestComplaint_Admin()!!}</a>
                            </p>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">access_time</i> added on {!!Helper::getLatestComplaintDate_Admin()!!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-chart">
                        <div class="card-header card-header-danger">
                        </div>
                        <div class="card-body"> 
                          <h4 class="card-title">Complaint Status Summary</h4>
                          <table class="text-muted table" style="font-size: 12px">
                            <tr>
                              <th>DEVELOPER(S) NOT ASSIGNED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay_admin(0)!!}  </b></th>
                            </tr>
                            <tr>
                              <th>DEVELOPER(S) ASSIGNED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay_admin(1)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SEEN BY DEVELOPER</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay_admin(2)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SOLUTION GIVEN BY DEVELOPER</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay_admin(3)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SOLUTION REJECTED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay_admin(4)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SOLVED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay_admin(5)!!} </b></th>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12" id="messages">
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
