@extends('layouts.store')

@section('title')
    Reimbursement
@endsection

@section('content')
    <div class="mb-4 text-white d-flex justify-content-between align-content-center align-items-center">
        <h4 class="m-0 fw-bold">
            Reimbursement Data
        </h4>

        @if (Auth::user()->hasRole('staff'))
            <button data-bs-toggle="modal" data-bs-target="#modalAddReimburs"
                class="btn btn-sm bg-btn-green text-black fw-bold d-flex flex-row align-items-center justify-content-center gap-2">
                <i class="fas fa-plus"></i>
                <span class="d-md-block d-none">Tambah</span>
            </button>
        @endif
    </div>

    @livewire('reimbursement.reimbursement')
@endsection
