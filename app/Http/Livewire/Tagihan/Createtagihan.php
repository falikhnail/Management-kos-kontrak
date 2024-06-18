<?php

namespace App\Http\Livewire\Tagihan;

use Xendit\Xendit;
use Livewire\Component;
use App\Models\Penghuni;
use App\Traits\MasterData;
use App\Traits\XenditTrait;
use App\Traits\TagihanTrait;
use Illuminate\Support\Facades\DB;

class Createtagihan extends Component
{
    public $forms = [];
    public $search_penghuni;
    public $id_edit;

    protected $listeners = [
        'editTagihan' => 'edit_tagihan',
        'createTagihan' => 'create_tagihan'
    ];

    public function mount()
    {
        $this->forms = TagihanTrait::firstForm();
    }

    public function select_penghuni($id)
    {
        $this->forms = TagihanTrait::firstForm($id, $this->forms);
        $this->reset(['search_penghuni']);
    }

    public function create_tagihan()
    {
        $this->forms = TagihanTrait::firstForm();
        $this->emit('modalCreateTagihan', 'show');
    }

    public function edit_tagihan($id)
    {
        $this->id_edit = $id;

        $this->forms = TagihanTrait::firstForm(null, null, $id);

        $this->emit('modalCreateTagihan', 'show');
    }

    public function store()
    {
        $this->validate([
            'forms.*' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $id_trans = TagihanTrait::store($this->forms, $this->id_edit);

            XenditTrait::genInvoice($this->forms, $id_trans);

            // Xendit::setApiKey(secretKeyXendit());

            $this->emit('getData');
            $this->emit('modalCreateTagihan', 'hide');
            $this->emit('pesanSukses', 'Success..');
            $this->reset(['id_edit']);

            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $status_pembayarans = MasterData::status_pembayaran();
        $penghunis = Penghuni::with([
            'user',
            'product'
        ])->whereHas('user', function ($e) {
            $e->active()->belumMenyewa();
        })->limit(15)->get();

        $hasil_search_penghuni = Penghuni::with([
            'user',
            'product'
        ])->whereNotNull('product_id')->filter($this->search_penghuni)->limit(25)->get();

        return view('livewire.tagihan.createtagihan', compact(
            'status_pembayarans',
            'penghunis',
            'hasil_search_penghuni'
        ));
    }
}
