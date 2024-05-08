<style>
    .form-control::placeholder {
        color: white;
    }
</style>

<!-- Modal Add Role User -->
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
                <button wire:click="inserData" class="btn btn-sm text-white" style="background: #FF4040;">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Role User -->
{{-- @foreach ($users as $user)
    <div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1" aria-labelledby="modalEditUserLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-0 m-0">
                        <h5 class="modal-title fw-bold" id="modalEditUserLabel">Edit Peran Pengguna</h5>
                        <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark fa-lg text-white"></i>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" autocomplete="off" required>
                        </div>
                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" autocomplete="off" required disabled>
                        </div>

                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="role">Peran</label>
                            <select class="form-select" name="role" id="role" required>
                                <option disabled>-- Pilih Peran --</option>
                                <option value="director" @if ($user->roles->first()->name == 'director') selected @endif>Admin
                                </option>
                                <option value="reviewer" @if ($user->roles->first()->name == 'reviewer') selected @endif>Reviewer
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn text-white" style="background: #FF4040;">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach --}}
