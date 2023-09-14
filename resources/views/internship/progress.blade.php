@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">
                    <h3>Progress Data Project</h3>
                    
                </div>
                <div class="card-body">
                    <ol class="list-group list-group-numbered">
                        @foreach ($progressData as $item)
                        <li class="list-group-item">
                            <p>{!! $item->notes !!}</p><br>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
