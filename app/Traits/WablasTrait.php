<?php

namespace App\Traits;

use App\Models\Transaction;

trait WablasTrait
{
    public static function textSuccessPayment($id)
    {
        $dt = Transaction::find($id);

        $pesan = '';
        $pesan .= "Haloo.. \n\n";

        $pesan .= "Terima Kasih Sudah Melakukan Pembayaran..";

        $curl = curl_init();
        $token = env('WABLAS_TOKEN');
        $data = [
            'phone' => $dt->user->no_hp,
            'message' => $pesan,
            'isGroup' => 'true',
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  env('WABLAS_SERVER') . "/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function sendTextTagihan($id)
    {
        $dt = Transaction::find($id);

        $pesan = '';
        $pesan .= "Haloo.. Ada tagihan baru untuk kamu: \n\n";

        $pesan .= "No. Invoice: " . $dt->doc_no . "\n";
        $pesan .= "Nominal: " . moneyFormat($dt->final_total) . "\n";
        $pesan .= "Link pembayaran online : " . $dt->xendit_invoice_url . "\n\n";

        $pesan .= "Terima Kasih..";

        $curl = curl_init();
        $token = env('WABLAS_TOKEN');
        $data = [
            'phone' => $dt->user->no_hp,
            'message' => $pesan,
            'isGroup' => 'true',
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  env('WABLAS_SERVER') . "/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}
