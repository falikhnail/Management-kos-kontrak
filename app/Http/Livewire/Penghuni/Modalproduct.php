<?php

namespace App\Http\Livewire\Penghuni;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Traits\MasterData;
use Livewire\WithPagination;

class Modalproduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $category_id, $durasi_pembayaran, $paging;

    protected $listeners = [
        'refreshProduct' => 'render'
    ];

    public function mount()
    {
        $this->paging = 10;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function select_product($id)
    {
        $this->emit('selectProduct', $id);
    }

    public function render()
    {
        $q = $this->search;
        $category_id = $this->category_id;
        $durasi_pembayaran = $this->durasi_pembayaran;

        $data = Product::active()
            ->masihKosong()
            ->kategori($category_id)
            ->durasiPembayaran($durasi_pembayaran)
            ->filter($q)
            ->paginate($this->paging);

        $pagings = MasterData::list_pagings();
        $categories = Category::active()->orderBy('name')->get();
        $durasis = MasterData::durasiPembayaran();

        return view('livewire.penghuni.modalproduct', compact(
            'data',
            'pagings',
            'categories',
            'durasis'
        ));
    }
}
