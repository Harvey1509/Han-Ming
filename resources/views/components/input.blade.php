@props([
'status' => 'neutral',
'label' => null,
'placeholder' => '',
'r_text' => null,
'type' => 'text',
'id' => null,
'name' => null,
'required' => null,
'value' => null
])

<div {{ $attributes->merge(['class' => "input__wrapper input__status--$status"]) }}>
    @if ($label)
        <label class="input__label" @if($id) for="{{ $id }}" @endif>{{ $label }}</label>
    @endif

    <div class="input__box">
        <input @if($value) value="{{$value}}" @endif @if($required) required @endif class="input" type="{{ $type }}" @if($id) id="{{$id}}" @endif placeholder="{{ $placeholder }}" @if($name) name="{{ $name }}" @endif>
        @switch($status)
            @case('success')
                <x-icon class="input__icon" icon_name="check_circle" />
            @break
            @case('error')
                <x-icon class="input__icon" icon_name="cancel" />
            @break
        @endswitch
    </div>

    @if ($r_text)
    <small class="input__reinforcement-text">
        {{ $r_text }}
    </small>
    @endif
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
        --input-main-color: var(--neutral-c400);
    }

    .input__status--neutral:has(.input:focus) {
        --input-main-color: var(--neutral-c600);
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
        background-color: var(--neutral-c50);
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