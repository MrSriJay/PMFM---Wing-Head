@extends('layouts.AdminMaster')


@section('title')
Add Projects | PMFM
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
                <!--<a href="" class="btn btn-info float-right py-2">ADD</a>-->
                <h4 class="card-title" style="text-align:left">Add a New Project</h4>
                <p class="card-category" style="text-align:left">Select and type on the fields that you want to edit</p>
            </div>
            <div class="card-body">
                <div class="col-md-12 py-3">
                <form action="/admin/projects" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <!--Insert Project Title-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Project Title</label>
                            <input type="text" name ="title" id ="title" class="form-control"  @error('title') is-invalid @enderror  required value="{{ old('title') }}">
                            @error('title')
                            <span style="color:red">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--Insert Project Icon-->
                         <div class="py-4">
                            <label for="recipient-name" class="col-form-label text-primary py-3">Project Icon</label>
                            <br>
                            <div class="well" data-bind="fileDrag: fileData">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <img style="height: 125px;" class="img-rounded  thumb" data-bind="attr: { src: fileData().dataURL }, visible: fileData().dataURL">
                                        <div data-bind="ifnot: fileData().dataURL">
                                            <label class="drag-label"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" name="projecticon" data-bind="fileInput: fileData, customFileInput: {
                                          buttonClass: 'btn btn-success',
                                          fileNameClass: 'disabled form-control',
                                          onClear: onClear,
                                        }" accept="image/*">
                                    </div>
                                </div>
                            </div>
                         </div>

                        


                        <!--Insert Description-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Description</label>
                            <textarea class="form-control" id="summary-ckeditor"  @error('summary-cheditor') is-invalid @enderror  name="summary-ckeditor" required rows="6" cols="5">{{ old('summary-cheditor') }}</textarea>
                            @error('summary-ckeditor')
                            <span style="color:red">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                      <!--Insert Proejct Supervisor-->
                        <div class="form-group  py-4">
                            <label for="message-text" class="col-form-label text-primary">Project Supervisor</label>
                            <select id="developer_name" class="livesearch form-control" name="supervisor" value="{{ old('supervisor') }}" style="width:99%;"  required></select>
                            <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                              Please Select Wing Name 
                            </div>
                        </div> 

                        <!--Insert Developers-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Project Officer(s)</label>
                            <div class="row col-lg-12">
                                <div class="col-lg-4 border border-light">
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
                                    <textarea type="text" required style="display :block; margin: 10px; width:100%; height:100%; border:0px; font-size:14px" rows="4" id="devops" name="developers"  readonly placeholder="No Assigned Developers">{{ old('developers') }}</textarea>
                                </div>
                                @error('developers')
                                <span style="color:red">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                            <div>
                            </div>
                        </div>
                        
                        <!--Insert Clients-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Client</label>
                            <select id="client_name" class="livesearch form-control" name="clientid"  @error('clientid') is-invalid @enderror value="{{ old('clientid') }}" style="width:99%;"  required></select>
                            <div class="alert alert-danger"   id="required_meesage" style="display:none" role="alert">
                              Please Select Client Name 
                            </div>
                            @error('clientid')
                            <span style="color:red">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!--Insert wing-->
                        <div class="form-group  py-4">
                            <label for="message-text" class="col-form-label text-primary">Wing</label>
                            <select id="wing_name" class="livesearch form-control" name="wing_name"  @error('wing_name') is-invalid @enderror value="{{ old('wing_name') }}" style="width:99%;"  required>
                                <option value="{!!Auth::user()->wing_name!!}" selected >{!!Helper::getWingName( Auth::user()->wing_name) !!}</option>
                            </select>
                            <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                            Please Select Wing Name 
                            </div>
                            @error('wing_name')
                            <span style="color:red">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> 


                        <!--Insert Start Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Project Start Date</label>
                            <input type="date" name="startdate" value="{{ old('startdate') }}"  @error('startdate') is-invalid @enderror  class="form-control" required placeholder="Select date" id="startdate">
                            @error('startdate')
                            <span style="color:red">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>

                        <!--Insert End Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Proejct Delivered Date</label>
                            <input type="date" name="enddate" value="{{ old('enddate') }}"  @error('enddate') is-invalid @enderror class="form-control" required placeholder="Select date" id="date">
                            @error('enddate')
                            <span style="color:red">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>

                        <!--Upload Files-->
                        <div>
                          <label for="recipient-name" class="col-form-label text-primary py-3">Project File(s)</label>
                          <!--
                            <br>
                             <input class="custom-file-inputs" type="file" name="file[]" multiple>
                          -->
                          <fieldset>   
                            <input type="hidden" id="path" name="path" value="300000" />
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
                        <div style="text-align:right">
                            <button type="submit" class="btn btn-primary btn-lg" style="margin:20px">Add</button>  
                        </div> 
                </form>
                </div>
            </div>
        </div>
    </div>
</div>    

<script type="text/javascript">

    $('#developer_name').select2({
        placeholder: 'Select Developer Name',
        ajax: {
            url: '/supervisor-search',
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
                            text: item.first_name+" "+item.last_name,
                            id: item.user_id
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
@endsection 


@section('scripts')
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
