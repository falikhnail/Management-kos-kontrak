<?php

namespace App\Models;

trait _TransactionScopes
{
    public function scopePenghuni($e, $id)
    {
        if ($id) {
            return $e->where('penghuni_id', $id);
        }
    }

    public function scopeKasBank($e)
    {
        return $e->whereIn('type', ['income', 'expense']);
    }

    public function scopeDeposit($e)
    {
        return $e->where('sub_type', 'deposit');
    }

    public function scopePayment($e)
    {
        return $e->where('type', 'payment');
    }

    public function scopeIncome($e)
    {
        return $e->where('type', 'income');
    }

    public function scopeExpense($e)
    {
        return $e->where('type', 'expense');
    }

    public function scopeFilterType($e, $str)
    {
        if ($str) {
            return $e->where('type', $str);
        }
    }

    public function scopeFinal($e)
    {
        return $e->where('status', 'final');
    }

    public function scopeFilter($e, $q)
    {
        if ($q) {
            return $e->whereHas('user', function ($ee) use ($q) {
                $ee->where('name', 'like', "%$q%");
            })->orWhereHas('product', function ($ee) use ($q) {
                $ee->where('name', 'like', "%$q%");
            })->orWhere('status', 'like', "%$q%")
                ->orWhere('doc_no', 'like', "%$q%")
                ->orWhere('final_total', 'like', "%$q%")
                ->orWhere('note', 'like', "%$q%");
        }
    }

    public function scopeFilterStatus($e, $status)
    {
        if ($status) {
            return $e->where('status', $status);
        }
    }

    public function scopePeriode($e, $dari = null, $sampai = null)
    {
        if ($dari) {
            return $e->whereDate('transaction_date', '>=', date_default($dari, false))->whereDate('transaction_date', '<=', date_default($sampai, false));
        }
    }
}
