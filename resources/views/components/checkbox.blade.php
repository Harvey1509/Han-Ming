@props([
'type' => 'square', 
'checked' => false,
'disabled' => false,
'required' => false,
'id' => null,
'name' => null,
])

<div {{ $attributes->merge(['class' => "checkbox__wrapper " . ($disabled ? 'disabled' : '')]) }}>
    <label class="checkbox__action">
        <input
            @if($name)
            name="{{$name}}"
            @endif
            @if($id)
            id="{{$id}}"
            @endif
            type="checkbox"
            class="checkbox__input"
            {{ $checked ? 'checked' : '' }}
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}>
        <span class="checkbox checkbox--{{ $type }}">
            @if ($type === 'square')
            <x-icon icon_name="check" class="checkbox__icon" />
            @endif
        </span>
        <label class="checkbox__label" @if($id) for="{{$id}}" @endif>{{ $slot }}</label>
    </label>
</div>

<style>
    .checkbox__wrapper {
        --checkbox-main-color: var(--primary-c600);
    }

    .checkbox__wrapper.disabled {
        --checkbox-main-color: var(--neutral-c300);
        color: var(--checkbox-main-color);
        pointer-events: none;
    }

    .checkbox__action {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: var(--small-text-font-size);
    }

    .checkbox__input {
        display: none;
    }

    .checkbox {
        width: 20px;
        height: 20px;
        background-color: transparent;
        border: 1px solid var(--checkbox-main-color);
        transition: background-color 0.3s, border-color 0.3s;
        display: flex;
        justify-content: center;
        position: relative;
        align-items: center;
        margin-right: 5px;
    }

    .checkbox--square {
        border-radius: 3px;
    }

    .checkbox__icon {
        font-size: 1.5rem;
        color: white;
        display: none;
    }

    .checkbox--round {
        border-radius: 50%;
    }

    .checkbox__input:checked+.checkbox--round::before {
        content: '';
        position: absolute;
        width: 10px;
        height: 10px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: var(--checkbox-main-color);
        border-radius: 50%;
    }

    .checkbox:hover {
        --checkbox-main-color: var(--primary-c700);
    }

    .checkbox:active {
        --checkbox-main-color: var(--primary-c800);
    }

    .checkbox__input:checked+.checkbox--square {
        background-color: var(--checkbox-main-color);
        border-color: var(--checkbox-main-color);
    }

    .checkbox__input:checked+.checkbox--round {
        background-color: white;
    }

    .checkbox__input:checked+.checkbox--square .checkbox__icon {
        display: block;
    }

    .checkbox__input:checked+.checkbox:hover {
        --checkbox-main-color: var(--primary-c700);
    }

    .checkbox__input:checked+.checkbox:active {
        --checkbox-main-color: var(--primary-c800);
    }

    .checkbox__input:disabled+.checkbox {
        border-color: var(--neutral-c300);
        background-color: var(--neutral-c50);
    }

    .checkbox__input:disabled+.checkbox .checkbox__icon {
        color: var(--neutral-c300);
    }

    .checkbox__label {
        a {
            display: inline-block;
            font-size: inherit;
        }
    }
</style>