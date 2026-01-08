{{-- Pagination Component --}}
@props([
    'paginator',
])

@if($paginator->hasPages())
    <div class="card-footer d-flex justify-content-end">
        {{ $paginator->links() }}
    </div>
@endif
