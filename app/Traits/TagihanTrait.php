<?php

namespace App\Traits;

use App\Models\Penghuni;
use App\Models\Transaction;
use App\Traits\WablasTrait;
use App\Models\GeneralSetting;
use App\Traits\GeneralSettingTrait;
use Illuminate\Support\Facades\Auth;

trait TagihanTrait
{
    public static function firstForm($penghuni_id = null, $data = null, $id = null)
    {
        if ($penghuni_id) {
            $dt = Penghuni::find($penghuni_id);

            return [
                'penghuni_id' => $penghuni_id,
                'user_name' => $dt->user->name,
                'product_name' => $dt->product->name,
                'amount' => $data['amount'],
                'transaction_date' => date_default($data['transaction_date'], false),
                'status' => $data['status'],
                'user_id' => $dt->user_id,
                'product_id' => $dt->product_id
            ];
        }

        if ($id) {
            $dt = Transaction::find($id);

            return [
                'penghuni_id' => $dt->penghuni_id,
                'user_name' => $dt->user->name,
                'product_name' => $dt->product->name,
                'amount' => $dt->amount,
                'transaction_date' => date_default($dt->transaction_date, false),
                'status' => $dt->status,
                'user_id' => $dt->user_id,
                'product_id' => $dt->product_id
            ];
        }

        return [
            'penghuni_id' => '',
            'user_name' => '',
            'product_name' => '',
            'amount' => 0,
            'transaction_date' => date('Y-m-d'),
            'status' => 'pending',
            'user_id' => '',
            'product_id' => ''
        ];
    }

    public static function store($data, $id = null)
    {
        // dd(zeroFill($data['user_id'], 4));
        $gs = GeneralSettingTrait::firstData();

        if ($data['status'] == 'final') {
            $pay_date = date_default($data['transaction_date'], false);
        } else {
            $pay_date = null;
        }



        if ($id) {
            $ts = Transaction::find($id)->update([
                'penghuni_id' => $data['penghuni_id'],
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'type' => 'payment',
                'status' => $data['status'],
                'transaction_date' => date_default($data['transaction_date'], false),
                'payment_date' => $pay_date,
                'amount' => $data['amount'],
                'fee_admin' => $gs->fee_admin,
                'final_total' => $data['amount'] + $gs->fee_admin,
                // 'created_by' => Auth::id(),
                'updated_by' => Auth::id()
            ]);

            WablasTrait::sendTextTagihan($id);
            return $id;
        } else {
            $ts = Transaction::create([
                // 'doc_no' => $doc_no,
                'penghuni_id' => $data['penghuni_id'],
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id'],
                'type' => 'payment',
                'status' => $data['status'],
                'transaction_date' => date_default($data['transaction_date'], false),
                'payment_date' => $pay_date,
                'amount' => $data['amount'],
                'fee_admin' => $gs->fee_admin,
                'final_total' => $data['amount'] + $gs->fee_admin,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id()
            ]);

            $doc_no = 'INV/' . zeroFill($data['user_id'], 4) . '/' . $ts->id;

            Transaction::find($ts->id)->update([
                'doc_no' => $doc_no
            ]);

            WablasTrait::sendTextTagihan($ts->id);
            return $ts->id;
        }
    }

    public static function getData($filters, $q, $paging)
    {
        $content = Transaction::with([
            'user', 'product'
        ])
            ->filterStatus($filters['status'])
            ->filter($q)
            ->periode($filters['dari'], $filters['sampai'])
            ->payment()
            ->orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->paginate($paging);

        $total_amount = Transaction::with([
            'user', 'product'
        ])
            ->filterStatus($filters['status'])
            ->filter($q)
            ->periode($filters['dari'], $filters['sampai'])
            ->payment()
            ->orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->paginate($paging)->sum('amount');

        $total_fee_admin = Transaction::with([
            'user', 'product'
        ])
            ->filterStatus($filters['status'])
            ->filter($q)
            ->periode($filters['dari'], $filters['sampai'])
            ->payment()
            ->orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->paginate($paging)->sum('fee_admin');

        $total_final_total = Transaction::with([
            'user', 'product'
        ])
            ->filterStatus($filters['status'])
            ->filter($q)
            ->periode($filters['dari'], $filters['sampai'])
            ->payment()
            ->orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->paginate($paging)->sum('final_total');

        return [
            'content' => $content,
            'amount' => $total_amount,
            'fee_admin' => $total_fee_admin,
            'final_total' => $total_final_total
        ];
    }
}
