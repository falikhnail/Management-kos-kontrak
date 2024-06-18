<div>
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
                    @if (akses('create-data-product'))
                        <div class="buttons float-right">
                            <a wire:click.prevent="tambah_data" href="#" class="btn btn-icon icon-left btn-primary"><i
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
                            <th>Photo</th>
                            <th>Category</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Rumah</th>
                            <th>Harga</th>
                            <th>Desc</th>
                            <th>Is Active?</th>
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
                                                @if (akses('edit-data-product'))
                                                    <a class="dropdown-item has-icon" href="#"
                                                        wire:click.prevent="edit_data({{ $dt->id }})"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                                @endif

                                                @if (akses('delete-data-product'))
                                                    <a class="dropdown-item has-icon"
                                                        onclick="return confirm('Confirm delete?') || event.stopImmediatePropagation()"
                                                        href="#" wire:click.prevent="destroy({{ $dt->id }})"><i
                                                            class="bi bi-trash3"></i>
                                                        Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </td>
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
                                    @if (akses('edit-data-kontrakan'))
                                        @if ($dt->is_active == 1)
                                            <div style="cursor: pointer;"
                                                wire:click.prevent="update_status({{ $dt->id }})"
                                                class="badge badge-success">Active</div>
                                        @else
                                            <div style="cursor: pointer;"
                                                wire:click.prevent="update_status({{ $dt->id }})"
                                                class="badge badge-danger">Not Active</div>
                                        @endif
                                    @endif
                                    <img wire:loading wire:target="update_status({{ $dt->id }})"
                                        src="{{ asset('loading-bar.gif') }}" alt="">
                                </td>
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

    @livewire('product.createproduct')

    @section('scripts')
        <script>
            Livewire.on('modalAdd', aksi => {

                if (aksi == 'show') {
                    $('.modalAdd').modal('show');
                } else {
                    // alert(aksi);
                    $('.modalAdd').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>
    @endsection

</div>
