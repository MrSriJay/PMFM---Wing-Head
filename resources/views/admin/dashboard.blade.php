@extends('layouts.AdminMaster')

@section('title')
    Dashboard | CRD
@endsection

@section('content')
  
 <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 
          <h4 class="card-title">Dashboards</h4>
          <p class="card-category">Details of projects that are registered in the system</p> 
        </div>

        <div class="card-body">
            <div class="content">
                <div class="container-fluid">
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
                          <h3 class="card-title">10
                          </h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-danger">warning</i>
                            <a href="javascript:;">Get More Space...</a>
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
                          <p class="card-category">Projects</p>
                          <h3 class="card-title">100</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                            
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
                          <p class="card-category">Complaints</p>
                          <h3 class="card-title">75</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">local_offer</i> Working
                            <i class="material-icons float-right">local_offer</i> Fault
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card card-chart">
                        <div class="card-header card-header-success">
                          <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">Daily Sales</h4>
                          <p class="card-category">
                            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card card-chart">
                        <div class="card-header card-header-warning">
                          <div class="ct-chart" id="websiteViewsChart"></div>
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">Email Subscriptions</h4>
                          <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card card-chart">
                        <div class="card-header card-header-danger">
                          <div class="ct-chart" id="completedTasksChart"></div>
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">Completed Tasks</h4>
                          <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
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
