{{-- Session Notification --}}
@if (session('success'))
    <div class="alert alert-dismissible fade show custom-alert animate__animated animate__fadeInDown" role="alert" id="successAlert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-4"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <style>
        .custom-alert {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6); /* Gradasi biru tua ke biru cerah */
            color: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 15px 20px;
            margin: 20px auto;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-alert:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .custom-alert .bi-check-circle-fill {
            color: #ffffff;
            font-size: 1.5rem;
            animation: pulse 1.5s infinite;
        }

        /* Pulse animation untuk ikon */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        /* Efek glow pada notifikasi */
        .custom-alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .custom-alert:hover::before {
            left: 100%;
        }

        /* Animasi tombol close */
        .custom-alert .btn-close {
            filter: invert(1);
            transition: transform 0.2s ease;
        }

        .custom-alert .btn-close:hover {
            transform: rotate(90deg) scale(1.2);
        }

        /* Animasi masuk */
        .animate__fadeInDown {
            animation-duration: 0.5s;
        }
    </style>

    <script>
        // Menutup alert otomatis setelah 5 detik
        setTimeout(function() {
            var alert = document.getElementById('successAlert');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 2000);
    </script>
@endif