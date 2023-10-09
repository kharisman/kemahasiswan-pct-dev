@extends('internship/main')
@section('contentInternship')
<link href="{{ asset('internship/css/custom.min.css') }}" rel="stylesheet">
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
                    <ul class="list-unstyled timeline">
                            @foreach ($taskData as $item)
                          <li>
                            <div class="block">
                              <div class="tags">
                                  @if ($item->status_task == "Sedang Dikerjakan")
                                  <a class="tag">
                                  <span>Proses</span>
                                </a>
                                @elseif($item->status_task=="Belum Dimulai")
                               <a class="tag">
                                  <span>Persiapan</span>
                                </a>

                                 @elseif($item->status_task=="Selesai")
                                <a class="tag">
                                    <span>Selesai</span>
                                  </a>

                                @endif
                              </div>
                              <div class="block_content">
                                <h2 class="title">
                                    <a>{!! $item->name !!}</a>
                                </h2>
                                <div class="byline">
                                  <span>{{$item->created_at->diffForHumans()}}</span>
                                </div>
                                @if ( $item->status_task != "Batal")
                                <p class="excerpt">{!! $item->description !!}
                                    <h6 class="mt-4">History Perubahan</h6>
                                    <table class="table td" id="">
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
                                </p>
                                @endif
                              </div>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function() {
        $('.td').DataTable({
        });
    });
</script>
@endsection
