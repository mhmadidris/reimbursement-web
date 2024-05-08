<?php

namespace App\Livewire\Reimbursement;

use App\Models\Reimbursement as ModelsReimbursement;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Reimbursement extends Component
{
    use WithFileUploads, WithPagination;

    public $reimbursements;
    public $dateReimburs, $nameReimburs, $descReimburs, $mediaReimburs;

    public function boot()
    {
        $this->getData();
    }

    #[On('updateData')]
    public function getData()
    {
        if (Auth::user()->hasRole('staff')) {
            $this->reimbursements = ModelsReimbursement::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        } else {
            $this->reimbursements = ModelsReimbursement::orderBy('created_at', 'DESC')->get();
        }
    }

    public function inserData()
    {
        $saveMediaUpload = $this->saveMedia();

        $saveData = ModelsReimbursement::create([
            'user_id' => Auth::user()->id,
            'date_reimbursement' => $this->dateReimburs,
            'name_reimbursement' => $this->nameReimburs,
            'description' => $this->descReimburs,
            'status' => 'pending',
            'attachment' => $saveMediaUpload,
        ]);

        if ($saveData) {
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

    public function deleteData($id)
    {
        $deleteData = ModelsReimbursement::findOrFail($id)->delete();
        if ($deleteData) {
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
        return view('livewire.reimbursement.reimbursement');
    }

    public function saveMedia()
    {
        $mediaPath = null;

        if ($this->mediaReimburs) {
            $filename = time() . '_' . $this->mediaReimburs->getClientOriginalName();

            $mediaPath = $this->mediaReimburs->storeAs('reimbursement', $filename, 'public');
        }

        return $mediaPath;
    }

    public function clearInput()
    {
        $this->dateReimburs = null;
        $this->nameReimburs = null;
        $this->descReimburs = null;
        $this->mediaReimburs = null;
    }
}