<div>
    <x-loading />

    @if (count($reimbursements) != 0)
        <div class="card">
            <div class="table-responsive rounded">
                <table class="table table-borderless">
                    <caption class="visually-hidden">Description of the table</caption>
                    <thead style="background: #D9D9D9;">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($reimbursements as $item)
                            <tr>
                                <th class="text-center" scope="row">{{ $i++ }}</th>
                                <td>{{ \Carbon\Carbon::parse($item->date_reimbursement)->format('D, d-m-Y') }}</td>
                                <td>{{ $item->name_reimbursement }}</td>
                                <td class="text-center text-uppercase fw-semibold"
                                    @if ($item->status == 'pending') style="color: blue;"
                            @elseif ($item->status == 'terima') style="color: green;" @else style="color: red;" @endif>
                                    {{ $item->status }}</td>
                                <td class="text-center">
                                    <div
                                        class="d-flex justify-content-center align-content-center align-items-center gap-2">
                                        <button class="btn btn-sm text-white border-0"
                                            style="background-color: green; width: 25%;" data-bs-toggle="modal"
                                            data-bs-target="#modalEditUser{{ $item->id }}">View</button>
                                        <button class="btn btn-sm text-white border-0 bg-primary" style="width: 25%;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditUser{{ $item->id }}">Edit</button>
                                        <button class="btn btn-sm text-white border-0 bg-danger"
                                            wire:click="deleteData('{{ $item->id }}')"
                                            style="width: 25%;">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        @include('components.no-data')
    @endif

    @include('pages.panel.reimburs.modal')

    <script>
        $('#dateReimburs').datepicker();
    </script>
</div>
