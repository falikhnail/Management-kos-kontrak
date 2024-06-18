<?php

namespace App\Traits;

use App\Models\User;
use App\Models\GeneralSetting;

trait GeneralSettingTrait
{
    public static function firstForm()
    {
        $dt = static::firstData();

        return [
            'fee_admin' => $dt->fee_admin,
            'password' => '',
            'password_confirmation' => ''
        ];
    }

    public static function firstData()
    {
        $cek = GeneralSetting::exists();

        if ($cek) {
            return GeneralSetting::first();
        } else {
            return GeneralSetting::create([
                'fee_admin' => 5000,
                'created_by' => my_ids(),
                'updated_by' => my_ids()
            ]);
        }
    }

    public static function saveFeeAdmin($amount)
    {
        if (!akses('set-fee-admin')) {
            return [
                'success' => false,
                'message' => 'Access Denied..'
            ];
        }

        if ($amount < 5000) {
            return [
                'success' => false,
                'message' => 'Tidak boleh lebih kecil dari 5000'
            ];
        } else {
            $dt = GeneralSetting::first();
            $dt->fee_admin = $amount;
            $dt->save();

            return [
                'success' => true,
                'message' => 'Success..'
            ];
        }
    }

    public static function changePassword($data)
    {
        if (!akses('change-password')) {
            return hasilReturn(false, 'Access Denied');
        }

        $pass = $data['password'];
        $pass_conf = $data['password_confirmation'];

        if ($pass === $pass_conf) {

            User::find(my_ids())->update([
                'password' => bcrypt($pass)
            ]);

            return hasilReturn(true, 'Success..');
        } else {
            return hasilReturn(false, 'Conf Password Tidak Sesuai..');
        }
    }
}
