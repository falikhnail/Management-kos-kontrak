<?php

namespace App\Models;

trait _ProductAsesors
{
    public function getPhotoPathAttribute()
    {
        $photo = $this->photo;

        // if ($photo) {
        //     $photo = str_replace('public/', '', $photo);
        //     return $photo;
        // } else {
        //     return 'photos/default.png';
        // }
        if ($photo) {
            return $photo;
        } else {
            return 'http://sangcahaya.id/wp-content/uploads/2021/08/cropped-512-x-512-No-Background.png';
        }
    }

    public function getHargaAttribute()
    {
        $price = $this->price;
        $price = moneyFormat($price) . '/' . $this->durasi_pembayaran;
        return $price;
    }
}
