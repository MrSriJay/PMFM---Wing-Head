@extends('layouts.main_layout')

@section('content')
<div id="content" class="container div-vertical-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-muted">
                    <h3>
                        <span class="material-icons">help</span> Help
                    </h3>
                </div>

                   <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    <form method="POST" action="/help">
                        {{ csrf_field() }}
                        <!-- Name-->
                        <div >
                            <label for="recipient-name" class="col-form-label text-primary">Name</label>
                            <input type="text" name ="name" id ="name"  class="form-control @error('name') is-invalid @enderror" required value="">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                          <!-- Message-->
                          <div>
                            <label for="recipient-name" class="col-form-label text-primary">Message</label>
                            <textarea name="message" id="message" class="form-control  @error('message') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3"></textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Email-->
                        <div >
                            <label for="recipient-name" class="col-form-label text-primary">Email</label>
                            <input type="email" name ="email" id ="email"  class="form-control @error('email') is-invalid @enderror"  required value="">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                         <!--telephone-->
                         <div>
                            <label for="recipient-name" class="col-form-label text-primary">Telephone</label>
                            <input type="text" pattern="[0-9]{1}[0-9]{9}" name ="telephone" id ="telephone"  class="form-control @error('telephone') is-invalid @enderror" required value="">
                            @error('telephone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    
                        <div class="form-group row mb-0 float-right">
                            <div >
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                        <a href="/"><span class="material-icons">keyboard_backspace</span></a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
