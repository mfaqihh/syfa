<?php

namespace App\Livewire\MasterData\DebiturDanInvestor;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Debitur Dan Investor')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.master-data.debitur-dan-investor.index');
    }
}
