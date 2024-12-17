@props([
    'height' => '300px',
    'imagenes_slider' => [],
])

<section class="slider" style="height: {{ $height }}" id="slider">
    <div class="slider__images">
        @foreach ($imagenes_slider as $index => $imagen)
            <img src="{{ is_array($imagen) ? $imagen['url_imagen'] : $imagen->url_imagen }}" class="slider__image" data-slide="{{ $index + 1 }}" />
        @endforeach
    </div>
    <div class="slider__navigation-buttons">
        @foreach ($imagenes_slider as $index => $imagen)
            <button class="slider__nav-button @if($index == 0) slider__nav-button--active @endif" data-slide-target="{{ $index + 1 }}"></button>
        @endforeach
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slider = document.getElementById('slider');
        const images = slider.querySelectorAll('.slider__image');
        const buttons = slider.querySelectorAll('.slider__nav-button');
        const totalSlides = images.length;
        let currentSlide = 1;
        let autoSlideInterval;

        const showSlide = (slide) => {
            currentSlide = slide;

            images.forEach((image, index) => {
                if (index === currentSlide - 1) {
                    image.style.opacity = '1';
                    image.style.zIndex = '1';
                } else {
                    image.style.opacity = '0';
                    image.style.zIndex = '0';
                }
            });

            buttons.forEach((button, index) => {
                button.classList.toggle('slider__nav-button--active', index === currentSlide - 1);
            });
        };

        const autoSlide = () => {
            clearInterval(autoSlideInterval); 
            autoSlideInterval = setInterval(() => {
                const nextSlide = currentSlide === totalSlides ? 1 : currentSlide + 1;
                showSlide(nextSlide);
            }, 3000);
        };

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const targetSlide = parseInt(button.dataset.slideTarget);
                showSlide(targetSlide);
                autoSlide(); 
            });
        });

        showSlide(currentSlide);
        autoSlide();
    });
</script>