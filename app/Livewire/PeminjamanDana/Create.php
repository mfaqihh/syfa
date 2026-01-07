<?php

namespace App\Livewire\PeminjamanDana;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title('Peminjaman Dana - Tambah Data')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.peminjaman-dana.create');
    }
}