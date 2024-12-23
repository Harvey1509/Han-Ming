@props([
    'status' => 'neutral',
    'label' => null,
    'placeholder' => '',
    'type' => 'text',
    'id' => null,
    'name' => null,
    'required' => false,
    'value' => null,
])

@php
    $hasError = $errors->has($name);
    $status = $hasError ? 'error' : ($status === 'success' ? 'success' : ($status === 'disabled' ? 'disabled' : 'neutral'));

    $containerClass = "input__wrapper input__status--$status";
    $inputClass = "input";
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    @if ($label)
        <label class="input__label" @if($id) for="{{ $id }}" @endif>{{ $label }}</label>
    @endif

    <div class="input__box">
        <input 
            value="{{ $value }}"
            class="{{ $inputClass }}" 
            type="{{ $type }}" 
            @if($id) id="{{ $id }}" @endif 
            placeholder="{{ $placeholder }}" 
            @if($name) name="{{ $name }}" @endif
        >

        @if($status === 'success')
            <x-icon class="input__icon" icon_name="check_circle" />
        @elseif($status === 'error')
            <x-icon class="input__icon" icon_name="cancel" />
        @endif
    </div>

    {{-- Mensaje de error --}}
    @error($name)
        <small class="input__reinforcement-text">
            {{ $message }}
        </small>
    @enderror
</div>

<style>
    .input__wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    /* Estado por default */
    .input__status--neutral {
        --input-main-color: var(--neutral-c600);
    }

    .input__status--neutral:has(.input:focus) {
        --input-main-color: var(--neutral-c800);
    }

    /* Variantes de estado */
    .input__status--success {
        --input-main-color: var(--success-c400);
    }

    .input__status--success:has(.input:focus) {
        --input-main-color: var(--success-c600);
    }

    .input__status--error {
        --input-main-color: var(--danger-c500);
    }

    .input__status--error:has(.input:focus) {
        --input-main-color: var(--danger-c700);
    }

    .input__status--disabled {
        --input-main-color: var(--neutral-c300);
        pointer-events: none;
    }

    /* Estilos comunes con las variables seteadas */
    .input__box {
        width: 100%;
        padding: 10px;
        height: 40px;
        border: 1px solid var(--input-main-color);
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .input {
        flex: 1;
        border: none;
        background-color: transparent;
        color: var(--input-main-color);
    }

    .input::placeholder {
        color: var(--input-main-color);
    }

    .input__label,
    .input__reinforcement-text,
    .input__icon {
        color: var(--input-main-color);
    }

    .input__icon {
        font-size: 2rem;
        display: none;
    }

    .input__status--success .input__icon,
    .input__status--error .input__icon {
        display: inline-block;
    }
</style>