@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Halaman History
                </div>
                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name Project</th>
                                <th scope="col">Date Apply</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($applyProjectData as $item)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                  @if ($item->update_at <> "")
                                    <a href="" class="btn btn-disable btn-sm btn-success">Complleted</a>
                                  @elseif ($item->status == "REJECT")
                                    <a href="" class="btn btn-disable btn-sm btn-danger">Reject</a>
                                  @elseif ($item->status == "ACCEPT")
                                  <a href="" class="btn btn-disable btn-sm btn-warning">On Going</a>
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
@endsection
