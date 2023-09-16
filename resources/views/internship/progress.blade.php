@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row mb-3">
            <div class="card border-left-primary shadow h-100 py-2 mb-3">
                <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">
                    <h3>Progress Project</h3>
                    
                </div>
                <div class="card-body">
                    <div class="bd-example mb-3">
                        <dl>
                          <dt>Nama Project</dt>
                          <dd>{{$projectData->name}}</dd>
                          <dt>Periode</dt>
                          <dd>{{$projectData->work_start_at}} sampai dengan {{$projectData->work_end_at}}</dd>
                          <dt>Catatan Project</dt>
                          @foreach ($progressData as $item)
                            <dd>{{$item->notes}}</dd>
                          @endforeach
                        </dl>
                      </div>
                </div>
            </div>
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">
                    <h3>Task Data Project</h3>
                    
                </div>
                <div class="card-body">
                        @foreach ($taskData as $item)
                        <div class="bd-example mb-3">
                            <details open="">
                              <summary>{!! $item->name !!}</summary>
                              <div class="text-end">{!! $item->status_task !!}</div>
                              <hr class="border border-primary border-2 opacity-50">
                              <p>{!! $item->description !!}</p>

                              <h6 class="mt-4">History Perubahan</h6>
                              <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->taskHistories as $task)
                                    <tr>
                                        <td>{{ $task->created_at }}</td>
                                        <td>{{ $task->description }}</td>              
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </details>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
