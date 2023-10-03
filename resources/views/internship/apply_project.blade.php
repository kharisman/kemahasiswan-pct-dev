@extends('internship/main')
@section('contentInternship')
<div class="content-wrapper">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Data Lamaran -->
        <div class="card">
            <div class="card-header">
                Data Lamaran
            </div>
            <div class="card-body">
                <!-- File -->
                <input type="hidden" name="projectId" value="{{$projectId->id}}">
                    <!-- Surat Lamaran -->
                    <div class="row mb-3 text-end">
                        <label for="application_letter" class="col-sm-4 col-form-label text-start">Portfolio</label>
                        <div class="col-sm-8">
                            <input id="application_letter" class="form-control border-secondary" type="file" name="application_letter">
                            @error('application_letter')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Ringkasan tentang internship -->
                    <div class="row mb-3 text-start">
                        <div class="form-group">
                          <label for="notes">Catatan</label>
                          <textarea class="form-control border-secondary" name="notes" id="notes" rows="4" oninput="countCharacters()"></textarea>
                          @error('notes')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <footer class="blockquote-footer"><cite title="catatan">Anda dapat menjelaskan tentang latar belakang, ide, dan pencapaian anda dalam bidang ini, sebagai pertimbangan Iduka.</cite></footer>
                    </div>
            </div>
        </div>

        <!-- Tombol "Update" -->
        <div class="card mb-3">
            <div class="card-header">
                <button type="submit" class="btn btn-warning btn-sm text-center w-100">Kirim</button>
            </div>
        </div>
    </form>

</div>
{{-- <script>
    function countCharacters() {
        var textarea = document.getElementById('notes');
        var charCount = document.getElementById('charCount');
        var maxLength = 500; 

        var currentLength = textarea.value.length;
        charCount.textContent = currentLength + '/' + maxLength;

        if (currentLength > maxLength) {
            textarea.style.color = 'red'; 
        } else {
            textarea.style.color = ''; 
        }
    }
</script> --}}
<script>
  $('#notes').summernote({
        placeholder: 'Ringkasan tentang kesesuaian bidang anda dan project yang anda ikuti.'
        , tabsize: 2
        , height: 200
        , toolbar: [
            ['style', ['style']]
            , ['font', ['bold', 'underline', 'clear']]
            , ['color', ['color']]
            , ['para', ['ul', 'ol', 'paragraph']]
            , ['table', ['table']]
            , ['insert', ['link', 'picture', 'video']]
            , ['view', ['fullscreen', 'codeview', 'help']]
        ]
  });

      // DropzoneJS Demo Code Start
  
      Dropzone.autoDiscover = false

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template")
previewNode.id = ""
var previewTemplate = previewNode.parentNode.innerHTML
previewNode.parentNode.removeChild(previewNode)

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  url: "/target-url", // Set the url
  thumbnailWidth: 80,
  thumbnailHeight: 80,
  parallelUploads: 20,
  previewTemplate: previewTemplate,
  autoQueue: false, // Make sure the files aren't queued until manually added
  previewsContainer: "#previews", // Define the container to display the previews
  clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
})

myDropzone.on("addedfile", function(file) {
  // Hookup the start button
  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
})

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
})

myDropzone.on("sending", function(file) {
  // Show the total progress bar when upload starts
  document.querySelector("#total-progress").style.opacity = "1"
  // And disable the start button
  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
})

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
  document.querySelector("#total-progress").style.opacity = "0"
})

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
}
document.querySelector("#actions .cancel").onclick = function() {
  myDropzone.removeAllFiles(true)
}
// DropzoneJS Demo Code End


</script>
@endsection
