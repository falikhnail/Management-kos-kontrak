<?php

namespace App\Http\Livewire\Kasbank;

use Livewire\Component;
use App\Traits\MasterData;
use App\Traits\KasBankTrait;
use Illuminate\Support\Facades\DB;

class Createkasbank extends Component
{
    public $forms = [];
    public $id_edit;

    public function mount($id = null)
    {
        $this->id_edit = $id;
        $this->forms = KasBankTrait::firstForm($this->id_edit);
    }

    public function add_line()
    {
        $this->forms = KasBankTrait::newLine($this->forms);
    }

    public function delete_line($index)
    {
        $this->forms = KasBankTrait::destroyLine($this->forms, $index);
    }

    public function store()
    {
        if (!akses('create-kas')) {
            $this->emit('pesanGagal', 'Access Denied');
            return false;
        }

        $this->validate([
            'forms.type' => 'required',
            'forms.transaction_date' => 'required',
        ]);
        // dd($this->forms);
        try {
            DB::beginTransaction();
            //code...
            KasBankTrait::store($this->forms, $this->id_edit);

            $this->emit('pesanSukses', 'Success..');

            DB::commit();
            return redirect('kasbank/index');
        } catch (\Exception $th) {
            DB::rollBack();
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $types = MasterData::typesKasBank();

        $forms = $this->forms;

        return view('livewire.kasbank.createkasbank', compact(
            'types',
            'forms'
        ))
            ->layout('layouts.main', [
                'title' => 'Tambah Data'
            ]);
    }
}
