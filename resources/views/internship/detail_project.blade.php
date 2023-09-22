@extends('internship/main')
@section('contentInternship')
    <div class="content-wrapper">
        <div class="row">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Detail Program Project</h1>
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="description-tab-pane" aria-selected="true">Deskripsi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="periode-tab" data-bs-toggle="tab" data-bs-target="#periode-tab-pane" type="button" role="tab" aria-controls="periode-tab-pane" aria-selected="false">Periode</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="tentangiduka-tab" data-bs-toggle="tab" data-bs-target="#tentangiduka-tab-pane" type="button" role="tab" aria-controls="tentangiduka-tab-pane" aria-selected="false">Tentang Iduka</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                              <div class="card border-left-primary shadow h-100 py-2">
                                  <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">
                                      <h3>{{$projectData->name}}</h3>
                                      
                                  </div>
                                  <div class="card-body">
                                      <h3>Deskripsi Project</h3>
                                      <p>{!! $projectData->notes !!}</p>
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="periode-tab-pane" role="tabpanel" aria-labelledby="periode-tab" tabindex="0">
                              <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                                  <div class="card border-left-primary shadow h-100 py-2">
                                      <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">
                                          <h3>{{$projectData->name}}</h3>
                                      </div>
                                      <div class="card-body">
                                          <h3>Kategori Project</h3>
                                          <p>{!! $projectData->category !!}</p>
                                          <br>
                                          <h3><i class="mdi mdi-calendar-check"></i> Periode Pendaftaran</h3>
                                          <p>{{ \Illuminate\Support\Carbon::parse($projectData->registration_start_at)->format('d F Y') }} Sampai Dengan {{ \Illuminate\Support\Carbon::parse($projectData->registration_end_at)->format('d FY') }}</p>
                                          <br>
                                          <h3><i class="mdi mdi-calendar-check"></i> Periode Pengerjaan</h3>
                                          <p>{{ \Illuminate\Support\Carbon::parse($projectData->work_start_at)->format('d F Y') }} Sampai Dengan {{ \Illuminate\Support\Carbon::parse($projectData->work_end_at)->format('d FY') }}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="tab-pane fade" id="tentangiduka-tab-pane" role="tabpanel" aria-labelledby="tentangiduka-tab" tabindex="0">
                              <div class="card border-left-primary shadow h-100 py-2">
                                  <div class="card-header text-xs font-weight-bold text-primary text-uppercase mb-1">
                                      <h3>{{$projectData->name}}</h3>
                                  </div>
                                  <div class="card-body">
                                      <h3>
                                          {{$projectData->idukaName}}
                                      </h3>
                                      <br>
                                      <h3>Alamat Iduka</h3>
                                      <p>
                                          <address>
                                              {{$projectData->address}}
                                          </address>
                                      </p>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
                  <br>
            </div>
            <a href="{{url('internship-project-apply',['id' => $projectData->id])}}" class="btn btn-primary col-12 mt-3">Apply</a>
        </div>
    </div>
@endsection
