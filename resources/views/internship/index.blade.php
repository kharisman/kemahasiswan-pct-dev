@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-facebook d-flex align-items-center">
                    <div class="card-body py-5">
                        <div
                            class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="mdi mdi-checkbox-multiple-marked text-white icon-lg"></i>
                            <div class="ms-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">Complleted Project</h5>
                                <p class="mt-2 text-white card-text">{{$completedProject}} Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-twitter d-flex align-items-center">
                    <div class="card-body py-5">
                        <div
                            class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="mdi mdi-calendar-remove text-white icon-lg"></i>
                            <div class="ms-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">Reject Project</h5>
                                <p class="mt-2 text-white card-text">{{$rejectProject}} Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-facebook d-flex align-items-center">
                    <div class="card-body py-5">
                        <div
                            class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="mdi mdi-clipboard-text text-white icon-lg"></i>
                            <div class="ms-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">On Going Project</h5>
                                <p class="mt-2 text-white card-text">{{$onGoingProject}} Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Project On Going</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Project</th>
                                        <th>Progress</th>
                                        <th>Amount</th>
                                        <th>Deadline</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($onGoingProjectData as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
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
    </div>
@endsection
