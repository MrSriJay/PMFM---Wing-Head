@extends('layouts.ClientMaster')


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
            <h3 class="card-title">
               <strong id="o_name">{!!$complaints->system_name!!}</strong>
               <input style="display: none" type="text" name ="system_name" style="font-size: 50px" id ="system_name" class="form-control text-light text-lg"  value="{{ old('system_name',$complaints->system_name) }}"  placeholder="e.g. Mahela"  required value="">
            </h3> 
        </div>
        <div class="card-body" >  
          <div class="accordion" id="accordionExample" style="margin-top: -15px">
            <div class="card">
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
                        <div class="row col-lg-12">
                          <br>
                          <div class="col-lg-4 border">
                            <form action="/send-messages" method="POST" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <br>
                              <div class="text-primary"> <span class="material-icons">feedback</span> Remarks</div>
                              <br>
                              <label for="">Message</label>
                              <textarea class="form-control"  required placeholder="Type message here" style="border: 1px sold" name="message" id="message" cols="30" rows="5"></textarea>
                              <br>
                              <label for="">To</label>

                              <select id="sender_name" class="form-select" style="font-size:16px ; border: 1px sold grey" name="sender_name"  required>
                                <option value="" disabled selected  class="text-muted"> Select User</option>
                                @foreach ($complaint_developer as $data)
                                  <option value="{{$data->developer_id}}" >{!!Helper::getName($data->developer_id)!!}(Officer)</option>
                                @endforeach
                                  <option value="{!!Helper::getWingHead($complaints->wing_id)!!}">{!!Helper::getName(Helper::getWingHead($complaints->wing_id))!!}(Winghead)</option>
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
                                    <div class="text-success" style="font-size: 10px" >From <b>{!!Helper::getName($data->sender)!!} - <i class="text-muted">{!!Helper::getDesignationFromID($data->sender)!!}</b></div>
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
                    <!--Assigned Developers-->
                    <div class="form-group" id="assign_Dev"> 
                      <label for="message-text" class="col-form-label text-primary">Assigned Developers</label>
                      <br>
                      <div class="row col-lg-12 border-secondary">
                        <div class="col-lg-8 border border-light" style="padding: 20px">
                                @if(count($complaint_developer)>0)
                                @foreach ($complaint_developer as $data)
                                  <div class="row bg-muted">
                                      <div class="col-lg-12">
                                        {!!Helper::getName($data->developer_id)!!}
                                        <div style="margin-top:5px ; margin-bottom:5px">
                                          <small style=" display:block ;margin-top:-10px; color:#6b6b6b">📞 Contact No : {!!Helper::getDeveloperContact($data->developer_id)!!}</small>
                                          <small style=" display:block ;margin-top:-10px; color:#6b6b6b">📧 Email: {!!Helper::getDeveloperEmail($data->developer_id)!!}</small>
                                        </div>
                                      
                                        <small style=" display:block ;margin-top:-10px; color:#bfbfbf" ><i>Assigned by {!!Helper::getName($data->assigned_by)!!} on {!!$data->created_at!!} </i></small>
                                      </div>
                                  </div> 
                                @endforeach
                                @else 
                                  <p align-text="center">No developers assigned</p>
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
                      <p align-text="center">No fix messages yet</p>
                    @endif

                  </div>
                </div>
              </div>
            </div>
           </div>
           @if (session('status'))
            <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
            </div>
            @endif

            @if($complaints->status==3)
            <div class="alert alert-success" role="alert">
              <p>Developer has fixed the reported issue with the system</p>
              <h4 class="alert-heading" style="font-weight: bolder">Are you satisfied with the solution?</h4>

              <form style="display: inline" action="/developer/clients-solved" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="comp_id" value="{{$complaints->id}}">
                <input type="hidden" name="proj_id" value="{{$complaints->project_id}}">
                <button class="btn btn-secondary text-success">Yes</button>
              </form>
              <form  style="display: inline" action="/developer/clients-not-solved" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="comp_id" value="{{$complaints->id}}">
                <button class="btn btn-secondary text-success">No</button>
              </form>
          
            </div>
            @endif

            @if($complaints->status==0)
                <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                    <strong>Developer(s) not yet assigned</strong> 
                </div>
             @elseif($complaints->status==1)
             
             @endif
             <br>
             <i><span>COMPLAINT STATUS: <b class="text-primary">{!!Helper::getComplaintStatus($complaints->status)!!}</b></span></i>

            <!--View Complaint Description-->
            <div class="form-group"> 
              <label for="message-text" class="col-form-label text-primary">Complaint Description:</label>
              <br>
              <span id="dec0" >{!!$complaints->description!!}</span>
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

        </div> 
      </div>
    </div>
  </div>


<script type="text/javascript">

$('#dev_name').select2({
        placeholder: 'Select Developer Name',
        ajax: {
            url: '/com-dev-admin',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                           /* text: item.title,
                            id: item.id
                            */
                            text: item.first_name+" "+item.last_name,
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