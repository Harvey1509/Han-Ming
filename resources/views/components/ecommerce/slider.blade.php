<section class="slider" style="height: 450px;" id="slider">
    <div class="slider__images">
        @foreach ($imagenes_slider as $index => $imagen)
            <img src="{{ $imagen->url_imagen }}" class="slider__image" data-slide="{{ $index + 1 }}" />
        @endforeach
    </div>
    <div class="slider__navigation-buttons">
        @foreach ($imagenes_slider as $index => $imagen)
            <button
            class="slider__nav-button @if($index == 0) slider__nav-button--active @endif"
            data-slide-target="{{ $index + 1 }}"></button>
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

        // Cambiar la visibilidad de los slides con animación
        const showSlide = (slide) => {
            currentSlide = slide;

            // Actualizar visibilidad de las imágenes con animación
            images.forEach((image, index) => {
                if (index === currentSlide - 1) {
                    image.style.opacity = '1';
                    image.style.zIndex = '1'; // Aseguramos que esté encima
                } else {
                    image.style.opacity = '0';
                    image.style.zIndex = '0';
                }
            });

            // Actualizar estado de botones
            buttons.forEach((button, index) => {
                button.classList.toggle('slider__nav-button--active', index === currentSlide - 1);
            });
        };

        // Mover al siguiente slide automáticamente
        const autoSlide = () => {
            clearInterval(autoSlideInterval); // Evitar múltiples intervalos
            autoSlideInterval = setInterval(() => {
                const nextSlide = currentSlide === totalSlides ? 1 : currentSlide + 1;
                showSlide(nextSlide);
            }, 3000);
        };

        // Configurar botones de navegación
        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const targetSlide = parseInt(button.dataset.slideTarget);
                showSlide(targetSlide);
                autoSlide(); // Reiniciar el temporizador
            });
        });

        // Configuración inicial
        showSlide(currentSlide);
        autoSlide(); // Iniciar el desplazamiento automático
    });
</script>