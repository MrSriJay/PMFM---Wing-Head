@extends('layouts.AdminMaster')


@section('title')
Add Projects | PMFM
@endsection 

@section('styles')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    
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
                            <input type="text" name ="title" class="form-control"  required value="">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                         <!--Insert Project Icon-->
                         <div class="py-4">
                            <label for="recipient-name" class="col-form-label text-primary py-3">Project Icon</label>
                            <br>
                            <input type="file" name="projecticon">
                         </div>
                        <!--Insert Description-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Description</label>
                            <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor" required rows="6" cols="5"></textarea>
                            @error('summary-ckeditor')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                      <!--Insert Proejct Ichage-->
                        <div class="form-group  py-4">
                            <label for="message-text" class="col-form-label text-primary">Project Supervisor</label>
                            <select id="developer_name" class="livesearch form-control" name="supervisor" value="{{ old('supervisor') }}" style="width:99%;"  required></select>
                            <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                              Please Select Wing Name 
                            </div>
                        </div> 

                        <!--Insert Developers-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Developer(s) Involved</label>
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
                                    <textarea type="text" style="display :block; margin: 10px; width:100%; height:100%; border:0px; font-size:14px" rows="4" id="devops" name="developers" value="{{ old('developers') }}"  readonly placeholder="No Assigned Developers">sdada</textarea>
                                </div>
                             
                            </div>
                            
                            <br>
                            <div>
                                
                            </div>
                            @error('developers')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!--Insert Clients-->
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Client</label>
                            <select id="client_name" class="livesearch form-control" name="clientid" value="{{ old('clientid') }}" style="width:99%;"  required></select>
                            <div class="alert alert-danger"   id="required_meesage" style="display:none" role="alert">
                              Please Select Client Name 
                            </div>
                            @error('clientid')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!--Insert wing-->
                        <div class="form-group  py-4">
                            <label for="message-text" class="col-form-label text-primary">Wing</label>
                            <select id="wing_name" class="livesearch form-control" name="wing_name" value="{{ old('wing_name') }}" style="width:99%;"  required>
                                <option value="{!!Auth::user()->wing_name!!}" selected >{!!Helper::getWingName( Auth::user()->wing_name) !!}</option>
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


                        <!--Insert Start Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Project Start Date</label>
                            <input type="date" name="startdate" class="form-control" required placeholder="Select date" id="startdate">
                            @error('startdate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>

                        <!--Insert End Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Proejct Delivered Date</label>
                            <input type="date" name="enddate" class="form-control" required placeholder="Select date" id="date">
                            @error('enddate')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>

                        <!--Upload Files-->
                        <div>
                          <label for="recipient-name" class="col-form-label text-primary py-3">Project File(s)</label>
                          <br>
                          <input type="file" name="file[]" multiple>
                        </div>
                        <!--Save and Cancel Buttons-->
                        <div style="text-align:right">
                            <button type="submit" class="btn btn-info" style="margin:20px">Save</button>  
                            <a href="{{ url('project-register') }}" class="btn btn-danger" style="margin:20px">Cancel</a>
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

    /*var temp;

    function addDev() {
    
    var dev_ipt = document.getElementById("country_name");
    var devops = document.getElementById("devops");
    temp = devops.value;
    devops.value  =devops.value+ " \n" +dev_ipt.value;
    dev_ipt.value="";

    }

    function reDev() {

        var devops = document.getElementById("devops");
        devops.value  = temp;
        temp = devops.value;
    }*/

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
    </script>
@endsection 
