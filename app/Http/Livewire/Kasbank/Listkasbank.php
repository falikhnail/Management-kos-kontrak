<?php

namespace App\Http\Livewire\Kasbank;

use Livewire\Component;
use App\Traits\MasterData;
use App\Traits\KasBankTrait;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Listkasbank extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $filters = [], $search, $details = [];

    public function mount()
    {
        $this->filters = KasBankTrait::firstFilter();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function view($id)
    {
        $this->details = KasBankTrait::viewDetail($id);
        $this->emit('modalDetail', 'show');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            KasBankTrait::destroy($id);

            DB::commit();

            $this->emit('pesanSukses', 'Success..');
        } catch (\Exception $th) {
            DB::rollBack();
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        // $q = $this->filters['search'];
        $this->filters['search'] = $this->search;

        $data = KasBankTrait::getData($this->filters);

        $pagings = MasterData::list_pagings();
        $types = MasterData::typesKasBank();
        // dd($data);

        return view('livewire.kasbank.listkasbank', compact(
            'data',
            'pagings',
            'types'
        ))
            ->layout('layouts.main', [
                'title' => 'List Kas'
            ]);
    }
}
