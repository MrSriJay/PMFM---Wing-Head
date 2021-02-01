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
        {{ Form::open([ 'method'  => 'PATCH', 'route' => [ 'projects.update', $project->id ], 'enctype'=> 'multipart/form-data' ]) }}
        {{ csrf_field() }}
        <div class="card">  
            <div class="card-header card-header-primary">
                <a  class="btn btn-primary float-right" style="margin:20px" id="edit" onclick="toggleEdit()" > <i class="material-icons">edit</i>Edit</a>
                <div style="display:none" id="editext">Edit</div >
                <label for="recipient-name" class="col-form-label text-light" >Project Title</label>
                <h3 class="card-title">
                    <strong id="title0">{!!$project->title!!}</strong>
                    <input  type="text" style="display:none; font-size:20px" name ="title" id="title1" class="form-control text-white"  @error('title') is-invalid @enderror  required value="{!!$project->title!!}">
                </h3>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success py-2" role="alert">
                {{ session('status') }}
                </div>
                @endif
                  @if($project->status==1)
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>System is in good health !</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                   @elseif($project->status==0)
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>System not working!</strong> Please view the complaint(s).<br> <strong><a href="#" class="alert-link"> Learn More</a></strong>
                    </div>
                @endif
                <div class="col-md-12">
                        
                        <!--View Project Icon-->
                        <div class="form-group float-right">                
                        </div>

                         <!--View Description-->
                        <div class="form-group"> 
                            <label for="message-text" class="col-form-label text-primary">Project Description</label>
                            <br>
                            <span id="dec0" >{!!$project->description!!}</span>

                            <div id="dec1" style="display:none" >
                                <textarea  class="form-control" id="summary-ckeditor" name="summary-ckeditor" required rows="6" cols="5">{{$project->description}}</textarea>
                            </div>
                            @error('summary-ckeditor')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                         <!--View supervisor-->
                        <div class="form-group">
                            <label for="message-text" class="col-form-label text-primary">Project Supervisor</label>
                            <br>
                            <select id="developer_name" disabled  class="livesearch form-control" name="supervisor" style="width:99%;"  required>
                                <option value="{!!$project->projectInchargeId!!}" >{!!Helper::getName($project->projectInchargeId)!!}</option>
                            </select>
                            <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                              Please Select Developer Name 
                            </div>
                            @error('supervisor')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!--View clientid-->
                        <div class="form-group">
                            <label for="message-text" class="col-form-label text-primary">Client Name</label>
                            <br>
                            <select id="client_name" disabled class="livesearch form-control" name="clientid" style="width:99%;"  required>
                                <option value="{!!$project->clientid!!}" >{!!Helper::getClientName($project->clientid)!!}</option>
                            </select>
                            <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                              Please Select Client Name 
                            </div>
                            @error('clientid')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                         <!--View developers-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Project Officer(s)</label>
                            <br>
                            <div class="row col-lg-12">
                                <div class="col-lg-4 border border-light" id="dev_edit" style="display: none">
                                    <div class="form-group">
                                        <input type="text" name="country_name" id="country_name" class="form-control input-lg" placeholder="Enter Developer Name" />
                                        <div id="countryList">
                                        </div>
                                        <br>
                                        <a  class="AddTo btn btn-secondary text-primary btn-sm" ><span class="material-icons">person_add</span></a>
                                        <a  class=" Backspace btn  btn-secondary text-primary float-right btn-sm"><span class="material-icons">person_remove</span></a>
                                    </div>
                                </div>
                                <div class="col-lg-8 border border-light">
                                    <textarea type="text" style="display :block; margin: 10px; width:100%; height:100%; border:0px; font-size:14px" rows="4" id="devops" name="developers" value="{{ old('developers') }}"  readonly placeholder="No Assigned Developers">{!!$project->developers!!}</textarea>
                                </div>
                             
                            </div>
                            @error('developers')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!--Insert wing-->
                        <div class="form-group  py-4">
                            <label for="message-text" class="col-form-label text-primary">Wing</label>
                            <select id="wing_name" disabled  class="livesearch form-control" name="wing_name" value="{{ old('wing_name') }}" style="width:99%;"  required>
                                <option value="{!!$project->wingid!!}" selected >{!!Helper::getWingName( $project->wingid )!!}</option>
                            </select>
                            <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                            Please Select Wing Name 
                            </div>
                            @error('wing_name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> 


                         <!--View Start Date-->
                        <div id="date-picker-example" class="md-forms md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Start Date</label>
                            <br>
                            <input type="date" name="startdate"  id="startdate" readonly class="form-control" value="{!!$project->startdate!!}" required placeholder="Select date" id="startdate">
                            @error('startdate')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--View End Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">End Date</label>
                            <br>
                            <input type="date" name="enddate" id="enddate" readonly class="form-control"  value="{!!$project->enddate!!}" required placeholder="Select date" id="date">
                            @error('enddate')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--View Uploaded Files-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Project File(s)</label>
                            <br>
                            <?php $files = Storage::files("/public/\\".$project->files); ?>
                            @foreach ($files as $file)
                            <?php $path = storage_path($file); ?>
                            <div class="row border border-light " style="margin-top: 5px" >
                                <div class="col-lg-9 float-left">
                                    <samp>{!! basename($file)!!}<br></samp>   
                                </div>
                                <div class="col-lg-3"> 
                                    <a id="downbtn"  name="downbtn" class="btn btn-success float-right" style="margin-right:10px;padding:10px;border-radius:80%" href="/storage/{{$project->files}}/{!! basename($file)!!}"  target="_blank"> <span class="material-icons">save_alt</span></a>
                                </div>
                            </div>
                            @endforeach                   
                        </div>

                        <!--Upload Files-->
                        <div id="morefiles" style="display: none">
                            <label for="recipient-name" class="col-form-label py-3 text-sm">Upload More File(s)</label>
                            <fieldset>   

                              <input type="hidden" id="path" name="path" value="{{$project->files}}" />
                              <div>
                                  <label for="fileselect">Files to upload:</label>
                                  <input type="file" id="fileselect" name="file[]" multiple="multiple" />
                              </div>
                             </fieldset>
                              <div id="messages">
                              <p></p>
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

            <!--Update Modal --->
            <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <p>Are you sure you want to update the project details </p>
                    </div> 
                
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Yes, Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
                    </div>
                </div>
                </div>
            </div>
            
            {{ Form::close() }} 
            
            
            
  
        </div>

        <!--Delete Modal --->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>Are you sure you want to delete project </p>
                </div> 
                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'projects.destroy', $project->id ] ]) }}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Yes, Delete</button>
                    {{ Form::close() }}
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>    

<script type="text/javascript">

    $('#developer_name').select2({
        placeholder: 'Select Developer Name',
        ajax: {
            url: '/admin-supervisor-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.first_name+" "+item.last_name,
                            id: item.user_id
                        }
                    })
                };
            },
            cache: true
        }
    });


    $('#client_name').select2({
        placeholder: 'Select Client Name',
        ajax: {
            url: '/client-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.organization_name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#wing_name').select2({
        placeholder: 'Select System Name',
        ajax: {
            url: '/wings-search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.wing_name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    
    var values = [];

    $(function(){

    $('.AddTo').on('click', function() {
        values.push($('#country_name').val());
      $('#devops').val( values.join(" \n") );
      $("#country_name").val("");
    });

    $('.Backspace').on('click', function(){
        values.pop();
        $('#devops').val( values.join(" ") );
    });

});
    

</script>

<script>


    function toggleEdit() {    
     var i= document.getElementById("editext");
     if(i.innerHTML=="Edit"){
        document.getElementById("title0").style.display = "none";
         document.getElementById("title1").style.display = "block";

         document.getElementById("dec0").style.display = "none";
         document.getElementById("dec1").style.display = "block";

         document.getElementById("developer_name").disabled = false;
         document.getElementById("client_name").disabled = false;
         document.getElementById("dev_edit").style.display = "block";
         document.getElementById("wing_name").disabled = false;

         document.getElementById("startdate").readOnly = false;
         document.getElementById("enddate").readOnly = false;

         document.getElementById("update").style.display = "inline";
         document.getElementById("delete").style.display = "inline";
         document.getElementById("edit").classList.add("btn-danger");
         document.getElementById("morefiles").style.display = "block";
         document.getElementById("downbtn").style.display = "none";
         

         i.innerHTML="Cancel"
     }
     else{
         document.getElementById("title0").style.display = "block";
         document.getElementById("title1").style.display = "none";

         document.getElementById("dec0").style.display = "block";
         document.getElementById("dec1").style.display = "none";

         document.getElementById("developer_name").disabled = true;
         document.getElementById("client_name").disabled = true;
         document.getElementById("dev_edit").style.display = "none";
         document.getElementById("wing_name").disabled = true;

         document.getElementById("startdate").readOnly = true;
         document.getElementById("enddate").readOnly = true;

         document.getElementById("update").style.display = "none";
         document.getElementById("delete").style.display = "none";
         document.getElementById("edit").classList.remove("btn-danger");
         document.getElementById("edit").classList.add("btn-primary");

         document.getElementById("morefiles").style.display = "none";
         document.getElementById("downbtn").style.display = "inline";

         i.innerHTML="Edit"
         i=0
     }
 }
 
 </script>

@endsection


 
@section('scripts')
<script>

    $('#deleteModal').on('shown.bs.modal', function () {
      $('#name').trigger('focus')
    })
    
    $('#updatemodal').on('shown.bs.modal', function () {
      $('#name').trigger('focus')
    })
    
    
</script>
<script>

    
    $(document).ready(function(){
    
     $('#country_name').keyup(function(){ 
            var query = $(this).val();
            if(query != '')
            {
             var _token = $('input[name="_token"]').val();
             $.ajax({
              url: '/dev-search',
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
               $('#countryList').fadeIn();  
                        $('#countryList').html(data);
              }
             });
            }
        });
    
        $(document).on('click', 'li', function(){  
            $('#country_name').val($(this).text());  
            $('#countryList').fadeOut();  
        });  
    
    });

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