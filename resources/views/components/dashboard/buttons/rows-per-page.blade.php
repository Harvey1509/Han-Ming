<div class="dropdown">
    <div class="dropdown__toggle">
        <small id="dropdownValue">{{$rowsPerPage}}</small>
        <span class="material-symbols-outlined">expand_more</span>
    </div>
    <div class="dropdown__menu">
        @foreach ([10, 20, 30, 40, 50] as $value)
            <button class="dropdown__item" data-value="{{ $value }}">{{ $value }}</button>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownItems = document.querySelectorAll('.dropdown__item');
        const dropdownValue = document.getElementById('dropdownValue');

        dropdownItems.forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                dropdownValue.textContent = this.getAttribute('data-value');
                
                const rowsPerPage = this.getAttribute('data-value');
                window.location.href = `?rows=${rowsPerPage}`;
            });
        });
    });
</script>
