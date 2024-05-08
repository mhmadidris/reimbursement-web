@if ($totalPages > 1)
    <div class="mt-5 d-flex flex-row justify-content-center gap-3 d-md-flex d-none">
        @for ($i = 1; $i <= $totalPages; $i++)
            <button
                class="btn btn-sm text-white rounded-circle fw-bold btn-paginate {{ $i == $currentPage ? 'active-btn-paginate' : 'non-active-btn-paginate' }}"
                wire:click="changePage({{ $i }})">{{ $i }}</button>
        @endfor
    </div>
@endif
