<style>
    .form-control::placeholder {
        color: white;
    }
</style>

<!-- Modal Add User -->
<div class="modal fade" data-bs-backdrop="static" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUserLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-tabel text-white">
            <form action="{{ route('setting-admin.store', ['locale' => app()->getLocale()]) }}" method="post">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalAddUserLabel">Tambah Karyawan</h5>
                    <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fa-lg text-white"></i>
                    </button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-header-footer text-white border-0" id="name"
                            name="name" placeholder="cth: Budi" autocomplete="off" required>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="nip">NIP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-header-footer text-white border-0" id="nip"
                            name="nip" placeholder="cth: xxxxx" autocomplete="off" required>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="email">Email</label>
                        <input type="email" class="form-control bg-header-footer text-white border-0" id="email"
                            name="email" placeholder="cth: example@email.com" autocomplete="off">
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="password">Password <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control bg-header-footer text-white border-0" id="password"
                            name="password" placeholder="•••••••••" autocomplete="off" required>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="role">Jabatan <span class="text-danger">*</span></label>
                        <select class="form-select bg-header-footer text-white border-0" name="role" id="role"
                            required>
                            <option selected disabled>-- Pilih Jabatan --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-sm text-white" style="background: #FF4040;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
@foreach ($users as $user)
    <div class="modal fade" data-bs-backdrop="static" id="modalEditUser-{{ $user->id }}" tabindex="-1"
        aria-labelledby="modalEditUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-tabel text-white">
                <form
                    action="{{ route('setting-admin.update', ['setting_admin' => $user->id, 'locale' => app()->getLocale()]) }}"
                    method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold" id="modalEditUserLabel">Ubah Data Karyawan</h5>
                        <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark fa-lg text-white"></i>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="name">Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-header-footer text-white border-0"
                                id="name" name="name" placeholder="cth: Budi" autocomplete="off"
                                value="{{ $user->name }}" required>
                        </div>

                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="nip">NIP <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-header-footer text-white border-0"
                                id="nip" name="nip" value="{{ $user->nip }}" placeholder="cth: xxxxx"
                                autocomplete="off" style="opacity: 0.75;" disabled readonly>
                        </div>

                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="email">Email</label>
                            <input type="email" class="form-control bg-header-footer text-white border-0"
                                id="email" name="email" placeholder="cth: example@email.com"
                                value="{{ $user->email }}" autocomplete="off">
                        </div>

                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="password">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control bg-header-footer text-white border-0"
                                id="password" name="password" placeholder="•••••••••" autocomplete="off">
                        </div>

                        <div class="d-flex flex-column w-100">
                            <label class="pb-1 h6 fw-bold" for="role">Jabatan <span
                                    class="text-danger">*</span></label>
                            <select class="form-select bg-header-footer text-white border-0" name="role"
                                id="role" required>
                                <option selected disabled>-- Pilih Jabatan --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        @if ($role->display_name == $user->roles->first()->display_name) selected @endif>{{ $role->display_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-sm text-white"
                            style="background: #FF4040;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
