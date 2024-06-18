<?php

namespace App\Http\Livewire\Penghuni;

use App\Models\User;
use Livewire\Component;
use App\Traits\MasterData;
use Livewire\WithPagination;
use App\Traits\PenghuniTrait;

class Modalusers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $paging;

    protected $listeners = [
        'show_modal_user'
    ];

    public function mount()
    {
        $this->paging = 25;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function show_modal_user($str)
    {
        $this->emit('modalUser', $str);
    }

    public function select_user($id)
    {
        // $data = PenghuniTrait::select_user($id);
        $this->emit('select_this_user', $id);

        $this->emit('modalUser', 'hide');
    }

    public function create_user()
    {
        $this->emit('modalUser', 'hide');
        $this->emit('modalCreateUser', 'show');
    }

    public function render()
    {
        $q = $this->search;
        $data = User::active()
            ->belumMenyewa()
            ->filter($q)
            ->latest()
            ->paginate($this->paging);
        $pagings = MasterData::list_pagings();

        return view('livewire.penghuni.modalusers', compact(
            'data',
            'pagings'
        ));
    }
}
