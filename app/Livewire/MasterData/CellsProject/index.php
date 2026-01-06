<?php

namespace App\Livewire\MasterData\CellsProject;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Cells Project')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.master-data.cells-project.index');
    }
}   