{{-- Page Header Component --}}
@props([
    'title',
    'breadcrumbs' => [],
])

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <div class="d-flex flex-column justify-content-center">
        <h1 class="mb-1 fw-bold">{{ $title }}</h1>
        @if(count($breadcrumbs) > 0)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    @foreach($breadcrumbs as $item)
                        @if(isset($item['active']) && $item['active'])
                            <li class="breadcrumb-item active">{{ $item['label'] }}</li>
                        @elseif(isset($item['route']))
                            <li class="breadcrumb-item">
                                <a href="{{ route($item['route']) }}" wire:navigate>{{ $item['label'] }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                <span>{{ $item['label'] }}</span>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif
    </div>
    @if($slot->isNotEmpty())
        <div class="d-flex align-content-center flex-wrap gap-2">
            {{ $slot }}
        </div>
    @endif
</div>
