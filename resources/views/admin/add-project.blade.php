@extends('layouts.TableMaster')


@section('title')
Add Projects | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Add a Project</h4>
                <p class="card-category">Select and type on the text-boxes that you want to fill</p>
            </div>
            <div class="card-body">
                <div class="col-md-6 py-3">

                <form action="" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Project Title</label>
                            <input type="text" name ="projecttitle" class="form-control @error('projecttitle') is-invalid @enderror" required id="projecttitle" value="">
                            @error('projecttitle')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required id="description" rows="6" cols="5"></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Clients</label>
                            <textarea type="text" name ="clients" class="form-control @error('clients') is-invalid @enderror" required id="clients"></textarea>
                            @error('clients')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Developer</label>
                            <input type="text" name ="developer" class="form-control @error('developer') is-invalid @enderror" required id="developer" value="">
                            @error('developer')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Contact Number</label>
                            <input type="text" name ="contactno" class="form-control @error('contactno') is-invalid @enderror" required autofocus id="contactno" value="">
                            @error('contactno')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group py-4">
                            <label for="recipient-name" class="col-form-label text-primary">Email</label>
                            <input type="text" name ="email" class="form-control @error('email') is-invalid @enderror" required id="email" value="">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <a href="/project-register" class="btn btn-danger float-right" style="margin:20px;">Cancel</a>
                        <button type="submit" class="btn btn-info float-right" style="margin:20px;">Update</button>     
                </form>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection 