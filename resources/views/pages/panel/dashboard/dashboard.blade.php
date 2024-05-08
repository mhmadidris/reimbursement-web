@extends('layouts.store')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Content Pesanan Row -->
        <div class="row">
            <h4 class="m-0 fw-bold text-white mb-2">Pesanan</h4>
            <!-- Pesanan baru Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Pesanan Baru</div>
                                <div class="mb-0 h4 fw-bold my-1">103</div>
                                <div class="mt-1 fw-bold" style="font-size: 0.75rem;">Pemasukan <span
                                        style="color: #00FF91;">+Rp.1,500.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Siap dikirim Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Perlu Diproses</div>
                                <div class="mb-0 h4 fw-bold my-1">4</div>
                                <div class="mt-1 fw-bold" style="font-size: 0.75rem;">Pemasukan <span
                                        style="color: #00FF91;">+Rp.1,500.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bank sampah Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Sedang Dikirim</div>
                                <div class="mb-0 h4 fw-bold my-1">6</div>
                                <div class="mt-1 fw-bold" style="font-size: 0.75rem;">Pemasukan <span
                                        style="color: #00FF91;">+Rp.1,500.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ulasan Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-header-footer text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="fw-semibold m-0">
                                    Bermasalah</div>
                                <div class="mb-0 h4 fw-bold my-1">1</div>
                                <div class="mt-1 fw-bold" style="font-size: 0.75rem;">Pemasukan <span
                                        style="color: #00FF91;">+Rp.1,500.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
