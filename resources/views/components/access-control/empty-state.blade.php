{{-- Empty State Component --}}
@props([
    'colspan' => 1,
    'icon' => 'ti-mood-empty',
    'message' => 'Tidak ada data ditemukan',
])

<tr>
    <td colspan="{{ $colspan }}" class="text-center py-4">
        <div class="d-flex flex-column align-items-center">
            <i class="ti {{ $icon }} ti-3x text-muted mb-2"></i>
            <span class="text-muted">{{ $message }}</span>
        </div>
    </td>
</tr>
