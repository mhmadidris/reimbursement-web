@extends('layouts.store')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h4 class="m-0 fw-bold text-white mb-2">Pengajuan</h4>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Total Pengajuan</div>
                                <div class="mb-0 h4 fw-bold my-1">{{ $countPengajuan }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Pengajuan Pending</div>
                                <div class="mb-0 h4 fw-bold my-1">{{ $countPendingPengajuan }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Pengajuan Diterima</div>
                                <div class="mb-0 h4 fw-bold my-1">{{ $countTerimaPengajuan }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Pengajuan Ditolak</div>
                                <div class="mb-0 h4 fw-bold my-1">{{ $countTolakPengajuan }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
