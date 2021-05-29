@extends('layouts.ClientMaster')

@section('title')
    Complaints | CRD
@endsection

@section('styles')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link href="https://raw.githubusercontent.com/bantikyan/icheck-bootstrap/master/icheck-bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/css/fle-styles.css" rel="stylesheet" />
@endsection


@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary"> 
          <h2 class="card-title">Add Compalint</h2> 
      </div>
      <div class="card-body">
      <form action="/client/clients-complaints" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
                      <div class="form-group  py-4s">
                          <label for="message-text" class="col-form-label text-primary">System Name</label>
                          <select id="title" name="title" class="livesearch form-control"   style="width:99%;"  required></select>
                          <div class="alert alert-danger" id="required_meesage" style="display:none" role="alert">
                            Please Select System Name 
                          </div>
                      </div>   
                    
                      <!--Done Buttons-->
                      <div style="text-align:right">
                          <a class="btn btn-primary" id="doneBtn" onclick="viewNext()" style="color:white">Next</a>
                      </div> 

                    <div style="display:none" id="add_content">
                        <!--Insert Description-->
                        <div class="form-group py-4">
                            <label for="message-text" class="col-form-label text-primary">Complaint Description</label>
                            <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor" required rows="6" cols="5"></textarea>
                            @error('summary-ckeditor')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <!--Insert Complaint Type-->
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label text-primary py-2">Type of Fault</label><br>
                          <label class="py-2">Select at least one option:</label><br>
                          <input type="checkbox" id="hw_fault" class="icheck-danger" name="fault_type" value="Hardware Fault">
                          <label for="hw_fault"> Hardware Fault</label><br>
                          <input type="checkbox" id="sw_fault" class="icheck-danger" name="fault_type"  value="Software Fault">
                          <label for="sw_fault"> Software Fault</label><br>
                          <input type="checkbox" id="other" class="icheck-danger" name="fault_type" value="Other">
                          <label for="other"> Other</label>
                          @error('fault_type')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <!--Insert Urgency Level -->
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label text-primary py-2">Urgency Level</label><br>
                          <label class="py-2">Select the urgency level:</label><br>
                          <input type="radio" id="low" name="urgency" value="low">
                          <label for="male">Low</label><br>
                          <input type="radio" id="medium" name="urgency" value="medium">
                          <label for="female">Medium</label><br>
                          <input type="radio" id="high" name="urgency" value="high">
                          <label for="other">High</label><br>
                          <input type="radio" id="critical" name="urgency" value="critical">
                          <label for="other">Critical</label>
                          @error('urgency')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <!--Upload Complaint Files-->
                        <div>
                          <label for="recipient-name" class="col-form-label text-primary py-3">Complaint File(s)</label>
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
             
                          <button type="submit" class="btn btn-lg btn-primary">
                               Save
                          </button>
                           
                        </div> 
                        
                      </div>
                 
                    </div> 

                  </form> 
              </div>
            </div>
          </div>
<script type="text/javascript">
    $('#title').select2({
        placeholder: 'Select System Name',
        ajax: {
            url: '/projects-search-client',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>

<script>
var dropzone = new Dropzone('#demo-upload', {
  previewTemplate: document.querySelector('#preview-template').innerHTML,
  parallelUploads: 2,
  thumbnailHeight: 120,
  thumbnailWidth: 120,
  maxFilesize: 3,
  filesizeBase: 1000,
  thumbnail: function(file, dataUrl) {
    if (file.previewElement) {
      file.previewElement.classList.remove("dz-file-preview");
      var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
      for (var i = 0; i < images.length; i++) {
        var thumbnailElement = images[i];
        thumbnailElement.alt = file.name;
        thumbnailElement.src = dataUrl;
      }
      setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
    }
  }

});


// Now fake the file upload, since GitHub does not handle file uploads
// and returns a 404

var minSteps = 6,
    maxSteps = 60,
    timeBetweenSteps = 100,
    bytesPerStep = 100000;

dropzone.uploadFiles = function(files) {
  var self = this;

  for (var i = 0; i < files.length; i++) {

    var file = files[i];
    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

    for (var step = 0; step < totalSteps; step++) {
      var duration = timeBetweenSteps * (step + 1);
      setTimeout(function(file, totalSteps, step) {
        return function() {
          file.upload = {
            progress: 100 * (step + 1) / totalSteps,
            total: file.size,
            bytesSent: (step + 1) * file.size / totalSteps
          };

          self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
          if (file.upload.progress == 100) {
            file.status = Dropzone.SUCCESS;
            self.emit("success", file, 'success', null);
            self.emit("complete", file);
            self.processQueue();
            //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
          }
        };
      }(file, totalSteps, step), duration);
    }
  }
}
</script>
@endsection


@section('scripts')


<script>

function viewNext() {

var x = document.getElementById("add_content");
var button = document.getElementById("doneBtn");
var y = document.getElementById("title").value;
var required_meesage = document.getElementById("required_meesage");


if (y=="") {
  x.style.display = "none";
  required_meesage.style.display = "block";
} 
else{
  x.style.display = "block";
  button.style.display = "none";
  required_meesage.style.display = "none";
}
}

</script>
<script src="/assets/js/filedrag.js"></script>
@endsection
