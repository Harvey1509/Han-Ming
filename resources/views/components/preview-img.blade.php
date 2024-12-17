<div class="preview-image">
    <img class="popup-image" alt="Preview image">
</div>

<style>
    .preview-image {
        position: fixed;
        z-index: 1000;
        width: 100%;
        height: 100%;

        background-color: rgba(0, 0, 0, 0.8);
        display: none;
    }

    .preview-image--open {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .preview-image img {
        width: auto;
        height: 50%;
        object-fit: cover;
        border-radius: var(--border-radius-small-box);
    }
</style>

<script>
    const imageElements = document.querySelectorAll('.img-pw');

    const previewImageContainer = document.querySelector('.preview-image');
    const popupImage = document.querySelector('.popup-image');

    imageElements.forEach(image => {
        image.addEventListener('click', function() {
            const imageUrl = image.src;
            popupImage.src = imageUrl;
            previewImageContainer.classList.add('preview-image--open');
            document.body.classList.add('scroll-hidden');
        });
    });

    previewImageContainer.addEventListener('click', function(e) {
        if (e.target === previewImageContainer) {
            previewImageContainer.classList.remove('preview-image--open');
            document.body.classList.remove('scroll-hidden');
        }
    });
</script>