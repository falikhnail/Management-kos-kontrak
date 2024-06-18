<?php

namespace App\Http\Livewire\Penghuni;

use Livewire\Component;
use App\Models\Penghuni;
use App\Traits\MasterData;
use App\Models\Transaction;
use Livewire\WithPagination;

class Riwayattagihan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $paging, $penghuni_id;

    protected $listeners = [
        'idRiwayatTagihan'
    ];

    public function mount()
    {
        $this->paging = 10;
    }

    public function idRiwayatTagihan($id)
    {
        $this->penghuni_id = $id;
        $this->emit('modalRiwayatTagihan', 'show');
    }

    public function updated($key, $val)
    {
        // dd($key);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroy($id)
    {
        try {
            Transaction::find($id)->delete();

            $this->emit('pesanSukses', 'Success..');
        } catch (\Throwable $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $pagings = MasterData::list_pagings();

        if ($this->penghuni_id) {
            $ts = Penghuni::find($this->penghuni_id);
            // dd($this->penghuni_id);
            $data = Transaction::where('user_id', $ts->user_id)->where('product_id', $ts->product_id)->orderBy('transaction_date', 'desc')->paginate($this->paging);
        } else {
            $data = [];
        }

        return view('livewire.penghuni.riwayattagihan', compact(
            'pagings',
            'data'
        ));
    }
}
