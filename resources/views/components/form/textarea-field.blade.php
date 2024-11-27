<div class="form__inputbox">
    <label class="form__label">{{ $label }}</label>
    <textarea 
        {{$status ?? ''}} 
        name="{{ $name }}" 
        class="form__textarea" 
        rows="4" 
        placeholder="{{ $placeholder ?? '' }}"
    > {{ $value ?? '' }}</textarea>
</div>
