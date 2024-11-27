@if(session('success') || session('error') || $errors->any())
    @php
        $type = $errors->any() ? 'error' : (session('success') ? 'success' : 'error');
        $title = $errors->any() ? 'Error' : (session('success') ? 'Éxito' : 'Mensaje');
        $message = $errors->any() ? implode('<br>', $errors->all()) : (session('success') ? session('success') : session('error'));
    @endphp

    <div class="modal__overlay" id="modalMessage">
        <div class="modal__content {{ $type }}">
            <h2 class="modal__title">{{ $title }}</h2>
            <p>{!! $message !!}</p>
        </div>
    </div>
@endif


<style>
    .modal__overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal__content {
        background-color: white;
        padding: 40px 20px;
        border-radius: 8px;
        text-align: center;
        max-width: 500px;
        width: 100%;
        animation: slide-down 0.5s ease;
    }

    .modal__content.success {
        border-left: 6px solid var(--success-c600);
        --color-1: var(--success-c600);
        --color-2: var(--success-c400);
    }

    .modal__content.error {
        border-left: 6px solid var(--danger-c600);
        --color-1: var(--danger-c600);
        --color-2: var(--danger-c400);
    }

    .modal__title {
        font-size: 48px;
        margin-bottom: 10px;
        color: var(--color-1);
    }

    @keyframes slide-down {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<script>
    function closeModal() {
        var modal = document.getElementById('modalMessage');
        if (modal) {
            modal.style.display = 'none';
        }
    }
    setTimeout(() => {
        closeModal();
    }, 3000);
</script>