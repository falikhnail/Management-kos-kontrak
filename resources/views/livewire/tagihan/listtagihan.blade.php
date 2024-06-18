<div>
    {{-- The whole world belongs to you. --}}
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Bordered Table</h3> --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select class="form-control" wire:model="filters.status">
                            <option value="">All</option>
                            @foreach ($payment_status as $e => $pg)
                                <option value="{{ $e }}">{{ $pg }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" wire:model="filters.dari">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" class="form-control" wire:model="filters.sampai">
                    </div>
                </div>
                <div class="col-md-3">
                    @if (akses('create-tagihan'))
                        <div class="buttons float-right">
                            <a href="#" wire:click.prevent="tambah_data" class="btn btn-icon icon-left btn-primary"><i
                                    class="bi bi-clipboard-plus"></i>
                                Add Data</a>

                            <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="tambah_data">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        {{-- <label>Text</label> --}}
                        <select class="form-control" wire:model="paging">
                            @foreach ($pagings as $e => $pg)
                                <option value="{{ $e }}">{{ $pg }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{-- <label>Text</label> --}}
                        <input type="text" class="form-control" placeholder="Search Data.." wire:model="search">
                        {{-- {{ $search }} --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                        wire:target="paging,search,category_id,durasi_pembayaran,filters.status,filters.dari,filters.sampai">
                </div>
            </div>

            <div class="table-responsive" style="height: 400px;">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Doc No</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Transaction Date</th>
                            <th>Amount</th>
                            <th>Fee Admin</th>
                            <th>Final Total</th>
                            <th>Status</th>
                            {{-- <th>Payment Date</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['content'] as $e => $dt)
                            <tr>
                                <td>
                                    @if ($dt->is_paten != 1)
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @if (akses('edit-tagihan'))
                                                    <a class="dropdown-item has-icon" href="#"
                                                        wire:click.prevent="edit_data({{ $dt->id }})"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                                @endif

                                                <a class="dropdown-item has-icon" target="_blank"
                                                    href="{{ $dt->xendit_invoice_url }}"><i
                                                        class="bi bi-paypal"></i>
                                                    Pembayaran Online</a>

                                                @if (akses('delete-tagihan'))
                                                    <a class="dropdown-item has-icon"
                                                        onclick="return confirm('Confirm delete?') || event.stopImmediatePropagation()"
                                                        href="#" wire:click.prevent="destroy({{ $dt->id }})"><i
                                                            class="bi bi-trash3"></i>
                                                        Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                                        wire:target="edit_data({{ $dt->id }})">
                                </td>
                                <td>{{ $dt->doc_no }}</td>
                                <td>{{ $dt->user->name }}</td>
                                <td>{{ $dt->product->name }}</td>
                                <td>{{ date_default($dt->transaction_date, false) }}</td>
                                <td>{{ moneyFormat($dt->amount) }}</td>
                                <td>{{ moneyFormat($dt->fee_admin) }}</td>
                                <td>{{ moneyFormat($dt->final_total) }}</td>
                                <td>
                                    <span class="badge bg-{{ colorStatus($dt->status) }}">{{ $dt->status }}</span>
                                </td>
                                {{-- <td>{{ date_default($dt->payment_date, false) }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">
                                <center>Total Amount</center>
                            </th>
                            <th>{{ moneyFormat($data['amount']) }}</th>
                            <th>{{ moneyFormat($data['fee_admin']) }}</th>
                            <th>{{ moneyFormat($data['final_total']) }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            {{ $data['content']->links() }}
        </div>
        <!-- /.card-body -->
    </div>

    @livewire('tagihan.createtagihan')

    @section('scripts')
        <script>
            Livewire.on('modalCreateTagihan', aksi => {

                if (aksi == 'show') {
                    $('#modalCreateTagihan').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalCreateTagihan').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>
    @endsection

</div>
