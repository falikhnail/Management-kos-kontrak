<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Bordered Table</h3> --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category_id">Kategori**</label>
                        <select class="form-control" wire:model="category_id" id="category_id">
                            <option value="">All</option>
                            @foreach ($categories as $ct)
                                <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="durasi_pembayaran">Durasi Pembayaran**</label>
                        <select class="form-control" id="durasi_pembayaran" wire:model.lazy="durasi_pembayaran">
                            <option value="">All</option>
                            @foreach ($durasis as $dr)
                                <option value="{{ $dr['name'] }}">{{ $dr['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('durasi_pembayaran')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-3">
                    @if (akses('create-penghuni'))
                        <div class="buttons float-right">
                            <a href="{{ url('penghuni/create') }}" class="btn btn-icon icon-left btn-primary"><i
                                    class="bi bi-clipboard-plus"></i>
                                Add Data</a>
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
                        wire:target="paging,search,category_id,durasi_pembayaran">
                </div>
            </div>

            <div class="table-responsive" style="height: 400px;">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="width: 40px">Action</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Last Payment</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $e => $dt)
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
                                                @if (akses('edit-penghuni'))
                                                    <a class="dropdown-item has-icon"
                                                        href="{{ url('penghuni/create/' . $dt->id) }}"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                                @endif

                                                @if (akses('cek-riwayat-tagihan'))
                                                    <a class="dropdown-item has-icon" href="#"
                                                        wire:click.prevent="riwayat_tagihan({{ $dt->id }})"><i
                                                            class="bi bi-clock-history"></i>
                                                        Riwayat Tagihan</a>
                                                @endif

                                                @if (akses('atur-pindah-kamar'))
                                                    <a class="dropdown-item has-icon" href="#"
                                                        wire:click.prevent="pindah_kamar({{ $dt->id }})"><i
                                                            class="bi bi-forward"></i>
                                                        Pindah Kamar</a>
                                                @endif

                                                @if (akses('atur-berhenti-menghuni'))
                                                    <a onclick="return confirm('Berhenti Menghuni?') || event.stopImmediatePropagation()"
                                                        class="dropdown-item has-icon" href="#"
                                                        wire:click.prevent="berhenti({{ $dt->id }})"><i
                                                            class="bi bi-stop-btn"></i>
                                                        Berhenti Menghuni</a>
                                                @endif

                                                @if (akses('delete-penghuni'))
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
                                        wire:target="riwayat_tagihan,pindah_kamar,berhenti,destroy">
                                </td>

                                <td>{{ $dt->user->name }}</td>
                                <td>{!! $dt->product->name !!}</td>
                                <td>{{ lastPayment($dt->id)['date'] . '/' . lastPayment($dt->id)['amount'] }}</td>

                                <td>{{ date_default($dt->created_at) }}</td>
                                <td>{{ date_default($dt->updated_at) }}</td>
                                <td>{{ user_by($dt->created_by)['name'] }}</td>
                                <td>{{ user_by($dt->updated_by)['name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
        <!-- /.card-body -->
    </div>

    @livewire('penghuni.riwayattagihan')
    @livewire('penghuni.pindahkamar')

    @section('scripts')
        <script>
            Livewire.on('modalRiwayatTagihan', aksi => {

                if (aksi == 'show') {
                    $('#modalRiwayatTagihan').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalRiwayatTagihan').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>

        <script>
            Livewire.on('modalPindahKamar', aksi => {

                if (aksi == 'show') {
                    $('#modalPindahKamar').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalPindahKamar').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>
    @endsection

</div>
