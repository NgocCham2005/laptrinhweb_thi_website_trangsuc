<div class="modal-backdrop" id="{{ $id }}" onclick="handleBackdropClick(event, '{{ $id }}')">
    <div class="modal">

        <div class="modal-header">
            <h3 class="modal-title">
                {{ $title }}
            </h3>

            <button
                type="button"
                class="modal-close"
                onclick="closeModal('{{ $id }}')"
            >
                ✕
            </button>
        </div>

        <div class="modal-body">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="modal-footer">
                {{ $footer }}
            </div>
        @endisset

    </div>
</div>