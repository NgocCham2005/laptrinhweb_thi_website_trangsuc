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
<script>
function openModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.remove('open');
    document.body.style.overflow = '';
}

function handleBackdropClick(event, id) {
    if (event.target.classList.contains('modal-backdrop')) {
        closeModal(id);
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-backdrop.open')
            .forEach(function(el) {
                closeModal(el.id);
            });
    }
});
</script>