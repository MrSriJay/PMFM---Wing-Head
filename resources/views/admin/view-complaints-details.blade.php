@extends('layouts.AdminMaster')


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
       
        <div style="display:none" id="editext">Edit</div >
          {{ Form::open([ 'method'  => 'PATCH', 'route' => [ 'complaints.update', $complaints->id ] ]) }}
          {{ csrf_field() }}
            
        <label for="recipient-name" class="col-form-label text-light">System Name:</label>
            <a href="admin/projects/{{$complaints->project_id}}" class="btn btn-primary float-right" style="margin:20px" data-toggle="" data-target="" ><i class="material-icons">preview</i> View Project</a>
            <h3 class="card-title">
               <strong id="o_name">{!!$complaints->system_name!!}</strong>
               <input style="display: none" type="text" name ="system_name" style="font-size: 50px" id ="system_name" class="form-control text-light text-lg"  value="{{ old('system_name',$complaints->system_name) }}"  placeholder="e.g. Mahela"  required value="">
            </h3> 
        </div>
        <div class="card-body" >

            @if (session('status'))
            <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
            </div>
            @endif

            @if($complaints->status==0)
                <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                    <strong>Developer not assigned</strong> Please assign developer(s)<strong><br><a href="#" class="alert-link text-danger"> Assign Now </a></strong>
                </div>
             @elseif($complaints->status==1)
             
             @endif

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
                          <a id="downbtn"  name="downbtn" style="margin-right:20px" class="btn btn-success float-right" href="/storage/{{$complaints->files}}/{!! basename($file)!!}"  target="_blank">Open  <span class="material-icons">import_contacts</span></a>
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

            <!--Assign Developers-->
            <div class="form-group"> 
              <label for="message-text" class="col-form-label text-primary">Assign Developers</label>
              <br>
              <div class="row col-lg-12">
                <div class="col-lg-4 border border-light">
                    <div class="form-group">
                      <form action="/admin/projects" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                      <select id="dev_name" class="livesearch form-control" name="dev_name"  @error('dev_name') is-invalid @enderror value="{{ old('dev_name') }}" style="width:99%;"  required>
                      </select>
                          <br>
                          <a class=" Backspace btn   btn-primary text-light  float-right btn-sm">Assign</a>
                      </div>
                    </form>
                </div>
                <div class="col-lg-8 border border-primary" style="padding: 20px">
                        <tr style="width: 100%">
                          <th>Name</th>
                           <th><button class="btn btn-sm btn-outline-danger float-right">D</button></th>
                          </tr>
                </div>
                @error('developers')
                <span style="color:red">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
              
            </div>
  
             <!--View Sender Details-->

            <div class="card border-success mb-3" style="width: 30rem;">
                <div class="card-header">Client Details</div>
                <div class="card-body text-primary">
                    <p class="card-text">{!!(Helper::getSenderDetails($complaints->organization_name))!!}</p>
                </div>
              </div>
  
            <!--Save and Cancel Buttons-->
            <div style="text-align:right" id="buttons"> 
               <button type="button" class="btn btn-danger" id="delete" style="display:none"  data-toggle="modal" data-target="#deleteModal">
                  <span class="material-icons">delete_forever</span> Delete
               </button>
               <button type="button" class="btn btn-success" id="update" style="display:none" data-toggle="modal" data-target="#updatemodal">
                  <span class="material-icons">update</span> Update
               </button>
                
            </div> 
      
        </div> 
      </div>
    </div>
  </div>
  <!--Update Modal --->
  <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Client Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to update the client details? </p>
        </div> 
       
        <div class="modal-footer">
              <button type="submit" class="btn btn-success">Yes, Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
        </div>
      </div>
    </div>
  </div>
  
{{ Form::close() }}

<script type="text/javascript">

$('#dev_name').select2({
        placeholder: 'Select System Name',
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