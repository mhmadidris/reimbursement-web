<?php

namespace App\Livewire\Reimbursement;

use App\Models\Reimbursement as ModelsReimbursement;
use App\Models\ReimbursementLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Reimbursement extends Component
{
    use WithPagination, WithoutUrlPagination;

    use WithFileUploads;

    public $isOpenModal = false;
    public $selectedData;

    public $reimbursement_logs;
    public $dateReimburs, $nameReimburs, $descReimburs, $mediaReimburs;

    public $getDetailReimburs;

    #[On('updateData')]
    private function getData()
    {
        if (Auth::user()->hasRole('staff')) {
            $reimbursements = ModelsReimbursement::where('reimbursements.user_id', Auth::user()->id)
                ->orderBy('reimbursements.created_at', 'ASC')
                ->paginate(7);
        } else {
            $reimbursements = ModelsReimbursement::orderBy('reimbursements.created_at', 'ASC')
                ->paginate(7);
        }

        return $reimbursements;
    }

    public function inserData()
    {
        $filename = null;
        if ($this->mediaReimburs) {
            $filename = time() . '.' . $this->mediaReimburs->getClientOriginalExtension();
        }

        $reimbursData = ModelsReimbursement::create([
            'user_id' => Auth::user()->id,
            'date_reimbursement' => $this->dateReimburs,
            'name_reimbursement' => $this->nameReimburs,
            'description' => $this->descReimburs,
            'attachment' => $filename,
        ]);

        $saveData = ReimbursementLog::create([
            'reimbursement_id' => $reimbursData->id,
        ]);

        if ($reimbursData && $saveData) {
            $this->saveMedia($filename);

            $this->dispatch(
                'showToast',
                isToast: true,
                position: "top-end",
                isShowConfirmButton: false,
                isShowCloseButton: true,
                icon: "success",
                message: "Berhasil menambah reimbursement",
                timerDuration: 2500,
                isShowTimerProgressBar: true
            );
        } else {
            $this->dispatch(
                'showToast',
                isToast: true,
                position: "top-end",
                isShowConfirmButton: false,
                isShowCloseButton: true,
                icon: "error",
                message: "Gagal menambah reimbursement",
                timerDuration: 2500,
                isShowTimerProgressBar: true
            );
        }

        $this->clearInput();
        $this->dispatch('updateData');
    }

    public function updateStatus($id, $status)
    {
        $updateStatudData = null;
        if ($status == 'terima') {
            $updateStatudData = ReimbursementLog::create([
                'reimbursement_id' => $id,
                'status' => $status,
                'employee_user_id' => Auth::user()->id,
            ]);
        } else {
            $updateStatudData = ReimbursementLog::create([
                'reimbursement_id' => $id,
                'status' => $status,
                'employee_user_id' => Auth::user()->id,
                'reason' => "contoh",
            ]);
        }

        if ($updateStatudData) {
            $this->dispatch(
                'showToast',
                isToast: true,
                position: "top-end",
                isShowConfirmButton: false,
                isShowCloseButton: true,
                icon: "success",
                message: "Berhasil mengubah status reimbursement",
                timerDuration: 2500,
                isShowTimerProgressBar: true
            );
        } else {
            $this->dispatch(
                'showToast',
                isToast: true,
                position: "top-end",
                isShowConfirmButton: false,
                isShowCloseButton: true,
                icon: "error",
                message: "Gagal mengubah status reimbursement",
                timerDuration: 2500,
                isShowTimerProgressBar: true
            );
        }

        $this->dispatch('updateData');
    }

    public function deleteData($id)
    {
        $checkData = ModelsReimbursement::findOrFail($id)->first();

        if ($checkData->delete()) {
            $this->deleteMedia($checkData->attachment);

            $this->dispatch(
                'showToast',
                isToast: true,
                position: "top-end",
                isShowConfirmButton: false,
                isShowCloseButton: true,
                icon: "success",
                message: "Berhasil menghapus reimbursement",
                timerDuration: 2500,
                isShowTimerProgressBar: true
            );
        } else {
            $this->dispatch(
                'showToast',
                isToast: true,
                position: "top-end",
                isShowConfirmButton: false,
                isShowCloseButton: true,
                icon: "error",
                message: "Gagal menghapus reimbursement",
                timerDuration: 2500,
                isShowTimerProgressBar: true
            );
        }

        $this->dispatch('updateData');
    }

    public function render()
    {
        $reimbursements = $this->getData();

        return view('livewire.reimbursement.reimbursement', compact('reimbursements'));
    }

    public function clearInput()
    {
        $this->dateReimburs = null;
        $this->nameReimburs = null;
        $this->descReimburs = null;
        $this->mediaReimburs = null;
    }

    private function saveMedia($filename)
    {
        $this->mediaReimburs->storeAs('reimbursement', $filename, 'public');
    }

    private function deleteMedia($filename)
    {
        Storage::disk('public')->delete('reimbursement/' . $filename);
    }
}
