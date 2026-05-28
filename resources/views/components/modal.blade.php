@props([
    'id'    => 'modal',
    'title' => '',
])

<div class="modal-backdrop" id="{{ $id }}" onclick="handleBackdropClick(event, '{{ $id }}')">
    <div class="modal" role="dialog" aria-modal="true">

        <div class="modal-header">
            <h3 class="modal-title">{{ $title }}</h3>
            <button type="button" class="modal-close" onclick="closeModal('{{ $id }}')">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
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

@once
<script>
function openModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove('open');
    document.body.style.overflow = '';
}

function handleBackdropClick(event, id) {
    if (event.target.classList.contains('modal-backdrop')) {
        closeModal(id);
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-backdrop.open').forEach(function(el) {
            closeModal(el.id);
        });
    }
});
</script>
@endonce