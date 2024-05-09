<div>
    <x-loading />

    @if (count($reimbursements) != 0)
        <div class="card">
            <div class="table-responsive rounded">
                <table class="table table-hover">
                    <caption class="visually-hidden">Description of the table</caption>
                    <thead style="background: #D9D9D9;">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Pengajuan Dari</th>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($reimbursements as $item)
                            @php
                                $userData = \App\Models\User::select('name', 'nip')
                                    ->where('id', $item->user_id)
                                    ->first();

                                $reimbursementLogs = \App\Models\ReimbursementLog::where(
                                    'reimbursement_id',
                                    $item->id,
                                )->get();
                                $reimbursementStatus = \App\Models\ReimbursementLog::where(
                                    'reimbursement_id',
                                    $item->id,
                                )
                                    ->latest()
                                    ->first();
                            @endphp
                            <tr>
                                <th class="text-center" scope="row">{{ $i++ }}</th>
                                <td>
                                    {{ $userData->name }} <br>
                                    <span class="fw-semibold fst-italic" style="font-size: 0.85rem">NIP:
                                        {{ $userData->nip }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->date_reimbursement)->format('D, d-m-Y') }}</td>
                                <td>{{ $item->name_reimbursement }}</td>
                                <td
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
                                </td>
                                <td class="text-center">
                                    <div
                                        class="d-flex justify-content-center align-content-center align-items-center gap-2">
                                        <button class="btn btn-sm text-white border-0" data-bs-toggle="modal"
                                            style="background-color: green; width: 5vw;" data-bs-toggle="modal"
                                            data-bs-target="#modalShowData"
                                            wire:click="getOneData('{{ $item->id }}')">View</button>

                                        @if (Auth::user()->hasRole('director') && count($reimbursementLogs) == 1)
                                            <button wire:confirm="Anda yakin ingin menyetujui proposal ini?"
                                                class="btn btn-sm text-white border-0 bg-primary" style="width: 5vw;"
                                                wire:click="updateStatus('{{ $item->id }}', 'terima')">Terima</button>
                                            <button wire:confirm="Anda yakin ingin menolak proposal ini?"
                                                class="btn btn-sm text-white border-0 bg-danger"
                                                wire:click="updateStatus('{{ $item->id }}', 'tolak')"
                                                style="width: 5vw;">Tolak</button>
                                        @endif

                                        @if (Auth::user()->hasRole('finance') && count($reimbursementLogs) == 2)
                                            <button wire:confirm="Anda yakin ingin menyetujui proposal ini?"
                                                class="btn btn-sm text-white border-0 bg-primary" style="width: 5vw;"
                                                wire:click="updateStatus('{{ $item->id }}', 'terima')">Terima</button>
                                            <button wire:confirm="Anda yakin ingin menolak proposal ini?"
                                                class="btn btn-sm text-white border-0 bg-danger"
                                                wire:click="updateStatus('{{ $item->id }}', 'tolak')"
                                                style="width: 5vw;">Tolak</button>
                                        @endif

                                        @if (Auth::user()->hasRole('staff') && count($reimbursementLogs) == 1)
                                            <button class="btn btn-sm text-white border-0 bg-primary"
                                                style="width: 5vw;" data-bs-toggle="modal"
                                                data-bs-target="#modalEditUser{{ $item->id }}">Edit</button>
                                            <button wire:confirm="Anda yakin ingin menghapus proposal ini?"
                                                class="btn btn-sm text-white border-0 bg-danger"
                                                wire:click="deleteData('{{ $item->id }}')"
                                                style="width: 5vw;">Hapus</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($reimbursements->hasPages())
                <div class="mt-4 me-3 w-full d-flex justify-content-end">
                    {{ $reimbursements->links('livewire::bootstrap') }}
                </div>
            @endif
        </div>
    @else
        @include('components.no-data')
    @endif

    @include('pages.panel.reimburs.modal')
</div>
