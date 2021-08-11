@extends('layouts.WingheadMaster')


@section('title')
Projects - View | PMFM
@endsection 
@section('styles')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js"></script>
    <script src="https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js"></script>
    <link href="../assets/css/fle-styles.css" rel="stylesheet" />
    
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary"> 

        <label for="recipient-name" class="col-form-label text-light">System Name:</label>

            <a href="/winghead/wings-projects/{{$complaints->project_id}}" class="btn btn-primary float-right" style="margin:20px" data-toggle="" data-target="" ><i class="material-icons">preview</i> View Project</a>


            <h3 class="card-title">
               <strong id="o_name">{!!$complaints->system_name!!}</strong>
               <input style="display: none" type="text" name ="system_name" style="font-size: 50px" id ="system_name" class="form-control text-light text-lg"  value="{{ old('system_name',$complaints->system_name) }}"  placeholder="e.g. Mahela"  required value="">
            </h3> 
        </div>
        <div class="card-body" >
          
          <div class="accordion" id="accordionExample" style="margin-top: -15px">
            <div class="">
              <div>
                <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  Feedback
                </button>
                <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Assigned Developers
                </button>
                <button class="btn btn-success collapsed " type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                  Solutions
                </button>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne"  style="border: solid 1px #bfbfbf; "  data-parent="#accordionExample">
                <div class="card-body">
                    
                  <!--Feedbacks -->
                  <div class="form-group" id="remark"> 
                    <div class="row col-lg-12 border" style="margin: 5px; padding:10px">
                      <br>
                      <div class="col-lg-4 border">
                        <form action="/send-messages" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <br>
                          <div class="text-primary"> <span class="material-icons">feedback</span> Feedbacks</div>
                          <br>
                          <label for="">Message</label>
                          <textarea class="form-control" required placeholder="Type message here" style="border: 1px sold" name="message" id="message" cols="30" rows="5"></textarea>
                          <br>
                          <label for="">To</label>

                          <select id="sender_name" class="form-select" style="font-size:16px ; border: 1px sold grey" name="sender_name"  required>
                            <option value="" disabled selected  class="text-muted"> Select User</option>
                            @foreach ($complaint_developer as $data)
                              <option value="{{$data->developer_id}}" >{!!Helper::getName($data->developer_id)!!}(Officer)</option>
                            @endforeach
                              <option value="{{$complaints->client_id}}">{!!Helper::getClientName($complaints->client_id)!!}(Client)</option>
                              <option value="all">Public</option>
                          </select>

                          <input type="hidden" value="{!!$complaints->id!!}" name="comp_id">
                          <div class="form-group">
                            <input class="Backspace btn  btn-success text-light btn-sm" type="submit" style="width:100%" value="Send">
                          </div>
                        </form>
                      </div>
                      <div class="col-lg-8 border">
                        @if(count($message)>0)
                        @foreach ($message as $data)
                          <div class="row bg-muted card" style="margin:10px">
                              <div class="card-body">
                                <div class="text-success" style="font-size: 10px" >From <b>{!!Helper::getName($data->sender)!!} - <i class="text-muted">{!!Helper::getDesignationFromID($data->sender)!!}</i></b></div>
                                <div class="text-primary">{!!$data->message!!} </div>
                                <div class="text-success">
                                  @if($data->receiver!="all")
                                  <span style="font-size: 10px" class="float:left" >To <b>{!!Helper::getName($data->receiver)!!} - <i class="text-muted">{!!Helper::getDesignationFromID($data->receiver)!!}</b></span>
                                  @else
                                  <span style="font-size: 10px" class="float:left" >Public</span>
                                  @endif
                                  <small style=" display:block ;margin-top:-10px; color:#bfbfbf" class="float-right"><i>Sent on {!!$data->created_at!!} </i></small>
                                </div>
                              </div>
                          </div> 
                        @endforeach
                        @else 
                          <br>
                          <p align-text="center">No feedbacks added</p>
                        @endif
                      </div>
                    </div>
                  </div>
        
                  


                </div>
              </div>
              <div id="collapseTwo" class="collapse" style="border: solid 1px #bfbfbf; " aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    

                  <!--Assign Developers-->
                  <div class="form-group" id="assign_Dev"> 
                    <label for="message-text" class="col-form-label text-primary">Assigned Developers</label>
                    <br>
                    <div class="row col-lg-12 border-secondary">
                      <div class="col-lg-4 border border-light">
                          <div class="form-group">
                            <form action="/add-developer" method="POST" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <input type="hidden" value="{!!$complaints->id!!}" name="compId">
                              <select id="dev_name" class="livesearch form-control" name="dev_name"  @error('dev_name') is-invalid @enderror value="{{ old('dev_name') }}" style="width:99%;"  required>
                              </select>
                              <br><br>
                              <input class="Backspace btn  btn-primary text-light btn-sm" type="submit" style="width:100%" value="Assign">
                            </div>
                            </form>
                          @if (session('devstatus'))
                            <label class="text-success">
                              {{ session('devstatus') }}
                            </label>
                          @endif

                          @if (session('error'))
                            <label class="text-danger">
                              {{ session('error') }}
                            </label>
                          @endif


                      </div>
                      <div class="col-lg-8 border border-light" style="padding: 20px">
                              @if(count($complaint_developer)>0)
                              @foreach ($complaint_developer as $data)
                                <div class="row bg-muted">
                                    <div class="col-lg-10">
                                      <a href="/winghead/wings-users/{{$data->developer_id}}">{!!Helper::getName($data->developer_id)!!}</a>
                                      <div style="margin-top:5px ; margin-bottom:5px">
                                        <small style=" display:block ;margin-top:-10px; color:#6b6b6b">📞 Contact No : {!!Helper::getDeveloperContact($data->developer_id)!!}</small>
                                        <small style=" display:block ;margin-top:-10px; color:#6b6b6b">📧 Email: {!!Helper::getDeveloperEmail($data->developer_id)!!}</small>
                                      </div>
                                      <small style=" display:block ;margin-top:-10px; color:#bfbfbf" ><i>Assigned by {!!Helper::getName($data->assigned_by)!!} on {!!$data->created_at!!} </i></small>
                                    </div>
                                    <div class="col-lg-2">
                                      <form action="/delete-developer" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{!!$data->complaint_id!!}" name="comp_id">
                                        <input type="hidden" value="{!!$data->developer_id!!}" name="dev_id">
                                        <button class="btn text-danger btn-secondary float-right"><i class="material-icons">delete</i></button>
                                      </form>
                                    </div>
                                  

                                </div> 
                              @endforeach
                              @else 
                                <p align-text="center">No fix messages yet</p>
                              @endif
                      </div>
                      @error('developers')
                      <span style="color:red">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  </div>

                </div>
              </div>
              

              <!-- Solution Section -->
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" style="border: solid 1px #bfbfbf; " data-parent="#accordionExample">
                <div class="card-body">
                  <div class="col-lg-12 border border-light" style="padding: 5px">
                   
                    @if(count($fix_message)>0)
                    @foreach ($fix_message as $data)
                      <div class="row bg-muted">
                          <div class="col-lg-12">
                            {{ $data->message }}
                            <small style=" display:block ;margin-top:-10px; color:#bfbfbf" ><i>Solution added by {!!Helper::getName($data->developer_id)!!} on {!!$data->created_at!!} </i></small>
                          </div>
                      </div> 
                    @endforeach
                    @else 
                      <p align-text="center">No developers assigned</p>
                    @endif

                  </div>
                </div>
              </div>
            </div>
           </div>
            @if($complaints->status == 3)
              <div class="alert alert-success" role="alert">
                <strong>Complaint fixed by developer!</strong> Waiting for client's feedback on the solution.
              </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
            </div>
            @endif

            @if($complaints->status==0)
                <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                    <strong>Developer(s) not yet assigned</strong><strong><br><br><a href="/winghead/wings-complaints/{!!$complaints->id!!}/#assign_Dev" class="alert-link text-danger"> Assign Now </a></strong>
                </div>
             @elseif($complaints->status==1)
             
             @endif

            <br>
            <i><span>COMPLAINT STATUS: <b class="text-primary">{!!Helper::getComplaintStatus($complaints->status)!!}</b></span></i>

            <!--View Complaint Description-->
            <div class="form-group"> 
              <label for="message-text" class="col-form-label text-primary">Complaint Description:</label>
              <br>
              <span id="dec0">{!!$complaints->description!!}</span>
              
          </div>
          <hr>
              <!--View Complaint Files-->
              <div class="form-group py-4">
                  <label for="message-text" class="col-form-label text-primary">Complaint File(s):</label>
                  <br>
                  <?php $files = Storage::files("/public/\\".$complaints->files); ?>
                  @foreach ($files as $file)
                  <?php $path = storage_path($file); ?>
                  <div class="row border border-light " style="margin-top: 5px" >
                      <div class="col-lg-9 float-left">
                          <samp>{!! basename($file)!!}<br></samp>   
                      </div>
                      <div class="col-lg-3"> 
                          <a id="downbtn"  name="downbtn" style="margin-right:20px" class="btn btn-success float-right" href="/storage/{{$complaints->files}}/{!! basename($file)!!}"  target="_blank"><span class="material-icons">import_contacts</span></a>
                      </div>
                  </div>
                  @endforeach                   
              </div>
              <hr>
            <!--View Urgency Level-->
            <div class="form-group py-4">
                
                <label for="recipient-name" class="col-form-label text-primary">Urgency Level:</label>

                @if($complaints->urgency_level=="medium")
                    <div class="alert alert-warning" >Medium</div>
                @elseif($complaints->urgency_level=="high")
                    <div class="alert alert-danger" >High</div>
                @elseif($complaints->urgency_level=="low")
                    <div class="alert alert-success" style="background-color: seagreen" >Low</div>
                @elseif($complaints->urgency_level=="critical")
                    <div class="alert alert-danger" style="background-color: orangered" >Critical</div>

                @endif
                
            </div>
            
             <!--View Sender Details-->

            <div class="card border-success  col-lg-12" >
                <div class="card-header">Client Details</div>
                <div class="card-body text-primary">

                    <p class="card-text">{!!(Helper::getSenderDetails($complaints->client_id))!!}</p>

                </div>
            </div>

      
        </div> 
      </div>
    </div>
  </div>


<script type="text/javascript">

$('#dev_name').select2({
        placeholder: 'Select Developer Name',
        ajax: {
            url: '/com-dev',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                      var user_rank="";
                      var rank=item.rankname;
                      if(rank=="Civil Personnel"){
                        rank="";
                      }
                      else{
                        rank=item.rankname+". ";
                      }
                        return {
                            text: rank+item.first_name+" "+item.last_name,
                            id: item.user_id
                            
                        }
                    })
                };
            },
            cache: true
        }
    });


    

</script>

@endsection


@section('scripts')
<script>
    

    $(function(){
  var viewModel = {};
  viewModel.fileData = ko.observable({
    dataURL: ko.observable(),
    // base64String: ko.observable(),
  });
  viewModel.multiFileData = ko.observable({
    dataURLArray: ko.observableArray(),
  });
  viewModel.onClear = function(fileData){
    if(confirm('Are you sure?')){
      fileData.clear && fileData.clear();
    }                            
  };
  viewModel.debug = function(){
    window.viewModel = viewModel;
    console.log(ko.toJSON(viewModel));
    debugger; 
  };
  ko.applyBindings(viewModel);
});
    </script>

   <script src="../assets/js/filedrag.js"></script>

@endsection 