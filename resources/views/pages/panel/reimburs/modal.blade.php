<style>
    .form-control::placeholder {
        color: white;
    }
</style>

<!-- Modal Create Data -->
<div class="modal fade" data-bs-backdrop="static" id="modalAddReimburs" tabindex="-1"
    aria-labelledby="modalAddReimbursLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-tabel text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalAddReimbursLabel">Pengajuan Reimbursement</h5>
                <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark fa-lg text-white"></i>
                </button>
            </div>
            <div class="modal-body d-flex flex-column gap-3">
                <div class="d-flex flex-column w-100">
                    <label class="pb-1 h6 fw-bold" for="dateReimburs">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control bg-header-footer text-white border-0" id="dateReimburs"
                        wire:model="dateReimburs" autocomplete="off" required>
                </div>

                <div class="d-flex flex-column w-100">
                    <label class="pb-1 h6 fw-bold" for="nameReimburs">Nama Reimbursement <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control bg-header-footer text-white border-0" id="nameReimburs"
                        wire:model="nameReimburs" placeholder="Nama Reimbursement" autocomplete="off" required>
                </div>

                <div class="d-flex flex-column w-100">
                    <label class="pb-1 h6 fw-bold" for="descReimburs">Deskripsi <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control bg-header-footer text-white border-0" id="descReimburs" wire:model="descReimburs"
                        style="resize: none;" rows="4" required></textarea>
                </div>

                <div class="d-flex flex-column w-100">
                    <label class="pb-1 h6 fw-bold" for="mediaReimburs">Media <span class="text-danger">*</span></label>
                    <input type="file" class="form-control bg-header-footer text-white border-0" id="mediaReimburs"
                        accept="image/*, .pdf" wire:model="mediaReimburs" />
                    <div class="mt-2">
                        @if ($mediaReimburs)
                            @if (str_contains($mediaReimburs->getMimeType(), 'image'))
                                <i class="fas fa-file-image"></i> {{ $mediaReimburs->getClientOriginalName() }}
                            @elseif(str_contains($mediaReimburs->getMimeType(), 'pdf'))
                                <i class="fas fa-file-pdf"></i> {{ $mediaReimburs->getClientOriginalName() }}
                            @else
                                <i class="fas fa-file"></i> {{ $mediaReimburs->getClientOriginalName() }}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button wire:click="inserData" class="btn btn-sm text-white" style="background: #FF4040;"
                    @if (!$isOpenModal) data-bs-dismiss="modal" @endif>Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Data -->
@foreach ($reimbursements as $getData)
    @php
        $userData = \App\Models\User::select('name', 'nip')
            ->where('id', $getData->user_id)
            ->first();

        $reimbursementLogs = \App\Models\ReimbursementLog::where('reimbursement_id', $getData->id)->get();
        $reimbursementStatus = \App\Models\ReimbursementLog::where('reimbursement_id', $getData->id)
            ->latest()
            ->first();
    @endphp

    <div class="modal fade" data-bs-backdrop="static" id="modalShowData-{{ $getData->id }}" tabindex="-1"
        aria-labelledby="modalShowDataLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content bg-tabel text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalShowDataLabel">Preview Reimbursement</h5>
                    <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fa-lg text-white"></i>
                    </button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <h5
                        class="text-center {{ count($reimbursementLogs) == 3 || $reimbursementStatus->status == 'tolak' ? 'text-uppercase' : '' }} fw-semibold">
                        @if ($reimbursementStatus->status != 'tolak' && count($reimbursementLogs) != 3)
                            @if (count($reimbursementLogs) == 1)
                                Menunggu persetujuan Direktur
                            @else
                                Menunggu persetujuan Finance
                            @endif
                        @else
                            {{ $reimbursementStatus->status }}
                        @endif
                    </h5>
                    @if ($reimbursementStatus->status == 'tolak')
                        <div class="my-2 bg-header-footer p-2 rounded">
                            <h6 class="fw-bold fst-italic m-0">Alasan:</h6>
                            <p class="m-0">
                                @if ($reimbursementStatus->reason != null)
                                    {{ $reimbursementStatus->reason }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    @endif
                    <div class="mb-2">
                        <h6 class="fw-bold fst-italic m-0">Pengajuan dari:</h6>
                        <p class="m-0">
                            {{ $userData->name }} - {{ $userData->nip }}
                        </p>
                    </div>
                    <div class="mb-2">
                        <h6 class="fw-bold fst-italic m-0">Tanggal pengajuan:</h6>
                        <p class="m-0">
                            {{ \Carbon\Carbon::parse($getData->date_reimbursement)->format('D, d-m-Y') }}
                        </p>
                    </div>
                    <div class="mb-2">
                        <h6 class="fw-bold fst-italic m-0">Nama reimbursment:</h6>
                        <p class="m-0">
                            {{ $getData->name_reimbursement }}
                        </p>
                    </div>
                    <div class="mb-2">
                        <h6 class="fw-bold fst-italic m-0">Description:</h6>
                        <p class="m-0" style="text-align: justify;">
                            {{ $getData->description }}
                        </p>
                    </div>
                    <div class="mb-2">
                        <h6 class="fw-bold fst-italic m-0">Media:</h6>
                        @if ($getData->attachment != null)
                            @php
                                $extension = pathinfo($getData->attachment, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extension == 'pdf')
                                <a href="{{ asset('storage/reimbursement/' . $getData->attachment) }}" class="nav-link"
                                    target="_blank">
                                    <div class="d-flex gap-2 align-items-center my-2">
                                        <span class="bg-header-footer p-2 rounded">
                                            <i class="fa-solid fa-file-pdf fa-xl"></i>
                                        </span>
                                        <p class="m-0">
                                            {{ $getData->name_reimbursement . '.' . $extension }}
                                        </p>
                                    </div>
                                </a>
                            @else
                                <a href="{{ asset('storage/reimbursement/' . $getData->attachment) }}"
                                    data-lightbox="{{ $getData->attachment }}"
                                    data-title="{{ $getData->name_reimbursement }}" class="nav-link">
                                    <div class="d-flex gap-2 align-items-center my-2">
                                        <span class="bg-header-footer p-2 rounded">
                                            <i class="fa-solid fa-image fa-xl"></i>
                                        </span>
                                        <p class="m-0">
                                            {{ $getData->name_reimbursement . '.' . $extension }}
                                        </p>
                                    </div>
                                </a>
                            @endif
                        @else
                            None
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


<!-- Modal Edit Data -->
@foreach ($reimbursements as $getData)
    @php
        $userData = \App\Models\User::select('name', 'nip')
            ->where('id', $getData->user_id)
            ->first();

        $reimbursementLogs = \App\Models\ReimbursementLog::where('reimbursement_id', $getData->id)->get();
        $reimbursementStatus = \App\Models\ReimbursementLog::where('reimbursement_id', $getData->id)
            ->latest()
            ->first();
    @endphp

    <div class="modal fade" data-bs-backdrop="static" id="modalEditReimburs-{{ $getData->id }}" tabindex="-1"
        aria-labelledby="modalAddReimbursLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content bg-tabel text-white">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalAddReimbursLabel">Pengajuan Reimbursement</h5>
                    <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fa-lg text-white"></i>
                    </button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="dateReimburs">Tanggal <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control bg-header-footer text-white border-0"
                            value="{{ $getData->date_reimbursement ? \Carbon\Carbon::parse($getData->date)->format('dd-mm-yyyy') : '' }}"
                            wire:model="dateReimburs" autocomplete="off" required>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="nameReimburs">Nama Reimbursement <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-header-footer text-white border-0"
                            id="nameReimburs" placeholder="Nama Reimbursement"
                            value="{{ $getData->name_reimbursement }}" autocomplete="off" required>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="descReimburs">Deskripsi <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control bg-header-footer text-white border-0" id="descReimburs" style="resize: none;"
                            rows="4" required>{{ $getData->description }}</textarea>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="mediaReimburs">Media <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control bg-header-footer text-white border-0"
                            id="mediaReimburs" accept="image/*, .pdf" wire:model="mediaReimburs" />
                        <div class="mt-2">
                            @if ($mediaReimburs)
                                @if (str_contains($mediaReimburs->getMimeType(), 'image'))
                                    <i class="fas fa-file-image"></i> {{ $mediaReimburs->getClientOriginalName() }}
                                @elseif(str_contains($mediaReimburs->getMimeType(), 'pdf'))
                                    <i class="fas fa-file-pdf"></i> {{ $mediaReimburs->getClientOriginalName() }}
                                @else
                                    <i class="fas fa-file"></i> {{ $mediaReimburs->getClientOriginalName() }}
                                @endif
                            @endif
                        </div>
                    </div>

                    @if ($getData->attachment != null)
                        <div class="mb-2">
                            <h6 class="fw-bold fst-italic m-0">Media:</h6>
                            @php
                                $extension = pathinfo($getData->attachment, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extension)
                                <div class="d-flex gap-2 align-items-center my-2">
                                    <span class="bg-header-footer p-2 rounded">
                                        <i class="fa-solid fa-file-pdf fa-xl"></i>
                                    </span>
                                    <p class="m-0">
                                        {{ $getData->name_reimbursement . '.' . $extension }}
                                    </p>
                                </div>
                            @else
                                <div class="d-flex gap-2 align-items-center my-2">
                                    <span class="bg-header-footer p-2 rounded">
                                        <i class="fa-solid fa-image fa-xl"></i>
                                    </span>
                                    <p class="m-0">
                                        {{ $getData->name_reimbursement . '.' . $extension }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-0">
                    <button wire:click="inserData" class="btn btn-sm text-white"
                        style="background: #FF4040;">Save</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
