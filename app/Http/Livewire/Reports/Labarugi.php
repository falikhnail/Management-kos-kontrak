<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use App\Traits\LabaRugiTrait;

class Labarugi extends Component
{
    public $dari, $sampai;

    public function mount()
    {
        $this->dari = date_default(null, false);
        $this->sampai = date_default(null, false);
    }

    public function render()
    {
        $data = LabaRugiTrait::hitungTotal($this->dari, $this->sampai);
        // dd($data);
        return view('livewire.reports.labarugi', compact(
            'data'
        ))
            ->layout('layouts.main', [
                'title' => 'Laba Rugi'
            ]);
    }
}
