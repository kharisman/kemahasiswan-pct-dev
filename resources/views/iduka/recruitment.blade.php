@extends('iduka.layouts.app')

@section('title', 'Create Project')

@section('contents')
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Summernote with Bootstrap 4</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  </head><body>
    <div class="container-fluid">
        <!-- Page Content -->
        <div class="card">
            <div class="card-body text-left">
                <h4 class="col-md-9">Form Project</h4>
                <form action="{{ route('save_project') }}" method="POST" class="project">
                    @csrf
                    <div class="form-group">
                        <label for="iduka_id">Iduka ID</label>
                        <input type="text" name="iduka_id" class="form-control" id="iduka_id" value="{{ Auth::user()->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Title Project</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" cols="30" rows="10"></textarea>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
                    
                </form>
            </div>
        </div>
    </div>

    <script>
            $('#notes').summernote({
                placeholder: 'Notes',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('iduka/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('iduka/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('iduka/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('iduka/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('iduka/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('iduka/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('iduka/js/demo/chart-pie-demo.js')}}"></script>

@endsection
