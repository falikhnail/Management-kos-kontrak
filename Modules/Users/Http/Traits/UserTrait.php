<?php

namespace Modules\Users\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    public static function firstForm()
    {
        $a['name'] = '';
        $a['email'] = '';
        $a['no_hp'] = '';
        $a['no_ktp'] = '';
        $a['no_kk'] = '';
        $a['photo_ktp'] = '';
        $a['photo_kk'] = '';
        $a['tanggal_lahir'] = '';
        $a['status_perkawinan'] = '';
        $a['role_id'] = '';

        return $a;
    }

    public static function store_validation($data, $id_edit = null)
    {
        // dd($data);
        if (!$data['name']) {
            // $this->emit('pesanGagal', 'Name Required');
            return [
                'success' => false,
                'message' => 'Name Required'
            ];
        } elseif (!$data['email']) {
            // $this->emit('pesanGagal', 'email Required');
            return [
                'success' => false,
                'message' => 'email Required'
            ];
        } else {

            if ($id_edit) {
                $cek = User::where('email', $data['email'])->where('id', '!=', $id_edit)->exists();

                if ($cek) {
                    return [
                        'success' => false,
                        'message' => 'Maaf email sudah digunakan..'
                    ];
                }
            } else {
                $cek = User::where('email', $data['email'])->exists();

                if ($cek) {
                    return [
                        'success' => false,
                        'message' => 'Maaf email sudah digunakan..'
                    ];
                }
            }

            return [
                'success' => true,
                'message' => 'Success..'
            ];
        }
    }

    public static function store_data($data, $id = null)
    {
        // dd($data);
        if ($id) {
            if (!akses('edit-user')) {
                return hasilReturn(false, 'Access Denied');
            }
            // $data['password'] = bcrypt($data['password']);
            $data['updated_by'] = Auth::id();

            if ($data['tanggal_lahir']) {
                $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
            } else {
                $data['tanggal_lahir'] = null;
            }

            User::find($id)->update($data);

            return hasilReturn(true, 'Update Success..');
        } else {
            if (!akses('create-user')) {
                return hasilReturn(false, 'Access Denied');
            }

            $data['password'] = bcrypt(password_default());
            $data['created_by'] = Auth::id();
            $data['updated_by'] = Auth::id();

            if ($data['tanggal_lahir']) {
                $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
            } else {
                $data['tanggal_lahir'] = null;
            }

            User::create($data);

            return hasilReturn(true, 'Store Success..');
        }
    }

    public static function destroy($id)
    {
        User::find($id)->delete();
    }

    public static function find_data($id)
    {
        $dt = User::find($id);

        return [
            'name' => $dt->name,
            'email' => $dt->email,
            'role_id' => $dt->role_id,
            'no_ktp' => $dt->no_ktp,
            'no_kk' => $dt->no_kk,
            'no_hp' => $dt->no_hp,
            'tanggal_lahir' => date_default($dt->tanggal_lahir, false),
            'status_perkawinan' => $dt->status_perkawinan
        ];
    }
}
