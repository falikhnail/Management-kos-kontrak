<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Traits\MasterData;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\DB;
use App\Traits\GeneralSettingTrait;

class Generalsettings extends Component
{
    public $forms = [];

    public function mount()
    {
        $this->forms = GeneralSettingTrait::firstForm();
    }

    public function save_fee_admin()
    {
        $this->validate([
            'forms.fee_admin' => 'required'
        ]);

        try {
            $store = GeneralSettingTrait::saveFeeAdmin($this->forms['fee_admin']);
            if ($store['success']) {
                $this->emit('pesanSukses', $store['message']);
            } else {
                $this->emit('pesanGagal', $store['message']);
            }
        } catch (\Exception $th) {
            $pesan = MasterData::pesan_gagal($th);
            //throw $th;
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function change_password()
    {
        $this->validate([
            'forms.password' => 'required',
            'forms.password_confirmation' => 'required'
        ]);

        try {
            DB::beginTransaction();
            //code...
            $proses = GeneralSettingTrait::changePassword($this->forms);

            if ($proses['success']) {
                $this->emit('pesanSukses', $proses['message']);
            } else {
                $this->emit('pesanGagal', $proses['message']);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $gs = GeneralSettingTrait::firstData();

        return view('livewire.settings.generalsettings', compact(
            'gs'
        ))
            ->layout('layouts.main', [
                'title' => 'General Settings'
            ]);
    }
}
