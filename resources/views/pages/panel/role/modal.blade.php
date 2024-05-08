<style>
    .form-control::placeholder {
        color: white;
    }
</style>

<!-- Modal Add Role User -->
<div class="modal fade" data-bs-backdrop="static" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUserLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-tabel text-white">
            <form action="" method="post">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="modalAddUserLabel">Tambah Peran Pengguna</h5>
                    <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fa-lg text-white"></i>
                    </button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="name">Name</label>
                        <input type="text" class="form-control bg-header-footer text-white border-0" id="name"
                            name="name" placeholder="Your Name" autocomplete="off" required>
                    </div>
                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="email">Email</label>
                        <input type="email" class="form-control bg-header-footer text-white border-0" id="email"
                            name="email" placeholder="Your Email" autocomplete="off">
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="password">Password</label>
                        <input type="password" class="form-control bg-header-footer text-white border-0" id="password"
                            name="password" placeholder="Your Password" autocomplete="off" required>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="jabatan">Jabatan</label>
                        <select class="form-select bg-header-footer text-white border-0" name="jabatan" id="jabatan"
                            required>
                            <option value="" selected disabled>-- Pilih Jabatan --</option>
                            <option value="JABATAN">JABATAN</option>
                            <option value="FINANCE">FINANCE</option>
                            <option value="STAFF">STAFF</option>
                        </select>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="pb-1 h6 fw-bold" for="role">Peran</label>
                        <select class="form-select bg-header-footer text-white border-0" name="role" id="role"
                            required>
                            <option selected disabled>-- Pilih Peran --</option>
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

<!-- Modal Edit Role User -->
@foreach ($users as $user)
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
@endforeach
