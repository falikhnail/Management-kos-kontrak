<?php

namespace App\Traits;

use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\TransactionLine;

trait KasBankTrait
{
    public static function firstForm($id = null)
    {
        if ($id) {
            $dt = Transaction::with([
                'lines'
            ])->find($id);

            $data = [
                'type' => $dt->type,
                'note' => $dt->note,
                'transaction_date' => date_default($dt->transaction_date, false),
                'lines' => []
            ];

            foreach ($dt->lines as $key => $dl) {
                # code...
                $a['transaction_id'] = $id;
                $a['amount'] = $dl->amount;
                $a['note'] = $dl->note;
                array_push($data['lines'], $a);
            }

            return $data;
        } else {
            return [
                'type' => '',
                'note' => '',
                'transaction_date' => date('Y-m-d'),
                'lines' => [
                    [
                        'transaction_id' => '',
                        'amount' => 0,
                        'note' => ''
                    ]
                ]
            ];
        }
    }

    public static function firstFilter()
    {
        return [
            'type' => '',
            'paging' => 25,
            'search' => '',
            'dari' => date('Y-m-') . '01',
            'sampai' => date_default(null, false)
        ];
    }

    public static function newLine($data)
    {
        $a['transaction_id'] = '';
        $a['amount'] = 0;
        $a['note'] = '';

        array_push($data['lines'], $a);

        return $data;
    }

    public static function destroyLine($data, $index)
    {
        unset($data['lines'][$index]);
        // dd($data);

        return $data;
    }

    public static function getData($filters)
    {
        // dd(Transaction::paginate($paging));
        $content = Transaction::kasBank()
            ->periode($filters['dari'], $filters['sampai'])
            ->filterType($filters['type'])
            ->filter($filters['search'])
            ->latest()
            ->paginate($filters['paging']);
        // dd($content);
        $final_total = Transaction::kasBank()
            ->periode($filters['dari'], $filters['sampai'])
            ->filterType($filters['type'])
            ->filter($filters['search'])
            ->latest()
            ->paginate($filters['paging'])->sum('final_total');

        return [
            'content' => $content,
            'final_total' => $final_total
        ];
    }

    public static function getRowData($id = null)
    {
        if ($id) {
            $dt = Transaction::with([
                'lines'
            ])->find($id);
        } else {
            $dt = Transaction::with([
                'lines'
            ])->first();
        }

        $data = [
            'type' => $dt->type,
            'note' => $dt->note,
            'transaction_date' => date_default($dt->transaction_date, false),
            'lines' => []
        ];

        foreach ($dt->lines as $key => $dl) {
            # code...
            $a['transaction_id'] = $id;
            $a['amount'] = $dl->amount;
            $a['note'] = $dl->note;
            array_push($data['lines'], $a);
        }

        return $data;
    }

    public static function store($data = [], $id_edit = null)
    {
        $type = ($data['type'] == 'income') ? 'income' : 'expense';

        if ($id_edit) {
            //
            Transaction::find($id_edit)->update([
                'user_id' => my_ids(),
                'type' => $type,
                'transaction_date' => date_default($data['transaction_date'], false),
                'note' => $data['note'],
                // 'created_by' => my_ids(),
                'updated_by' => my_ids()
            ]);
            $ts = Transaction::find($id_edit);

            TransactionLine::where('transaction_id', $id_edit)->delete();
            // dd($data);
            foreach ($data['lines'] as $key => $ln) {
                # code...
                $lines = TransactionLine::create([
                    'transaction_id' => $ts->id,
                    'amount' => (int)$ln['amount'],
                    'note' => $ln['note']
                ]);
            }

            // $doc_no = Str::upper($type) . '/' . my_ids() . '/' . zeroFill($ts->id, 4);
            $final_total = TransactionLine::where('transaction_id', $ts->id)->sum('amount');

            Transaction::find($ts->id)->update([
                // 'doc_no' => $doc_no,
                'final_total' => $final_total
            ]);
        } else {
            //
            $ts = Transaction::create([
                'user_id' => my_ids(),
                'type' => $type,
                'transaction_date' => date_default($data['transaction_date'], false),
                'note' => $data['note'],
                'created_by' => my_ids(),
                'updated_by' => my_ids()
            ]);

            foreach ($data['lines'] as $key => $ln) {
                # code...
                TransactionLine::create([
                    'transaction_id' => $ts->id,
                    'amount' => (int)$ln['amount'],
                    'note' => $ln['note']
                ]);
            }

            $doc_no = Str::upper($type) . '/' . my_ids() . '/' . zeroFill($ts->id, 4);
            $final_total = TransactionLine::where('transaction_id', $ts->id)->sum('amount');

            Transaction::find($ts->id)->update([
                'doc_no' => $doc_no,
                'final_total' => $final_total
            ]);
        }
    }

    public static function destroy($id)
    {
        TransactionLine::where('transaction_id', $id)->delete();
        Transaction::find($id)->delete();
    }

    public static function viewDetail($id)
    {
        // $hasil = [];
        // $hasil['lines'] = [];

        $dt = Transaction::find($id);

        $hasil = [
            'doc_no' => $dt->doc_no,
            'transaction_date' => date_default($dt->transaction_date, false),
            'type' => $dt->type,
            'note' => $dt->note,
            'lines' => [],
            'total_amount' => moneyFormat($dt->final_total)
        ];

        foreach ($dt->lines as $key => $ln) {
            # code...
            $a['amount'] = moneyFormat($ln->amount);
            $a['note'] = $ln->note;

            array_push($hasil['lines'], $a);
        }

        return $hasil;
    }
}
