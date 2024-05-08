document.addEventListener("livewire:init", () => {
    Livewire.on("showToast", (event) => {
        const Toast = Swal.mixin({
            toast: event.isToast,
            position: event.position,
            showConfirmButton: event.isShowConfirmButton,
            showCloseButton: event.isShowCloseButton,
            timer: event.timerDuration,
            timerProgressBar: event.isShowTimerProgressBar,
        });
        Toast.fire({
            icon: event.icon,
            title: event.message,
        });
    });

    Livewire.on("showConfirm", (event) => {
        Swal.fire({
            title: event.title,
            text: event.text,
            icon: event.icon,
            color: event.color,
            allowOutsideClick: event.allowOutsideClick,
            showCancelButton: event.showCancelButton,
            confirmButtonColor: event.confirmButtonColor,
            cancelButtonColor: event.cancelButtonColor,
            confirmButtonText: event.confirmButtonText,
            cancelButtonText: event.cancelButtonText,
            background: event.background,
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch("cancelStatus", {
                    transactionId: event.idTransaction,
                    status: event.statusTransaction,
                });
            }
        });
    });
});
