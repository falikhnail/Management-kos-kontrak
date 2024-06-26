<?php

namespace Modules\Users\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use App\Traits\MasterData;
use Livewire\WithPagination;
use Modules\Roles\Entities\Role;
use Modules\Users\Http\Traits\UserTrait;
use Modules\Roles\Http\Traits\PermissionTrait;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paging, $search;
    public $forms = [];
    public $id_edit, $is_edit;

    public function mount()
    {
        $this->paging = 25;
        $this->forms = UserTrait::firstForm();
        // dd($this->forms);

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($key, $val)
    {
        // dd($key . ' | ' . $val);
        // dd($this->forms);
    }

    public function update_status($id)
    {
        try {
            $dt = User::find($id);

            if ($dt->is_paten == 1) {
                $this->emit('pesanGagal', 'Sorry, this user can not edited..');
            } else {
                updateStatus(new User, $id);

                $this->emit('pesanSukses', 'Sucess..');
            }
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function tambah_data()
    {
        $this->reset(['is_edit', 'id_edit']);
        $this->forms = UserTrait::firstForm();
        $this->emit('modalAdd', 'show');
    }

    public function edit_data($id)
    {
        $this->is_edit = 1;
        $this->id_edit = $id;

        $this->forms = UserTrait::find_data($id);

        $this->emit('modalAdd', 'show');
    }

    public function store()
    {
        $this->validate([
            'forms.name' => 'required',
            'forms.email' => 'required',
            'forms.no_hp' => 'required',
            'forms.role_id' => 'required',
            'forms.tanggal_lahir' => 'required',
        ]);
        try {

            // dd($this->forms);
            if ($this->id_edit) {
                $validasi = UserTrait::store_validation($this->forms, $this->id_edit);
            } else {
                $validasi = UserTrait::store_validation($this->forms);
            }
            // dd($validasi);
            if (!$validasi['success']) {
                $this->emit('pesanGagal', $validasi['message']);
            } else {
                if ($this->id_edit) {
                    $ut = UserTrait::store_data($this->forms, $this->id_edit);
                } else {
                    $ut = UserTrait::store_data($this->forms);
                }

                if ($ut['success']) {
                    $this->emit('modalAdd', 'hide');

                    $this->forms = UserTrait::firstForm();
                    $this->emit('pesanSukses', $ut['message']);
                    $this->reset(['is_edit', 'id_edit']);
                } else {
                    $this->emit('pesanGagal', $ut['message']);
                }
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
            UserTrait::destroy($id);
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
        $data = User::filter($q)->latest()->paginate($this->paging);
        $pagings = MasterData::list_pagings();
        $roles = Role::active()->get();
        $statuses = MasterData::status_perkawinan();

        return view('users::livewire.users.index', compact(
            'data',
            'pagings',
            'roles',
            'statuses'
        ))
            ->layout('layouts.main', [
                'title' => 'Manage Users'
            ]);
    }
}
