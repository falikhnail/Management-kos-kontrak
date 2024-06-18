<?php

namespace App\Http\Livewire\Tagihan;

use Livewire\Component;
use App\Traits\MasterData;
use App\Models\Transaction;
use App\Traits\TagihanTrait;
use Livewire\WithPagination;

class Listtagihan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $filters = [];
    public $paging, $search;

    protected $listeners = [
        'getData' => 'render'
    ];

    public function mount()
    {
        $this->paging = 25;
        $this->filters = [
            'status' => '',
            'dari' => date('Y-m-d'),
            'sampai' => date('Y-m-d')
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function tambah_data()
    {
        $this->emit('createTagihan');
    }

    public function edit_data($id)
    {
        $this->emit('editTagihan', $id);
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
        $q = $this->search;
        $pagings = MasterData::list_pagings();
        $payment_status = MasterData::status_pembayaran();

        $data = TagihanTrait::getData($this->filters, $q, $this->paging);
        // dd($total_amount);

        return view('livewire.tagihan.listtagihan', compact(
            'pagings',
            'data',
            'payment_status'
        ))
            ->layout('layouts.main', [
                'title' => 'List Semua Tagihan'
            ]);
    }
}
