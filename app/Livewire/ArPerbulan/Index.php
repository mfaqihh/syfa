<?php

namespace App\Livewire\ArPerbulan;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title('Ar Perbulan')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.ar-perbulan.index');
    }
}