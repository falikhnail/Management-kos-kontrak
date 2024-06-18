<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}



    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Bordered Table</h3> --}}
            <div class="row">
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
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" wire:model="filters.type">
                            <option value="">Select Option</option>
                            @foreach ($types as $e => $tp)
                                <option value="{{ $e }}">{{ $tp }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    @if (akses('create-kas'))
                        <div class="buttons float-right">
                            <a href="{{ url('kasbank/create') }}" class="btn btn-icon icon-left btn-primary"><i
                                    class="bi bi-clipboard-plus"></i>
                                Add Data</a>
                        </div>
                    @endif
                </div>

                <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="filters">

            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        {{-- <label>Text</label> --}}
                        <select class="form-control" wire:model="filters.paging">
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
                            <th>Type</th>
                            <th>Note</th>
                            <th>Total Amount</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Created By</th>
                            <th>Updated By</th>
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
                                                @if (akses('edit-kas'))
                                                    <a class="dropdown-item has-icon"
                                                        href="{{ url('kasbank/create/' . $dt->id) }}"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                                @endif

                                                <a class="dropdown-item has-icon" href="#"
                                                    wire:click.prevent="view({{ $dt->id }})"><i
                                                        class="bi bi-eye"></i>
                                                    View Detail</a>

                                                @if (akses('delete-kas'))
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
                                <td>{{ $dt->type }}</td>
                                <td>{{ $dt->note }}</td>
                                <td>{{ moneyFormat($dt->final_total) }}</td>
                                <td>{{ date_default($dt->created_at) }}</td>
                                <td>{{ date_default($dt->updated_at) }}</td>
                                <td>{{ user_by($dt->created_by)['name'] }}</td>
                                <td>{{ user_by($dt->updated_by)['name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">
                                <center>Total Amount</center>
                            </th>
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

    <div id="modalDetail" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">View Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    @if ($details)
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Type: {{ $details['type'] }}</th>
                                        <th>Doc No: {{ $details['doc_no'] }}</th>
                                        <th>Transaction Date: {{ $details['transaction_date'] }}</th>
                                        <th>Total Amount: {{ $details['total_amount'] }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table class="table">
                                <tbody>
                                    @foreach ($details['lines'] as $e => $ln)
                                        <tr>
                                            <th> {{ $ln['note'] }}</th>
                                            <th> {{ $ln['amount'] }}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            Livewire.on('modalDetail', aksi => {

                if (aksi == 'show') {
                    $('#modalDetail').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalDetail').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>
    @endsection

</div>
