@extends('layouts.TableMaster')

@section('title')
    Registered Users | NBC
@endsection

@section('content')
    
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <!--<a href="" class="btn btn-info float-right py-2">ADD</a>-->
          <h4 class="card-title">Registered Users</h4>
          <p class="card-category">Details of users who are already registered in the system</p>
        </div>
       
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success py-2" role="alert">
            {{ session('status') }}
          </div>
        @endif
          <div class="table-responsive">
            <table class="table">
              <thead class="text-primary">
                <th>UserID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Usertype</th>
                <th>EDIT</th>
                <th>DELETE</th>
              </thead>
              <tbody>
                @foreach ($users as $row)
                <tr>
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->phone }}</td>
                  <td>{{ $row->email }}</td>
                  <td>-{{ $row->usertype }}</td>
                  <td>
                    <a href="/user-edit/{{ $row->id }}" class="btn btn-info">EDIT</a>  
                  </td> 
                  <td>
                    <form action="/user-delete/{{ $row->id }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field("DELETE") }}
                      <button type = "submit" class="btn btn-danger">DELETE</button>  
                    </form>
                  </td> 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
    
@endsection
