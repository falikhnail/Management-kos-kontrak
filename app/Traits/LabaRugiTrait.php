<?php

namespace App\Traits;

use App\Models\Transaction;

trait LabaRugiTrait
{
    public static function hitungTotal($dari, $sampai)
    {
        $total_tagihan = Transaction::periode($dari, $sampai)->payment()->final()->sum('final_total');
        $total_income = Transaction::periode($dari, $sampai)->income()->sum('final_total');
        $total_expense = Transaction::periode($dari, $sampai)->expense()->sum('final_total');

        $total = $total_tagihan + $total_income - $total_expense;

        return [
            'total_tagihan' => $total_tagihan,
            'total_income' => $total_income,
            'total_expense' => $total_expense,
            'final_total' => $total
        ];
    }
}
