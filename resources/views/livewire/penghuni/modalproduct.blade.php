<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div id="modalProduct" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Pilih Produk - Data yang tampil hanya rumah yang belum terisi/masih
                        kosong..</h5>
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

                    <div class="table-responsive" style="height: 400px;">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Category</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Rumah</th>
                                    <th>Harga</th>
                                    <th>Desc</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $e => $dt)
                                    <tr style="cursor: pointer;"
                                        wire:click.prevent="select_product({{ $dt->id }})">
                                        <td>
                                            {{-- {{ asset('storage/' . $dt->photo_path) }} --}}
                                            <img style="width: 120px;" src="{{ asset($dt->photo_path) }}" alt="photo">
                                        </td>
                                        <td>{{ $dt->category->name }}</td>
                                        <td>{{ $dt->name }}</td>
                                        <td>{{ $dt->address }}</td>
                                        <td>{{ $dt->no_rumah }}</td>
                                        <td>{{ $dt->harga }}</td>
                                        <td>{{ $dt->note }}</td>
                                        <td>
                                            <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                                                wire:target="select_product({{ $dt->id }})">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $data->links() }}

                </div>

            </div>
        </div>
    </div>
</div>
