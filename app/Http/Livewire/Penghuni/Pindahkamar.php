<?php

namespace App\Http\Livewire\Penghuni;

use App\Models\Product;
use Livewire\Component;
use App\Models\Penghuni;
use App\Traits\MasterData;

class Pindahkamar extends Component
{
    public $penghuni_id, $user_id, $search, $new_product_id, $pd_name;

    protected $listeners = [
        'PindahKamar' => 'pindah_kamar'
    ];

    public function pindah_kamar($id)
    {
        $dt = Penghuni::find($id);
        $this->penghuni_id = $id;
        $this->user_id = $dt->user_id;

        $this->emit('modalPindahKamar', 'show');
    }

    public function select_kamar($id)
    {
        $this->new_product_id = $id;
        $dt = Product::find($id);
        $this->pd_name = $dt->name;
        $this->reset(['search']);
    }

    public function store()
    {
        $this->validate([
            'pd_name' => 'required'
        ]);

        try {
            //code...
            Penghuni::find($this->penghuni_id)->update([
                'product_id' => $this->new_product_id,
                'updated_by' => my_ids()
            ]);
            $this->emit('getListData');
            $this->emit('modalPindahKamar', 'hide');
            $this->reset();
            $this->emit('pesanSukses', 'Berhasil pindah kamar..');
        } catch (\Exception $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);
            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $q = $this->search;
        $dt = Penghuni::find($this->penghuni_id);
        $hasil_pencarian = Product::active()
            ->masihKosong()
            ->filter($q)
            ->limit(15)
            ->get();

        return view('livewire.penghuni.pindahkamar', compact(
            'dt',
            'hasil_pencarian'
        ));
    }
}
