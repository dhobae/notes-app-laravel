@if (session('notification'))
    {{-- HELLO! --}}
    <script>
        Toastify({
            text: "{{ session('notification.message') }}",
            duration: 3000,
            destination: false,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "{{ session('notification.bg-color') }}",
                textShadow: "0px 1px 2px rgba(0, 0, 0, 0.3)"
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif

{{-- background: linear-gradient(90deg, rgba(180,58,144,1) 0%, rgba(253,29,29,1) 59%, rgba(252,176,69,1) 100%); --}}



{{-- 
@if (session('notifikasi'))
    <h1>tes ada</h1>
    <script>
        Swal.fire({
            title: "{{ session('notifikasi.title_alert') }}",
            text: "{{ session('notifikasi.text') }}",
            icon: "{{ session('notifikasi.icon') }}"
        });
    </script>
@endif --}}
