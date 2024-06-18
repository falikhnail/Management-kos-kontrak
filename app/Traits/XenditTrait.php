<?php

namespace App\Traits;

use Xendit\Xendit;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;

trait XenditTrait
{
    public static function genInvoice($data, $id_trans = null)
    {
        $trans = Transaction::find($id_trans);
        // dd($data);
        $us = User::find($data['user_id']);
        $pd = Product::find($data['product_id']);

        Xendit::setApiKey(secretKeyXendit());

        $params = [
            'external_id' => 'INV-' . $id_trans,
            'payer_email' => $us->email,
            'description' => 'Invoice-' . $id_trans,
            'amount' => $trans->final_total,
            'success_redirect_url' => url('success-invoice/' . $id_trans)
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        // dd($createInvoice);
        Transaction::find($id_trans)->update([
            'xendit_invoice_url' => $createInvoice['invoice_url'],
            'xendit_invoice_id' => $createInvoice['id']
        ]);
    }
}
