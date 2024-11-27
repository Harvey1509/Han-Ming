<table class="main-content__table">
    <thead class="main-content__thead">
        <tr>
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="main-content__tbody">
        {{ $slot }}
    </tbody>
</table>
