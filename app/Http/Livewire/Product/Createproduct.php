<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Traits\MasterData;
use App\Traits\ProductTrait;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Createproduct extends Component
{
    use WithFileUploads;

    public $category_id,
        $name, $price, $durasi_pembayaran,
        $photo, $note, $address, $no_rumah,
        $is_edit, $id_edit;

    protected $listeners = [
        'modal_add',
        'editData' => 'edit_data'
    ];

    public function modal_add($str)
    {
        $this->emit('modalAdd', $str);
    }

    public function edit_data($id)
    {
        $dt = Product::find($id);
        $this->is_edit = 1;
        $this->id_edit = $id;

        $this->category_id = $dt->category_id;
        $this->name = $dt->name;
        $this->price = $dt->price;
        $this->durasi_pembayaran = $dt->durasi_pembayaran;
        $this->note = $dt->note;
        $this->address = $dt->address;
        $this->no_rumah = $dt->no_rumah;

        $this->emit('modalAdd', 'show');
    }

    public function store()
    {
        $data = $this->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'durasi_pembayaran' => 'required',
            // 'photo' => 'image'
        ]);

        try {
            $data['note'] = $this->note;
            $data['address'] = $this->address;
            $data['no_rumah'] = $this->no_rumah;

            if ($this->photo) {
                // $pathnya = $this->photo->resize(300, null, function ($constraint) {
                //     $constraint->aspectRatio();
                // })->store('public/photos');

                $image = $this->photo;
                $input['file'] = time() . '.' . $image->getClientOriginalExtension();
                // dd($input);
                $destinationPath = public_path('/photo_kontrakan');
                $imgFile = Image::make($image->getRealPath());
                $imgFile->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('photo_kontrakan/' . $input['file']);
                $destinationPath = 'photo_kontrakan/' . $input['file'];
                // $image->move($destinationPath, $input['file']);

                $data['photo'] = $destinationPath;
            }

            // dd($data);
            ProductTrait::store($data, $this->id_edit);

            $this->emit('pesanSukses', 'Success..');
            $this->emit('modalAdd', 'hide');
            $this->reset();

            $this->emit('getData');
        } catch (\Throwable $th) {
            //throw $th;
            $pesan = MasterData::pesan_gagal($th);

            $this->emit('pesanGagal', $pesan);
        }
    }

    public function render()
    {
        $categories = Category::active()->orderBy('name')->get();
        $durasis = MasterData::durasiPembayaran();

        return view('livewire.product.createproduct', compact(
            'categories',
            'durasis'
        ));
    }
}
