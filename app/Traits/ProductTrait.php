<?php

namespace App\Traits;

use App\Models\Product;

trait ProductTrait
{
    public static function store($data, $id_edit = null)
    {
        if ($id_edit) {
            // $data['created_by'] = my_ids();
            $dt = Product::find($id_edit);

            $data['updated_by'] = my_ids();

            if (isset($data['photo'])) {
                unlink($dt->photo);
            }

            $data = Product::find($id_edit)->update($data);
        } else {
            $data['created_by'] = my_ids();
            $data['updated_by'] = my_ids();

            $data = Product::create($data);
        }

        return $data;
    }
}
