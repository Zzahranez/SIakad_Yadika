@if (session('success'))
    <div class="alert alert-dismissible custom-toast" role="alert" id="successAlert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-4"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-dismissible custom-toast" role="alert" id="errorAlert" style="background: linear-gradient(135deg, #dc2626, #f87171);">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-circle-fill me-2 fs-4"></i>
            <span>{{ session('error') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('info'))
    <div class="alert alert-dismissible custom-toast" role="alert" id="infoAlert" style="background: linear-gradient(135deg, #2563eb, #60a5fa);">
        <div class="d-flex align-items-center">
            <i class="bi bi-info-circle-fill me-2 fs-4"></i>
            <span>{{ session('info') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<style>
    .custom-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1055;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        padding: 15px 20px;
        max-width: 400px;
        width: 0;
        opacity: 0;
        transition: width 0.5s ease, opacity 0.5s ease;
    }

    .custom-toast.show {
        width: 100%;
        opacity: 1;
    }

    .custom-toast .bi-check-circle-fill,
    .custom-toast .bi-exclamation-circle-fill,
    .custom-toast .bi-info-circle-fill {
        color: #ffffff;
        font-size: 1.5rem;
    }

    .custom-toast .btn-close {
        filter: invert(1);
        transition: transform 0.2s ease;
    }

    .custom-toast .btn-close:hover {
        transform: rotate(90deg) scale(1.2);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var alerts = document.querySelectorAll('.custom-toast');
        alerts.forEach(function(alert) {
            if (alert) {
                alert.classList.add('show');
                setTimeout(function() {
                    alert.classList.remove('show');
                }, 4000);
            }
        });
    });
</script>