@extends('layouts.WingheadMaster')


@section('title')
Projects - View | PMFM
@endsection 

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">  
            <div class="card-header card-header-primary">
                <h2 class="card-title">{{$project->title}}</h2>
                <p class="card-category">Click edit button to update project details</p>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                <form>
                         <!--View Description-->
                        <div class="form-group"> 
                            <label for="message-text" class="col-form-label text-primary">Project Description</label>
                            <samp>{!!$project->description!!}</samp>
                        <hr>
                        </div>
                         <!--View Developers-->
                        <div class="form-group">
                            <label for="message-text" class="col-form-label text-primary">Developer(s)</label>
                            <br>
                            <samp>{!!nl2br(e($project->developers))!!}</samp>
                            <hr>
                        </div>
                         <!--View Clients-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Clients(s)</label>
                            <br>
                            <samp>{!!nl2br(e($project->clients))!!}</samp>
                            <hr>
                        </div>
                         <!--View Start Date-->
                        <div id="date-picker-example" class="md-forms md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">Start Date</label>
                            <br>
                            <samp>{!!$project->startdate!!}</samp>
                            <hr>
                        </div>
                         <!--View End Date-->
                        <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker py-3">
                            <label for="recipient-name" class="col-form-label text-primary">End Date</label>
                            <br>
                            <samp>{!!$project->enddate!!}</samp>
                            <hr>
                        </div>
                        <!--View Uploaded Files-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Project File(s)</label>
                            <br>
                            <?php $files = Storage::files($project->files); ?>
                            @foreach ($files as $file)
                            <?php $path = storage_path( $file); ?>
                            <div class="row border border-light " style="margin-top: 5px" >
                                <div class="col-lg-4" >
                                    <samp>{!! basename($file)!!}<br></samp>   
                                </div>
                                <div class="col-lg-2">
                                    <a href="#"class="download-btn"><span class="material-icons">save_alt</span></a>
                                </div>
                            </div>
                            @endforeach
                            
                            <hr>
                        </div>
                         <!--Update and Cancel Buttons-->
                        <a href="/project-register" class="btn btn-danger float-right" style="margin:20px;">Back</a>
                        <a href="{{url('project-register-edit/'.$project->id)}}" class="btn btn-info float-right" style="margin:20px;">Edit</a>     
                </form>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection


 