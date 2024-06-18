<?php

namespace App\Http\Livewire\Penghuni;

use Livewire\Component;
use App\Traits\MasterData;
use App\Traits\PenghuniTrait;
use Illuminate\Support\Facades\DB;

class Createpenghuni extends Component
{
    public $forms = [];
    public $id_edit, $is_edit;

    protected $listeners = [
        'select_this_user',
        'selectProduct' => 'select_product'
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->forms = PenghuniTrait::firsFormCreate($id);
            $this->is_edit = 1;
            $this->id_edit = $id;
        } else {
            $this->forms = PenghuniTrait::firsFormCreate();
        }
    }

    public function updated($key, $value)
    {
        // dd($key);
    }

    public function modal_user()
    {
        $this->emit('show_modal_user', 'show');
    }

    public function modal_product()
    {
        $this->emit('modalProduct', 'show');
    }

    public function select_this_user($id)
    {
        // $this->forms = $data;
        $this->forms = PenghuniTrait::select_user($id, $this->forms);
    }

    public function select_product($id)
    {
        $this->forms = PenghuniTrait::select_product($id, $this->forms);
        $this->emit('modalProduct', 'hide');
        $this->emit('refreshProduct');
    }

    public function create_user()
    {
        $this->emit('modalUser', 'hide');
        $this->emit('modalCreateUser', 'show');
    }

    public function store()
    {
        $this->validate([
            'forms.user_id' => 'required',
            'forms.name' => 'required',
            'forms.no_ktp' => 'required',
            'forms.no_hp' => 'required',
            'forms.tanggal_lahir' => 'required',
            'forms.status_perkawinan' => 'required',
            'forms.product_id' => 'required',
            'forms.tanggal_masuk' => 'required',
            'forms.nominal' => 'required',
            'forms.tanggal_pembayaran' => 'required',
            'forms.status_pembayaran' => 'required',
        ]);
        try {
            DB::beginTransaction();

            PenghuniTrait::storeForm($this->forms, $this->id_edit);

            DB::commit();

            $this->emit('pesanSukses', 'Success..');
            $this->forms = PenghuniTrait::firsFormCreate();
            $this->reset(['is_edit', 'id_edit']);

            return redirect('penghuni/index');
        } catch (\Exception $th) {
            DB::rollBack();
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $statuses = MasterData::status_perkawinan();
        $status_pembayarans = MasterData::status_pembayaran();

        return view('livewire.penghuni.createpenghuni', compact(
            'statuses',
            'status_pembayarans'
        ))
            ->layout('layouts.main', [
                'title' => 'Tambah/Edit Penghuni'
            ]);
    }
}
