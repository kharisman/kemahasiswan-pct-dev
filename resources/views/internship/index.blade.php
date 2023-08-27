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
                                <p class="mt-2 text-white card-text">10 Project</p>
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
                                <p class="mt-2 text-white card-text">2 Project</p>
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
                                <p class="mt-2 text-white card-text">3 Project</p>
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
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Name Project
                                        </th>
                                        <th>
                                            Progress
                                        </th>
                                        <th>
                                            Amount
                                        </th>
                                        <th>
                                            Deadline
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1">
                                            1
                                        </td>
                                        <td>
                                            Project Name
                                        </td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            $ 77.99
                                        </td>
                                        <td>
                                            May 15, 2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            2
                                        </td>
                                        <td>
                                            Project Name
                                        </td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            $245.30
                                        </td>
                                        <td>
                                            July 1, 2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            3
                                        </td>
                                        <td>
                                            Project Name
                                        </td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 90%"
                                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            $138.00
                                        </td>
                                        <td>
                                            Apr 12, 2024
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
