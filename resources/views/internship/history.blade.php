@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Halaman Riwayat
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered border-dark text-center">
                            <thead>
                                <tr class="table-dark text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Project</th>
                                    <th scope="col">Tanggal Daftar</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($applyProjectData as $item)
                                <tr class="table-bordered border-dark">
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->created_at->format('d M Y')}}</td>
                                    <td>
                                    @if ($item->work_end_at < now()->toDateString())
                                        <a class="btn btn-disable btn-sm btn-success">Selesai</a>
                                    @elseif ($item->status == "rejected")
                                        <a class="btn btn-disable btn-sm btn-danger">Ditolak</a>
                                    @elseif ($item->status == "accepted")
                                    <a class="btn btn-disable btn-sm btn-warning" href="{{url('internship-progress', ['id' => $item->id])}}">Diterima</a>
                                    @elseif ($item->update_at == "")
                                    <a class="btn btn-disable btn-sm btn-info">Sedang Ditinjau</a>
                                    @endif
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
