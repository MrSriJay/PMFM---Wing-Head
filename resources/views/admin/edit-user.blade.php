@extends('layouts.TableMaster')

@section('title')
    Edit User Details | NBC
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
                <div class="card-header card-header-primary">
                   <h2 class="card-title">User Profile</h2>
                   <p class="card-category">Select and type on the text-boxes that you want to edit</p>
                </div>
                <div class="card-body">
                    <div class="col-md-6 py-3">
                        <form action="/user-register-update/{{ $users->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                            <div class="form-group">
                                    <label class="text-primary">Name</label>
                                    <input type="text" name="name" value="{{ $users->name}}" class="form-control">
                            </div>
                            <br> 
                            <div class="form-group">
                                    <label  class="text-primary">Contact Number</label>
                                    <input type="text" name="phone" value="{{ $users->phone}}" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                    <label  class="text-primary">Email</label>
                                    <input type="text" name="email" value="{{ $users->email}}" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <label  class="text-primary">Give Role</label>
                                <select name="usertype" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="client">Client</option>
                                    <option value="winghead">Wing Head</option>
                                    <option value="developer">Developer</option>
                                </select>
                            </div>  
                                <a href="/user-register" class="btn btn-danger float-right" style="margin:20px;">Cancel</a>
                                <button type="submit" class="btn btn-info float-right" style="margin:20px;">Update</button>    
                        </form>  
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    
@endsection