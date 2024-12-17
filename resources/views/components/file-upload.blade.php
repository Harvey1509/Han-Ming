<div class="form__inputbox">
    <label class="form__label">{{ $label }}</label>
    <img id="imagePreview" class="form__image-preview" @if (isset($src)) src="{{ asset("storage/{$src}")}}" @endif />
    <input name="{{ $name }}" type="file" id="fileInput" class="form__file-input" accept="image/*">
    <button type="button" id="uploadButton" class="form__upload-button">Subir archivo</button>
</div>
@push('scripts')
    <script>
        const fileInput = document.getElementById("fileInput");
        const uploadButton = document.getElementById("uploadButton");
        const imagePreview = document.getElementById("imagePreview");

        uploadButton.addEventListener("click", () => {
            fileInput.click();
        });

        fileInput.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = "none";
            }
        });
    </script>
@endpush