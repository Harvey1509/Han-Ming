@props([
    'icon_name' => null, 
    'class' => null,   
])
<span class="{{$class}} icon material-symbols-outlined">
    {{ $icon_name }}
</span>