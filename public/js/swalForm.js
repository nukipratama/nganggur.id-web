    function swal(text, form_id, e) {
        e.preventDefault();
        const swal = Swal.mixin({
            customClass: {
                container: 'm-0 p-0',
                title: 'pt-0',
                image: 'm-0 p-1',
                confirmButton: 'font-weight-bold btn-lg btn-success w-50 rounded-0 border-0',
                cancelButton: 'font-weight-bold btn-lg btn-secondary w-50 rounded-0 border-0'
            },
            buttonsStyling: false
        }).fire({
            position: 'bottom',
            title: "<small>Konfirmasi</small>",
            showClass: {
                popup: 'animate__animated animate__fadeInUp'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutDown'
            },
            width: '100vw',
            html: text,
            imageUrl: "/img/warning.svg",
            imageWidth: 200,
            imageHeight: 200,
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: "YA",
            cancelButtonText: "TIDAK",
        }).then((result) => {
            if (result.value) {
                $(form_id).submit()
            } else if (result.dismiss === Swal.DismissReason.cancel) {}
        });
    }
