@props([
'label' => 'Ingrese un label',
'checked' => false,
'disabled' => false,
])

<div {{ $attributes->merge(['class' => "toggle__wrapper " . ($disabled ? 'disabled' : '')]) }}>
    <label class="toggle__action">
        <input
            type="checkbox"
            class="toggle__checkbox"
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}>
        <span class="toggle"></span>
        <small>{{ $label }}</small>
    </label>
</div>


<style>
    .toggle__wrapper {
        --toggle-main-color: var(--primary-c600);
    }

    .toggle__wrapper.disabled {
        --toggle-main-color: var(--neutral-c300);
        color: var(--toggle-main-color);
        pointer-events: none;
    }

    .toggle__action {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: var(--small-text-font-size);
    }

    .toggle__checkbox {
        display: none;
    }

    .toggle {
        width: 40px;
        height: 20px;
        background-color: transparent;
        border-radius: 20px;
        border: 1px solid var(--toggle-main-color);
        position: relative;
        transition: background-color 0.3s, border-color 0.3s;
        margin-right: 5px;
    }

    .toggle::before {
        content: '';
        position: absolute;
        width: 15px;
        height: 15px;
        background-color: var(--toggle-main-color);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        left: 2px;
        transition: transform 0.3s, background-color 0.3s;
    }

    .toggle:hover {
        --toggle-main-color: var(--primary-c700);
    }

    .toggle:active {
        --toggle-main-color: var(--primary-c800);
    }

    .toggle__checkbox:checked+.toggle {
        background-color: var(--toggle-main-color);
    }

    .toggle__checkbox:checked+.toggle:hover {
        --toggle-main-color: var(--primary-c700);
    }

    .toggle__checkbox:checked+.toggle:active {
        --toggle-main-color: var(--primary-c800);
    }

    .toggle__checkbox:checked+.toggle::before {
        background-color: white;
        transform: translateX(20px) translateY(-50%);
    }
</style>