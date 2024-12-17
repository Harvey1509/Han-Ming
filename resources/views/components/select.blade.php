<div class="form__inputbox">
    <label for="select-{{ $name }}" class="form__label">{{ $label }}</label>
    <select 
        name="{{ $name }}" 
        id="select-{{ $name }}" 
        class="form__select" 
        aria-label="{{ $label }}"
    >
        <option value="" disabled {{ is_null($currentOption) ? 'selected' : '' }}>
            {{ $placeholder ?? 'Seleccione una opción' }}
        </option>
        
        @foreach ($options as $value => $displayText)
            <option value="{{ $value }}" {{ $value == $currentOption ? 'selected' : '' }}>
                {{ $displayText }}
            </option>
        @endforeach
    </select>
</div>
