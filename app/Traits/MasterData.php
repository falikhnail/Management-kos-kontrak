<?php

namespace App\Traits;

trait MasterData
{
    public static function pesan_gagal($e)
    {
        return "File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage();
    }

    public static function list_pagings()
    {
        return [
            '1' => 1,
            '10' => 10,
            '25' => 25,
            '50' => 50,
            '100' => 100,
            '250' => 250,
            '500' => 500,
            '1000' => 1000
        ];
    }

    public static function hasilReturn($is_success, $message)
    {
        return [
            'success' => $is_success,
            'message' => $message
        ];
    }

    public static function durasiPembayaran()
    {
        return [
            [
                'name' => 'daily'
            ],
            [
                'name' => 'monthly'
            ],
            [
                'name' => 'yearly'
            ]
        ];
    }

    public static function status_perkawinan()
    {
        return [
            'Belum Kawin',
            'Kawin',
            'Cerai Hidup',
            'Cerai Mati'
        ];
    }

    public static function status_pembayaran()
    {
        return [
            'final' => 'Final',
            'pending' => 'Pending',
            'cancel' => 'Cancel'
        ];
    }

    public static function typesKasBank()
    {
        return [
            'income' => 'Income',
            'expense' => 'Expense'
        ];
    }
}
