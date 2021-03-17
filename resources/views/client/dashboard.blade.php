@extends('layouts.ClientMaster')

@section('title')
    Dashboard | CRD
@endsection

@section('styles')
 <link href="{{asset('/assets/css/chat.css" rel="stylesheet')}}" />
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
          <h4 class="card-title">Dashboards</h4>
          <p class="card-category">Details of projects that are registered in the system</p> 
        </div>

        <div class="card-body">
            <div class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                          </div>
                          <p class="card-category">Assigned Systems</p>
                          <h3 class="card-title">{!!Helper::getcountProjects_client(Auth::user()->user_id)!!}</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-success">content_copy</i>
                            <a href="/client/purchased-systems" class="text-dark">Systems</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                          <div class="card-icon">
                            <i class="material-icons">report_problem</i>
                          </div>
                          <p class="card-category">Pending Complaints</p>
                          <h3 class="card-title">{!!Helper::getCountComplaint_client(Auth::user()->user_id)!!}</h3>
                        </div>
                        <div class="card-footer">
                          <div class="stats">
                            <i class="material-icons text-danger">report_problem</i>
                            <a href="/client/clients-complaints" class="text-dark">Complaints</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="card card-chart">
                        <div class="card-header card-header-success">
                        </div>
                        <div class="card-body"> 
                          <h4 class="card-title">Systems</h4>
                          <table class="text-muted table "  style="font-size: 12px">
                            <tr>
                              <th><i class="material-icons text-success" >check_circle_outline</i></th>
                              <th>Wokring Systems:</th>
                              <th style="text-align: right"><b>{!!Helper::getSystemStatus(Auth::user()->user_id,1)!!}  </b></th>
                            </tr>
                            <tr>
                              <th><i class="material-icons text-danger">highlight_off</i> </th>
                              <th>Not Systems:</th>
                              <th style="text-align: right"><b>{!!Helper::getSystemStatus(Auth::user()->user_id,0)!!} </b></th>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="card card-chart">
                        <div class="card-header card-header-danger">
                        </div>
                        <div class="card-body"> 
                          <h4 class="card-title">Complaint Status</h4>
                          <table class="text-muted table" style="font-size: 12px">
                            <tr>
                              <th>DEVELOPER(S) NOT ASSIGNED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay(Auth::user()->user_id,0)!!}  </b></th>
                            </tr>
                            <tr>
                              <th>DEVELOPER(S) ASSIGNED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay(Auth::user()->user_id,1)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SEEN BY DEVELOPER</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay(Auth::user()->user_id,2)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SOLUTION GIVEN BY DEVELOPER</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay(Auth::user()->user_id,3)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SOLUTION REJECTED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay(Auth::user()->user_id,4)!!} </b></th>
                            </tr>
                            <tr>
                              <th>SOLVED</th>
                              <th style="text-align: right"><b>{!!Helper::getComplaintStatusDisplay(Auth::user()->user_id,5)!!} </b></th>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
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

<script>
 var botmanWidget = {
   
  frameEndpoint: '/iFrameUrl',
  aboutText:'',
  title: "PMFM Client Assistant",
  introMessage: "Hello there! ✋ I'm your PMFM System Assistant.<br><br>Type 'hi' to receive my services",
  mainColor: 'linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,50,161,1) 0%, rgba(0,185,255,0.9864320728291317) 100%',
  headerTextColor: '#ffff',
  bubbleAvatarUrl: '/chatboticon.png',
  aboutText: 'Powered by CDRD',
  aboutLink: 'https://crd.lk/',
  bubbleBackground: '#ff76f4',
  placeholderText: 'Ask a question....'

  };
</script>

<script src="{{ asset('/assets/js/widget.js') }}"></script>

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
