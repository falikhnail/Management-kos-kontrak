<div>
    {{-- Do your work, then step back. --}}
    <div id="modalPindahKamar" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Pindah Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="table-responsive">
                        @if ($penghuni_id)
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>
                                            User: {{ $dt->user->name }}
                                        </th>

                                        <th>
                                            Kamar Saat Ini: {{ $dt->product->name }}
                                        </th>

                                        <th>
                                            Tgl Masuk: {{ date_default($dt->tanggal_masuk, false) }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <form wire:submit.prevent="store">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pindah Kamar Ke:</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Cari Kamar" autocomplete="off" wire:model="search">

                                        @error('pd_name')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror

                                        @if ($search)
                                            <div class="card">
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <ul>
                                                        @foreach ($hasil_pencarian as $e => $hs)
                                                            <li wire:click.prevent="select_kamar({{ $hs->id }})"
                                                                style="cursor: pointer">
                                                                {{ $hs->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>

                                    <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="store">
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4">
                            <div class="table-responsive">
                                @if ($new_product_id)
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Akan Dipindah Ke Kamar: {{ $pd_name }}
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
