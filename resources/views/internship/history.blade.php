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
                        <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Project</th>
                                    <th scope="col">Tanggal Daftar</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody class="border-dark">
                            @foreach ($applyProjectData as $item)
                                <tr>
                                    <th class="text-center" scope="row" style="width:10px">{{$loop->iteration}}</th>
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">{{$item->created_at->format('d F Y')}}</td>
                                    <td class="text-center">
                                    @if ($item->status_work == "selesai")
                                        <a class="btn btn-disable btn-sm btn-success col-12">Selesai</a>
                                    @elseif ($item->status == "rejected")
                                        <a class="btn btn-disable btn-sm btn-danger col-12">Ditolak</a>
                                    @elseif ($item->status == "accepted")
                                    <a class="btn btn-disable btn-sm btn-warning col-12" href="{{url('internship-progress', ['id' => $item->project_id])}}"><i class="mdi mdi-progress-check"></i> Diterima</a>
                                    @elseif ($item->update_at == "")
                                    <a class="btn btn-disable btn-sm btn-info col-12">Sedang Ditinjau</a>
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
