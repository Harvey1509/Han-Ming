<div class="form__inputbox">
    <label class="form__label">{{ $label }}</label>
    <input 
        {{ $required ?? ''}} 
        name="{{ $name ?? '' }}" 
        type="{{ $type }}" 
        class="form__input" 
        placeholder="{{ $placeholder ?? '' }}" 
        value="{{ $value ?? '' }}"
        {{ $status ?? ''}}
     >
</div>