@props([
    'name'        => '',
    'label'       => null,
    'type'        => 'text',
    'placeholder' => '',
    'value'       => '',
    'required'    => false,
    'disabled'    => false,
    'hint'        => null,
    'icon'        => null,
    'rows'        => 4,
])

@php
    $hasError   = $errors->has($name);
    $stateClass = $hasError ? 'is-invalid' : '';
    $inputId    = 'input-' . $name;
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $inputId }}" class="form-label">
            {{ $label }}
            @if($required) <span class="required">*</span> @endif
        </label>
    @endif

    <div class="{{ $icon ? 'input-group' : '' }}">
        @if($icon)
            <span class="input-icon">{{ $icon }}</span>
        @endif

        @if($type === 'textarea')
            <textarea
                id="{{ $inputId }}"
                name="{{ $name }}"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => "form-control {$stateClass}"]) }}
            >{{ old($name, $value) }}</textarea>

        @elseif($type === 'select')
            <select
                id="{{ $inputId }}"
                name="{{ $name }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => "form-control {$stateClass}"]) }}
            >
                {{ $slot }}
            </select>

        @else
            <input
                id="{{ $inputId }}"
                type="{{ $type }}"
                name="{{ $name }}"
                value="{{ old($name, $value) }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => "form-control {$stateClass}"]) }}
            >
        @endif
    </div>

    @if($hasError)
        <div class="form-error">{{ $errors->first($name) }}</div>
    @elseif($hint)
        <div class="form-hint">{{ $hint }}</div>
    @endif
</div>