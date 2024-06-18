<div>
    {{-- Do your work, then step back. --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" wire:model="dari">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" class="form-control" wire:model="sampai">
                    </div>
                </div>

                <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="dari,sampai">

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">

                <div class="col-md-12">
                    @if ($data['final_total'] == 0)
                        <h1>{{ $data['final_total'] }}</h1>
                    @else
                        <h1>{{ moneyFormat($data['final_total']) }}</h1>
                    @endif
                    <hr>
                    <p>
                        <b>Total Tagihan + Total Income - Total Expense (
                            {{ $data['total_tagihan'] . ' + ' . $data['total_income'] . ' - ' . $data['total_expense'] }}
                            )</b>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
