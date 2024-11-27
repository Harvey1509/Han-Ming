@props([
'title' => 'Acordeón',
])

<div {{ $attributes->merge(['class' => 'accordion__wrapper']) }}>
    <div class="accordion__header" role="button" aria-expanded="true">
        <p>{{ $title }}</p>
        <x-icon icon_name="keyboard_arrow_down" class="accordion__icon" />
    </div>
    <div class="accordion__content hidden">
        {{ $slot }}
    </div>
</div>


<style>
    .accordion__wrapper {
        border-bottom: 1px solid var(--neutral-c300);
        transition: all 0.3s ease-in-out;
    }
    
    .accordion__header {
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .accordion__header:hover {
        background-color: var(--neutral-c100);
    }

    .accordion__icon {
        transition: transform 0.3s ease-in-out;
    }

    .accordion__header[aria-expanded="true"] .accordion__icon {
        transform: rotate(180deg);
    }

    .accordion__content {
        display: none;
        padding: 10px;
        font-size: var(--small-text-font-size);
        color: var(--neutral-c800);
    }

    .accordion__content:not(.hidden) {
        display: block;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.accordion__header').forEach(header => {
            header.addEventListener('click', () => {
                const accordionWrapper = header.closest('.accordion__wrapper');
                const content = accordionWrapper.querySelector('.accordion__content');

                const isExpanded = header.getAttribute('aria-expanded') === 'true';

                // Alternar el estado del acordeón
                header.setAttribute('aria-expanded', !isExpanded);
                content.classList.toggle('hidden');
            });
        });
    });
</script>