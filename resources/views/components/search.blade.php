@props([
'icon_left' => null,
'icon_right' => null,
'placeholder' => '',
'status' => null,
'id' => null,
])

<div {{ $attributes->merge(['class' => "search__wrapper"]) }}>
    <div class="search__box {{ $status ? 'search__box--' . $status : '' }} {{ $icon_left ? 'search__box--icon-left' : '' }} {{ $icon_right ? 'search__box--icon-right' : '' }}">
        @if ($icon_left)
        <x-icon class="search__icon" icon_name="search" />
        @endif

        <input
            @if($id) id="{{ $id }}" @endif
            class="search"
            type="text"
            placeholder="{{ $placeholder }}"
            value="{{ request('search') }}"
            oninput="handleSearch(event)">


        @if ($icon_right)
        <x-icon class="search__icon" icon_name="search" />
        @endif
    </div>
</div>


<style>
    .search__wrapper {
        width: 100%;
    }

    .search__box {
        --search-main-color: var(--primary-c500);
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid var(--search-main-color);
        border-radius: 5px;
        height: 40px;
        padding: 0 10px;
    }

    .search__box--disabled {
        --search-main-color: var(--neutral-c300);
        pointer-events: none;
        background-color: var(--neutral-c50);
    }

    .search__box:has(.search:focus) {
        --search-main-color: var(--primary-c600);
    }

    .search__icon {
        font-size: 2rem;
        color: var(--search-main-color);
    }

    .search {
        flex: 1;
        border: none;
        background-color: transparent;
        color: var(--search-main-color);
        outline: none;
    }

    .search::placeholder {
        color: var(--search-main-color);
    }

    .search__box--icon-left {
        justify-content: flex-start;
    }

    .search__box--icon-right {
        justify-content: space-between;
    }
</style>