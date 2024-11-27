@props([
    'label' => null,
    'name' => null,
    'placeholder' => 'Seleccione opciones',
    'options' => [],
    'selected' => [],
    'status' => 'neutral',
    'id' => null,
    'required' => null,
])

<div {{ $attributes->merge(['class' => "multiselect__wrapper multiselect__status--$status"]) }}>
    @if ($label)
        <label class="multiselect__label" @if($id) for="{{ $id }}" @endif>{{ $label }}</label>
    @endif

    <div class="multiselect__box">
        <select 
            class="multiselect" 
            @if($id) id="{{ $id }}" @endif 
            @if($name) name="{{ $name }}[]" @endif 
            multiple 
            @if($required) required @endif
        >
            @foreach ($options as $option)
                <option 
                    value="{{ $option['id'] }}" 
                    @if(in_array($option['id'], $selected)) selected @endif
                >
                    {{ $option['label'] }}
                </option>
            @endforeach
        </select>
        <x-icon class="multiselect__icon" icon_name="expand_more" />
    </div>

    @if ($slot->isNotEmpty())
        <small class="multiselect__reinforcement-text">
            {{ $slot }}
        </small>
    @endif
</div>

<style>
    .multiselect__wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    /* Estado por default */
    .multiselect__status--neutral {
        --multiselect-main-color: var(--neutral-c400);
    }

    .multiselect__status--neutral:has(.multiselect:focus) {
        --multiselect-main-color: var(--neutral-c600);
    }

    /* Variantes de estado */
    .multiselect__status--success {
        --multiselect-main-color: var(--success-c400);
    }

    .multiselect__status--success:has(.multiselect:focus) {
        --multiselect-main-color: var(--success-c600);
    }

    .multiselect__status--error {
        --multiselect-main-color: var(--danger-c500);
    }

    .multiselect__status--error:has(.multiselect:focus) {
        --multiselect-main-color: var(--danger-c700);
    }

    /* Estilo principal */
    .multiselect__box {
        width: 100%;
        padding: 10px;
        height: auto;
        border: 1px solid var(--multiselect-main-color);
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .multiselect {
        flex: 1;
        border: none;
        background-color: transparent;
        color: var(--multiselect-main-color);
        font-size: 1rem;
        height: auto;
    }

    .multiselect__label,
    .multiselect__reinforcement-text,
    .multiselect__icon {
        color: var(--multiselect-main-color);
    }

    .multiselect__icon {
        font-size: 2rem;
        pointer-events: none;
    }
</style>
