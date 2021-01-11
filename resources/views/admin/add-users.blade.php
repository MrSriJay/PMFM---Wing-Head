@extends('layouts.AdminMaster')

@section('title')
    Complaints | CRD
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
          <h2 class="card-title">Add Users</h2> 
      </div>
      <div class="card-body">
      <form method="POST" action="/admin/users">
      {{ csrf_field() }}
          <!--Insert id-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Militaray/National ID No</label>
              <input type="text" name ="userid" class="form-control @error('userid') is-invalid @enderror " value="{{ old('userid') }}"  placeholder="e.g. 987781554V" required value="">
            
              @error('userid')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror

              @if (session('error'))
              <span class="invalid-feedback" style="display:block">
                <strong>
                {{ session('error') }}
                </strong>
               </span>
             @endif

          </div>
       
          <!--Insert rank-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Rank</label>
              <input type="text" name ="rank" id ="rank"class="form-control @error('rank') is-invalid @enderror" value="{{ old('rank') }}"  placeholder="e.g. Major"  value="">
              <div class="">
              <br>
                <label class="form-check-label" for="defaultCheck1">
                   Civil
                </label>
                <input class="" id="rankCheck" name="rankCheck" onclick="setRank()" type="checkbox" value="none" id="defaultCheck1">
                
               </div>
              @error('rank')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <!--Insert First Name-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">First Name</label>
              <input type="text" name ="first_name" class="form-control @error('first_name') is-invalid @enderror"  value="{{ old('first_name') }}"  placeholder="e.g. Mahela"  required value="">
              @error('first_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--Insert Last Name-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Last Name</label>
              <input type="text" name ="last_name" class="form-control @error('last_name') is-invalid @enderror"  value="{{ old('last_name') }}"  placeholder="e.g. Perera"  required value="">
              @error('last_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

           <!--Insert Telephone-->
           <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Telephone</label>
              <input type="text" name ="telephone" class="form-control @error('telephone') is-invalid @enderror"  value="{{ old('telephone') }}"  placeholder="e.g. 0112111111"  pattern="[0-9]{1}[0-9]{9}" required value="">
              @error('telephone')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--Insert Email-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Email</label>
              <input type="email" name ="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  placeholder="e.g. mymail@gmail.com" required value="">
              @error('email')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

           <!--Insert designation-->
           <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Designation</label>
              <select id="usertype" class="form-control" name="usertype" value="{{ old('usertype') }}"  aria-label="Default select example" >
                <option value="" disabled selected>Select your option</option>
                <option value="winghead" >Wing Head</option>
                <option value="topmanagement" >Top Management</option>
                <option value="developer" >Developer</option>
                <option value="officer" >Officer</option>
                <option value="civil" >Civil Consultant</option>
                <option value="client" >Client</option>
              </select>
              
          </div>

          <!--Insert wing-->
          <div class="form-group  py-4">
              <label for="message-text" class="col-form-label text-primary">Wing Name</label>
              <select id="wing_name" class="livesearch form-control" name="wing_name" value="{{ old('wing_name') }}" style="width:99%;"  required></select>
              <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                Please Select Wing Name 
              </div>
          </div> 


          <!--Insert Password-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Password</label>
              <div class="row">
                 <div class="col-md-10">
                    <input id="password" type="password" placeholder="*********" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
                <div class="col-md-1 mx-auto">    
                    <a class="btn btn-sm btn-secondary" onclick="generatePassword()">Generate Password </a> 
                </div> 
              </div>
             
              @error('password')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--Insert C Password-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Confirm Password</label>
              <input id="password-confirm" type="password"  placeholder="*********" class="form-control" name="password_confirmation" required autocomplete="new-password">             
             
          </div>
          <!--Save and Cancel Buttons-->
          <div style="text-align:right">
             
             <button type="submit" class="btn btn-lg btn-primary">
                  Register
             </button>
              
          </div> 
          
      </form>

      </div> 
    </div>
  </div>
</div>

<script type="text/javascript">
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

    function generatePassword() {
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    document.getElementById("password").value = retVal;
    document.getElementById("password-confirm").value = retVal;
    return retVal;
    }

    function setRank() {
    
        var checkBox = document.getElementById("rankCheck");
        
        if (checkBox.checked == true){
            document.getElementById("rank").value = "Civil Personnel";
            document.getElementById("rank").readOnly = true;
        } else {
            document.getElementById("rank").value = "";
            document.getElementById("rank").readOnly = false;
        }
    }

</script>
@endsection
