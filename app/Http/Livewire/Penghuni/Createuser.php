<?php

namespace App\Http\Livewire\Penghuni;

use Livewire\Component;
use App\Traits\MasterData;
use Modules\Roles\Entities\Role;
use Modules\Users\Http\Traits\UserTrait;

class Createuser extends Component
{
    public $forms = [], $is_edit, $id_edit;

    public function mount()
    {
        $this->forms = UserTrait::firstForm();
    }

    public function store()
    {
        $this->validate([
            'forms.name' => 'required',
            'forms.email' => 'required',
            'forms.no_hp' => 'required',
            'forms.role_id' => 'required',
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
                    UserTrait::store_data($this->forms, $this->id_edit);
                } else {
                    UserTrait::store_data($this->forms);
                }

                $this->emit('getDataUsers');
                $this->emit('modalCreateUser', 'hide');

                $this->forms = UserTrait::firstForm();
                $this->emit('pesanSukses', 'Store Success..');
                $this->reset(['is_edit', 'id_edit']);
            }
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $roles = Role::active()->get();
        $statuses = MasterData::status_perkawinan();

        return view('livewire.penghuni.createuser', compact(
            'roles',
            'statuses'
        ));
    }
}
