<?php

namespace App\Http\Livewire\Penghuni;

use Livewire\Component;
use App\Models\Category;
use App\Models\Penghuni;
use App\Traits\MasterData;
use Livewire\WithPagination;

class Listpenghuni extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paging, $search, $category_id, $durasi_pembayaran;

    protected $listeners = [
        'getListData' => 'render'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->paging = 25;
    }

    public function destroy($id)
    {
        try {
            Penghuni::find($id)->delete();

            $this->emit('pesanSukses', 'Success..');
        } catch (\Throwable $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function riwayat_tagihan($id)
    {
        $this->emit('idRiwayatTagihan', $id);
    }

    public function pindah_kamar($id)
    {
        $this->emit('PindahKamar', $id);
    }

    public function berhenti($id)
    {
        try {
            $dt = Penghuni::find($id)->update([
                'product_id' => null,
                'updated_by' => my_ids()
            ]);
            $this->emit('pesanSukses', 'Success..');
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $q = $this->search;
        $category_id = $this->category_id;
        $durasi_pembayaran = $this->durasi_pembayaran;
        $categories = Category::active()->orderBy('name')->get();
        $durasis = MasterData::durasiPembayaran();
        $statuses = MasterData::status_perkawinan();
        $pagings = MasterData::list_pagings();

        $data = Penghuni::with([
            'user',
            'product'
        ])
            ->kategoriProduk($category_id)
            ->durasiPembayaran($durasi_pembayaran)
            ->filter($q)
            ->latest()
            ->paginate($this->paging);

        return view('livewire.penghuni.listpenghuni', compact(
            'data',
            'statuses',
            'pagings',
            'categories',
            'durasis'
        ))
            ->layout('layouts.main', [
                'title' => 'Penghuni'
            ]);
    }
}
