<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('assets/js/pages/demo.timepicker.js') }}"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        background: '#eef2f7',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    const Toast2 = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 1000,
        background: '#eef2f7',
    });

    function ToastSuccessAlert(msg) {
        Toast.fire({
            icon: 'success',
            title: msg,
        })
    }

    function ToastErrorAlert(msg) {
        Toast.fire({
            icon: 'error',
            title: msg,
        })
    }

    function ToastInfoAlert(msg) {
        Toast2.fire({
            icon: 'info',
            title: msg,
        })
    }

    function Confirm(id, event) {
        Swal.fire({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#9d9c9c',
            confirmButtonColor: '#383F5C',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.value) {
                window.livewire.emit(event, id)
                Swal.fire(
                    '¡Eliminado!',
                    'El registro fue eliminado',
                    'success',
                )
                // Swal.close()
            }
        })

    }


    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('success_alert', Msg => {
            ToastSuccessAlert(Msg);
        });
        window.livewire.on('error_alert', Msg => {
            ToastErrorAlert(Msg);
        });
        window.livewire.on('info_alert', Msg => {
            ToastInfoAlert(Msg);
        });

    });
</script>
