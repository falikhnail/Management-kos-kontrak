<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div id="modalRiwayatTagihan" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Riwayat Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

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
                                <input type="text" class="form-control" placeholder="Search Data.."
                                    wire:model="search">
                                {{-- {{ $search }} --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                                wire:target="paging,search,category_id,durasi_pembayaran">
                        </div>
                    </div>

                    @if ($penghuni_id)
                        <div class="table-responsive" style="height: 400px;">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Transaction Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Date</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $e => $dt)
                                        <tr>
                                            <td>{{ $dt->penghuni_r->user->name }}</td>
                                            <td>{{ $dt->penghuni_r->product->name }}</td>
                                            <td>{{ date_default($dt->transaction_date, false) }}</td>
                                            <td>{{ moneyFormat($dt->amount) }}</td>
                                            <td>{{ $dt->status }}</td>
                                            <td>{{ date_default($dt->payment_date, false) }}</td>
                                            <td>
                                                @if (akses('delete-tagihan'))
                                                    <button class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Confirm delete?') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="destroy({{ $dt->id }})"><span
                                                            class="fa fa-trash"></span></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $data->links() }}
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
