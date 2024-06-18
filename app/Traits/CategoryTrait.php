<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

trait CategoryTrait
{
    public static function firstForm()
    {
        return [
            'code' => '',
            'name' => '',
            'is_edit' => '',
            'id_edit' => ''
        ];
    }

    public static function formEdit($id)
    {
        $dt = Category::find($id);

        return [
            'code' => $dt->code,
            'name' => $dt->name,
            'is_edit' => 1,
            'id_edit' => $id
        ];
    }

    public static function storeData($data)
    {
        if ($data['is_edit']) {
            $cek = Category::where('id', '!=', $data['id_edit'])->where('code', $data['code'])->exists();
            if ($cek) {
                return MasterData::hasilReturn(false, 'Duplicat code..');
            }

            $cek = Category::where('id', '!=', $data['id_edit'])->where('name', $data['name'])->exists();
            if ($cek) {
                return MasterData::hasilReturn(false, 'Duplicat name..');
            }

            $data['updated_by'] = Auth::id();
            Category::find($data['id_edit'])->update($data);

            return MasterData::hasilReturn(true, 'Update Success..');
        } else {
            $cek = Category::where('code', $data['code'])->exists();
            if ($cek) {
                return MasterData::hasilReturn(false, 'Duplicat code..');
            }

            $cek = Category::where('name', $data['name'])->exists();
            if ($cek) {
                return MasterData::hasilReturn(false, 'Duplicat name..');
            }

            $data['created_by'] = Auth::id();
            $data['updated_by'] = Auth::id();
            Category::create($data);

            return MasterData::hasilReturn(true, 'Success..');
        }
    }
}
