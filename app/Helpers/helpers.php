<?php

use App\Models\User;
use App\Models\Transaction;
use Modules\Roles\Entities\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

function updateStatus(Model $model, $id, $user_by = false)
{
    $dt = $model::find($id);

    if ($dt->is_active == 1) {
        $dt->is_active = 0;

        if ($user_by) {
            // $dt->created_by = Auth::id();
            $dt->updated_by = Auth::id();
        }

        $dt->save();
    } else {
        $dt->is_active = 1;

        if ($user_by) {
            // $dt->created_by = Auth::id();
            $dt->updated_by = Auth::id();
        }

        $dt->save();
    }
}

function my_ids()
{
    return Auth::id();
}

function akses($str)
{
    $my_id = my_ids();
    $role_id = User::find($my_id)->role_id;
    // dd($role_id);
    $role = Role::find($role_id);
    // dd($role);
    $permissions = $role->permissions;
    $permissions = json_decode($permissions);

    if (in_array($str, $permissions)) {
        return true;
    } else {
        return false;
    }
}

function user_by($id)
{
    if ($id) {
        $dt = User::find($id);

        if (isset($dt->name)) {
            return [
                'name' => $dt->name,
                'email' => $dt->email
            ];
        } else {
            return [
                'name' => '',
                'email' => ''
            ];
        }
    }

    return [
        'name' => '',
        'email' => ''
    ];
}

function date_default($str = null, $with_time = true)
{
    if ($str) {
        if ($with_time) {
            return date('Y-m-d H:i:s', strtotime($str));
        } else {
            return date('Y-m-d', strtotime($str));
        }
    } else {
        if ($with_time) {
            return date('Y-m-d H:i:s');
        } else {
            return date('Y-m-d');
        }
    }
}

function usia($str)
{
    if ($str) {
        $tanggal_lahir = date('Y-m-d', strtotime($str));
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        if ($birthDate > $today) {
            return "0 tahun 0 bulan 0 hari";
        }
        $y = $today->diff($birthDate)->y;
        // dd($y);
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y . " tahun " . $m . " bulan " . $d . " hari";
    } else {
        return '';
    }
}

function date_indo($str)
{
    if ($str) {
        return date('d M Y', strtotime($str));
    }
}

function moneyFormat($str)
{
    if ($str) {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}

function password_default()
{
    return 'sangcahaya.id';
}

function lastPayment($id)
{
    $dt = Transaction::payment()
        ->penghuni($id)
        ->final()
        ->orderBy('transaction_date', 'desc')->orderBy('id', 'desc')
        ->first();

    if (isset($dt->payment_date)) {
        return [
            'date' => date_default($dt->payment_date, false),
            'amount' => moneyFormat($dt->amount)
        ];
    } else {
        return [
            'date' => '',
            'amount' => ''
        ];
    }
}

function colorStatus($str)
{
    if ($str == 'final') {
        return 'success';
    } elseif ($str == 'pending') {
        return 'warning';
    } elseif ($str == 'cancel') {
        return 'danger';
    }
}

function secretKeyXendit()
{
    // return env('XENDIT_TEST_SECRET_KEY');
    return env('XENDIT_LIVE_SECRET_KEY');
}

function xenditTokenCallback()
{
    return '1yGqBxUv9gJvMgnID8CI50RRLwsC69PIlA7fyjH5D6AxqE0E';
}

function hasilReturn($is_success, $message)
{
    return [
        'success' => $is_success,
        'message' => $message
    ];
}

function zeroFill($your_int, $jumlah)
{
    return sprintf("%0" . $jumlah . "d", $your_int);
}
