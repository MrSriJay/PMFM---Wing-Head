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
          <h2 class="card-title">Add Clients</h2> 
      </div>
      <div class="card-body">
      <form method="POST" action="/admin/clients">
      {{ csrf_field() }}

          <!--Insert Organization Name-->
          <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Organization Name</label>
              <input type="text" name ="organization_name" class="form-control @error('organization_name') is-invalid @enderror"  value="{{ old('organization_name') }}"  placeholder="e.g. Sri Lanka Army"  required value="">
              @error('organization_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--Insert Department Name-->
          <div class="form-group py-4">
            <label for="recipient-name" class="col-form-label text-primary">Department</label>
            <input type="text" name ="dep_name" class="form-control @error('dep_name') is-invalid @enderror"  value="{{ old('dep_name') }}"  placeholder="e.g. IT Department"  required value="">
            @error('dep_name')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

          <!--Insert Address-->
          <div class="form-group py-4">
            <label for="recipient-name" class="col-form-label text-primary">Address</label>
            <input type="text" name ="address" class="form-control @error('address') is-invalid @enderror"  value="{{ old('address') }}"  placeholder="e.g. Army Headquarters Sri Jayawardenepura Colombo"  required value="">
            @error('address')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

           <!--Insert Telephone-->
           <div class="form-group py-4">
              <label for="recipient-name" class="col-form-label text-primary">Telephone</label>
              <textarea type="text" name="telephone" rows="4" cols="10" class="form-control @error('telephone') is-invalid @enderror"  value="{{ old('telephone') }}"  placeholder="e.g. 011 000 000 ( Please provide at least two numbers )"  pattern="[0-9]{1}[0-9]{9}" required value=""></textarea>
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
