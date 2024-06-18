<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use App\Traits\MasterData;
use Livewire\WithPagination;

class Listproduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paging, $search, $category_id, $durasi_pembayaran;

    protected $listeners = [
        'getData' => 'render'
    ];

    public function mount()
    {
        $this->paging = 25;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function update_status($id)
    {
        //
        try {
            updateStatus(new Product, $id, true);
            $this->emit('pesanSukses', 'Success..');
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function destroy($id)
    {
        try {
            $dt = Product::find($id);
            if ($dt->photo) {
                unlink($dt->photo);
            }
            $dt->delete();

            $this->emit('pesanSukses', 'Success..');
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function tambah_data()
    {
        // $this->emit('modalAdd', 'show');
        $this->emit('modal_add', 'show');
    }

    public function edit_data($id)
    {
        $this->emit('editData', $id);
    }

    public function render()
    {
        $q = $this->search;
        $category_id = $this->category_id;
        $durasi_pembayaran = $this->durasi_pembayaran;

        $data = Product::kategori($category_id)
            ->durasiPembayaran($durasi_pembayaran)
            ->filter($q)
            ->paginate($this->paging);

        $pagings = MasterData::list_pagings();
        $categories = Category::active()->orderBy('name')->get();
        $durasis = MasterData::durasiPembayaran();

        return view('livewire.product.listproduct', compact(
            'data',
            'pagings',
            'categories',
            'durasis'
        ))
            ->layout('layouts.main', [
                'title' => 'Data Kontrakan'
            ]);
    }
}
