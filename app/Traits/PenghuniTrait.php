<?php

namespace App\Traits;

use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Product;
use App\Models\Penghuni;
use App\Models\Transaction;
use App\Traits\XenditTrait;

trait PenghuniTrait
{
    public static function firsFormCreate($id = null)
    {
        if ($id) {
            $dt = Penghuni::find($id);

            $deposit = Transaction::penghuni($id)->deposit()->first();

            return [
                'user_id' => $dt->user_id,
                'name' => $dt->user->name,
                'email' => $dt->user->email,
                'no_hp' => $dt->user->no_hp,
                'no_ktp' => $dt->user->no_ktp,
                'no_kk' => $dt->user->no_kk,
                'tanggal_lahir' => date_default($dt->user->tanggal_lahir, false),
                'tanggal_masuk' => date_default($dt->tanggal_masuk, false),
                'status_perkawinan' => $dt->user->status_perkawinan,
                'product_id' => $dt->product_id,
                'product_name' => $dt->product->name,
                'nominal' => $deposit->amount ?? 0,
                'tanggal_pembayaran' => (isset($deposit->transaction_date)) ? date_default($deposit->transaction_date, false) : '',
                'status_pembayaran' => $deposit->status ?? ''
            ];
        } else {
            return [
                'user_id' => '',
                'name' => '',
                'email' => '',
                'no_hp' => '',
                'no_ktp' => '',
                'no_kk' => '',
                'tanggal_lahir' => '',
                'tanggal_masuk' => '',
                'status_perkawinan' => '',
                'product_id' => '',
                'product_name' => '',
                'nominal' => 0,
                'tanggal_pembayaran' => '',
                'status_pembayaran' => ''
            ];
        }
    }

    public static function select_user($id, $data)
    {
        $dt = User::find($id);

        $data = [
            'user_id' => $id,
            'name' => $dt->name,
            'email' => $dt->email,
            'no_hp' => $dt->no_hp,
            'no_ktp' => $dt->no_ktp,
            'no_kk' => $dt->no_kk,
            'tanggal_lahir' => date_default($dt->tanggal_lahir, false),
            'tanggal_masuk' => date_default($dt->tanggal_masuk, false),
            'status_perkawinan' => $dt->status_perkawinan,
            'product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'nominal' => $data['nominal'],
            'tanggal_pembayaran' => date_default($data['tanggal_pembayaran'], false),
            'status_pembayaran' => $data['status_pembayaran']
        ];

        // $data['user_id'] = $id;
        // $data['name'] = $dt->name;
        // $data['email'] = $dt->email;
        // $data['no_hp'] = $dt->no_hp;
        // $data['no_ktp'] = $dt->no_ktp;
        // $data['no_kk'] = $dt->no_kk;
        // $data['tanggal_lahir'] = date_default($dt->tanggal_lahir, false);
        // $data['status_perkawinan'] = $dt->status_perkawinan;

        return $data;
    }

    public static function select_product($id, $data)
    {
        $dt = Product::find($id);

        $data['product_id'] = $id;
        $data['product_name'] = $dt->name;

        return $data;
    }

    public static function storeForm($data, $id = null)
    {
        // dd($data);

        if ($id) {
            // update data user 
            $user_id = $data['user_id'];
            User::find($user_id)->update([
                'name' => $data['name'],
                'no_hp' => $data['no_hp'],
                'no_ktp' => $data['no_ktp'],
                'no_kk' => $data['no_kk'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'status_perkawinan' => $data['status_perkawinan'],
            ]);

            // Store Penghuni 
            Penghuni::find($id)->update([
                'user_id' => $user_id,
                'product_id' => $data['product_id'],
                'tanggal_masuk' => $data['tanggal_masuk'],
                // 'created_by' => my_ids(),
                'updated_by' => my_ids()
            ]);

            // transaction payment
            // if ($data['nominal'] > 0) {
            // Transaction::create([
            //     'penghuni_id' => $pengh->id,
            //     'user_id' => $pengh->user_id,
            //     'product_id' => $pengh->product_id,
            //     'type' => 'payment',
            //     'sub_type' => 'deposit',
            //     'status' => $data['status_pembayaran']
            // ]);

            if ($data['status_pembayaran'] == 'final') {
                $payment_date = date_default($data['tanggal_pembayaran'], false);
            }

            $gs = GeneralSettingTrait::firstData();

            $py = Transaction::firstOrNew(
                [
                    'penghuni_id' => $id,
                    'sub_type' => 'deposit'
                ],
            );

            $pengh = Penghuni::find($id);

            $py->penghuni_id = $pengh->id;
            $py->user_id = $pengh->user_id;
            $py->product_id = $pengh->product_id;
            $py->type = 'payment';
            $py->sub_type = 'deposit';
            $py->status = $data['status_pembayaran'];
            $py->transaction_date = date_default($data['tanggal_pembayaran'], false);
            $py->payment_date = $payment_date;
            $py->amount = $data['nominal'];
            $py->fee_admin = $gs->fee_admin;
            $py->final_total = $data['nominal'] + $gs->fee_admin;

            $py->save();

            // if ($py->amount > 5000) {
            $data_xendit = [
                'user_id' => $py->user_id,
                'product_id' => $py->product_id,
                'amount' => $py->amount
            ];
            XenditTrait::genInvoice($data_xendit, $py->id);
            // }
            // }
        } else {
            // update data user 
            $user_id = $data['user_id'];
            User::find($user_id)->update([
                'name' => $data['name'],
                'no_hp' => $data['no_hp'],
                'no_ktp' => $data['no_ktp'],
                'no_kk' => $data['no_kk'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'status_perkawinan' => $data['status_perkawinan'],
            ]);

            // Store Penghuni 
            // cek dlu 
            $cek = Penghuni::userId($user_id)->exists();
            if ($cek) {
                Penghuni::userId($user_id)->update([
                    'user_id' => $user_id,
                    'product_id' => $data['product_id'],
                    'tanggal_masuk' => $data['tanggal_masuk'],
                    'created_by' => my_ids(),
                    'updated_by' => my_ids()
                ]);
                $pengh = Penghuni::userId($user_id)->first();
            } else {
                $pengh = Penghuni::create([
                    'user_id' => $user_id,
                    'product_id' => $data['product_id'],
                    'tanggal_masuk' => $data['tanggal_masuk'],
                    'created_by' => my_ids(),
                    'updated_by' => my_ids()
                ]);
            }

            // if ($data['status_pembayaran'] == 'final') {
            $payment_date = date_default($data['tanggal_pembayaran'], false);
            // }

            // transaction payment
            // if ($data['nominal'] > 0) {
            $gs = GeneralSettingTrait::firstData();

            $ts = Transaction::create([
                'penghuni_id' => $pengh->id,
                'user_id' => $pengh->user_id,
                'product_id' => $pengh->product_id,
                'type' => 'payment',
                'sub_type' => 'deposit',
                'status' => $data['status_pembayaran'],
                'transaction_date' => date_default($data['tanggal_pembayaran'], false),
                'payment_date' => $payment_date,
                'amount' => $data['nominal'],
                'fee_admin' => $gs->fee_admin,
                'final_total' => $data['nominal'] + $gs->fee_admin
            ]);

            $doc_no = 'INV/' . $pengh->user_id . '/' . zeroFill($ts->id, 4);
            Transaction::find($ts->id)->update([
                'doc_no' => $doc_no
            ]);
            // }
            // if ($ts->amount > 5000) {
            $data_xendit = [
                'user_id' => $ts->user_id,
                'product_id' => $ts->product_id,
                'amount' => $ts->final_total
            ];
            XenditTrait::genInvoice($data_xendit, $ts->id);
            // }
        }
    }
}
