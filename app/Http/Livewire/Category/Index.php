<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use App\Traits\MasterData;
use Livewire\WithPagination;
use App\Traits\CategoryTrait;
use Modules\Roles\Entities\Role;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paging, $search;
    public $forms = [];

    public function mount()
    {
        $this->forms = CategoryTrait::firstForm();
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
            updateStatus(new Category(), $id, true);
            $this->emit('pesanSukses', 'Success..');
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function tambah_data()
    {
        $this->forms = CategoryTrait::firstForm();
        $this->emit('modalAdd', 'show');
    }

    public function edit_data($id)
    {
        $this->forms = CategoryTrait::firstForm();
        $this->forms = CategoryTrait::formEdit($id);
        $this->emit('modalAdd', 'show');
    }

    public function store()
    {
        $this->validate([
            'forms.code' => 'required',
            'forms.name' => 'required'
        ]);

        try {
            $data = CategoryTrait::storeData($this->forms);
            // dd($data);
            if ($data['success']) {
                $this->emit('pesanSukses', $data['message']);

                $this->emit('modalAdd', 'hide');
                $this->forms = CategoryTrait::firstForm();
            } else {
                $this->emit('pesanGagal', $data['message']);
            }
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function destroy($id)
    {
        try {
            Category::find($id)->delete();

            $this->emit('pesanSukses', 'Destroy SUccess..');
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $pagings = MasterData::list_pagings();
        $q = $this->search;
        $data = Category::latest()->filter($q)->paginate($this->paging);

        return view('livewire.category.index', compact(
            'data',
            'pagings'
        ))
            ->layout('layouts.main', [
                'title' => 'Categories'
            ]);
    }
}
