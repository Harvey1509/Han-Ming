@props([
    'status' => 'neutral',
    'label' => null,
    'placeholder' => '',
    'r_text' => null,
    'id' => null,
    'name' => null,
    'required' => null,
    'rows' => 4,
])

<div {{ $attributes->merge(['class' => "textarea__wrapper textarea__status--$status"]) }}>
    @if ($label)
        <label class="textarea__label" @if($id) for="{{ $id }}" @endif>{{ $label }}</label>
    @endif

    <div class="textarea__box">
        <textarea 
            @if($name) name="{{ $name }}" @endif
            class="textarea" 
            @if($id) id="{{ $id }}" @endif 
            placeholder="{{ $placeholder }}" 
            rows="{{ $rows }}"></textarea>
        
        @switch($status)
            @case('success')
                <x-icon class="textarea__icon" icon_name="check_circle" />
            @break
            @case('error')
                <x-icon class="textarea__icon" icon_name="cancel" />
            @break
        @endswitch
    </div>

    @if ($r_text)
        <small class="textarea__reinforcement-text">
            {{ $r_text }}
        </small>
    @endif
</div>

<style>
    .textarea__wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    /* Estado por default */
    .textarea__status--neutral {
        --textarea-main-color: var(--neutral-c400);
    }

    .textarea__status--neutral:has(.textarea:focus) {
        --textarea-main-color: var(--neutral-c600);
    }

    /* Variantes de estado */
    .textarea__status--success {
        --textarea-main-color: var(--success-c400);
    }

    .textarea__status--success:has(.textarea:focus) {
        --textarea-main-color: var(--success-c600);
    }

    .textarea__status--error {
        --textarea-main-color: var(--danger-c500);
    }

    .textarea__status--error:has(.textarea:focus) {
        --textarea-main-color: var(--danger-c700);
    }

    .textarea__status--disabled {
        --textarea-main-color: var(--neutral-c300);
        pointer-events: none;
        background-color: var(--neutral-c50);
    }

    /* Estilos comunes con las variables seteadas */
    .textarea__box {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--textarea-main-color);
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .textarea {
        flex: 1;
        border: none;
        outline: none;
        resize: none;
        background-color: transparent;
        color: var(--textarea-main-color);
        font-family: inherit;
    }

    .textarea::placeholder {
        color: var(--textarea-main-color);
    }

    .textarea__label,
    .textarea__reinforcement-text,
    .textarea__icon {
        color: var(--textarea-main-color);
    }

    .textarea__icon {
        font-size: 2rem;
        display: none;
    }

    .textarea__status--success .textarea__icon,
    .textarea__status--error .textarea__icon {
        display: inline-block;
    }
</style>
