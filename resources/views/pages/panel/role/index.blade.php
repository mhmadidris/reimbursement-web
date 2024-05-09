@extends('layouts.store')

@section('title')
    Role
@endsection

@section('content')
    <div class="mb-4 text-white d-flex justify-content-between align-content-center align-items-center">
        <h4 class="m-0 fw-bold">
            Data Karyawan
        </h4>
        <button data-bs-toggle="modal" data-bs-target="#modalAddUser"
            class="btn btn-sm bg-btn-green text-black fw-bold d-flex flex-row align-items-center justify-content-center gap-2 mb-2">
            <i class="fas fa-plus"></i>
            <span class="d-md-block d-none">Tambah</span>
        </button>
    </div>

    <div class="card">
        <div class="table-responsive rounded">
            <table class="table">
                <caption class="visually-hidden">Description of the table</caption>
                <thead style="background: #D9D9D9;">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Jabatan</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <th class="text-center" scope="row">{{ $i++ }}</th>
                            <td>{{ $user->nip }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if ($user->email != null)
                                    {{ $user->email }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $user->roles->first()->display_name }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-content-center align-items-center">
                                    {{-- <button class="btn border-0" style="color: #FF4040;" data-bs-toggle="modal"
                                        data-bs-target="#modalEditUser-{{ $user->id }}">Edit</button> --}}
                                    <form
                                        action="{{ route('setting-admin.destroy', ['locale' => app()->getLocale(), 'setting_admin' => $user->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="userId" value="{{ $user->id }}">
                                        <button class="btn border-0" style="color: #FF4040;" type="submit"
                                            onclick="return confirmDelete();">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($users->hasPages())
        <div class="mt-4 me-3 w-full d-flex justify-content-end">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    @endif

    @include('pages.panel.role.modal')

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this user?');
        }
    </script>
@endsection
