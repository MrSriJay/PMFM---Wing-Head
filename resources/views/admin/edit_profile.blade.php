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
<form action="/edit_profile/{!!$user->user_id!!}" method="post">
  {{ csrf_field() }}  
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 

      <label for="recipient-name" class="col-form-label text-light">Militaray/National ID No</label>
          <h3 class="card-title">
             <strong id="u_id">{!!$user->user_id!!}</strong>
          </h3> 
      </div>
      <div class="card-body"  >
        
       @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
          {{ session('status') }}
          </div>
       @endif
    
        <div class="row">
          <!--View rank-->
          <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label text-primary">Rank</label>
              <input type="text" name ="rank" id ="rank"  class="form-control @error('rank') is-invalid @enderror"  value="{{ old('rank',$user->rank) }} "  placeholder="e.g. Major" required value="">
              @error('rank')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
          <!--View First Name-->
          <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label text-primary">First Name</label>
              <input type="text" name ="first_name" id ="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name',$user->first_name) }}"  placeholder="e.g. Mahela"  required value="">
              @error('first_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--View Last Name-->
          <div class="col-lg-4"> 
              <label for="recipient-name" class="col-form-label text-primary">Last Name</label>
              <input type="text" name ="last_name" id ="last_name"  class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name',$user->last_name) }}"  placeholder="e.g. Perera"  required value="">
              @error('last_name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

           <!--View Telephone-->
           <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label text-primary">Telephone</label>
              <input type="text" name ="telephone" id ="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone',$user->telephone) }}"  placeholder="e.g. 0112111111"  pattern="[0-9]{1}[0-9]{9}" required value="">
              @error('telephone')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--View Email-->
          <div class="col-lg-4">
              <label for="recipient-name" class="col-form-label text-primary">Email</label>
              <input type="email" name ="email" id ="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }} "  placeholder="e.g. mymail@gmail.com" required>
              @error('email')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

          <!--Save and Cancel Buttons-->
          <div style="text-align:right" class="col-lg-12" id="buttons"> 
             <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target="#updatemodal">
                <span class="material-icons">update</span> Update
             </button>
          </div> 
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
        <h5 class="modal-title">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to update the user details </p>
      </div> 
     
      <div class="modal-footer">
            <button type="submit" class="btn btn-success">Yes, Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
      </div>
    </div>
  </div>
</div>
</form>

<form action="/edit_change_password/{!!$user->user_id!!}" method="post">

<div class="card">
  <div class="card-header card-header-primary"> 
    <label for="recipient-name" class="col-form-label text-light text-lg"><span class="material-icons">password</span> Change Password</label>
  </div>
  <div class="card-body">

    <!--Current Password-->
    <div class="col-lg-6">
      <label for="message-text" class="col-form-label text-primary">Current Password</label>
      <input id="current_password" type="password" placeholder="*********" class="form-control @error('current_password') is-invalid @enderror" name="current_password"   autocomplete="new-password">
      @error('current_password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      @if (session('errorStatus'))
          <span class="text-danger">{{ session('errorStatus') }}</span>
      @endif
    </div>

    <!--Password-->
    <div class="col-lg-6">
      <label for="message-text" class="col-form-label text-primary">Password</label>
      <input id="password" type="password" placeholder="*********" class="form-control @error('password') is-invalid @enderror" name="password"   autocomplete="new-password">
      @error('password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <!--Confirm Password-->
    <div class="col-lg-6">
      <label for="message-text" class="col-form-label text-primary">Confirm Password</label>
      <input id="password-confirm" type="password"  placeholder="*********" class="form-control" name="password_confirmation"  autocomplete="new-password">             
    </div>

    <!--Save and Cancel Buttons-->
    <div style="text-align:right" class="col-lg-12" id="buttons"> 
      <button type="button" class="btn btn-success" id="update" data-toggle="modal" data-target="#deleteModal">
         Change Password
      </button>
    </div> 
  </div>
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
        <p>Are you sure you want to update the password? </p>
      </div> 
        {{ csrf_field() }}
        <input type="hidden" value="{!!$user->user_id!!}" name="user_id">
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Yes, Change Password</button>
       </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No, Cancel</button>
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
    
</script>


@endsection
@section('scripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>

$('#deleteModal').on('shown.bs.modal', function () {
  $('#name').trigger('focus')
})

$('#updatemodal').on('shown.bs.modal', function () {
  $('#name').trigger('focus')
})


</script>


@endsection
