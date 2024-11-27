@props([
    'isDropdown' => false,
    'icon_left' => null,
    'text_button' => null,
    'options' => [],
])

<li class="sidebar__option">
    @if($isDropdown)
        <button class="sidebar__button">
            <x-icon icon_name="{{ $icon_left }}"></x-icon>
            {{ $text_button }}
            <x-icon class="dropdown__icon" icon_name="keyboard_arrow_down"></x-icon>
        </button>
        <div class="sidebar__dropdown-content">  
            @if(!empty($options))
                @foreach ($options as $option)
                    <a class="sidebar__button" href="/">
                        <span class="icon__empty"></span>
                        {{ $option['text_option'] }}
                    </a>
                @endforeach
            @else
                <span>No se envió una lista de opciones</span>
            @endif
        </div>
    @else
        <a class="sidebar__button" href="#">
            <x-icon  icon_name="{{ $icon_left }}" />
            {{ $text_button }}
        </a>
    @endif
</li>

