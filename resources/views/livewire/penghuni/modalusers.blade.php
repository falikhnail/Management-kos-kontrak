<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div id="modalUser" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Pilih User - Data yang ditampilkan hanyalah user yang belum menyewa</h5>
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

                        <div class="col-md-1">
                            <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="search,paging">
                        </div>

                        <div class="col-md-7">
                            <div class="buttons float-right">
                                <a wire:click.prevent="create_user" href="#"
                                    class="btn btn-icon icon-left btn-primary"><i class="bi bi-clipboard-plus"></i>
                                    Tambah User Baru</a>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive" style="height: 400px;">
                        <table class="table table-hover table-sm">
                            <tbody>
                                <tr>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Tgl Lahir</th>
                                    <th>No KTP</th>
                                    <th>No KK</th>
                                    <th>Status Perkawinan</th>
                                    <th></th>
                                </tr>
                                @foreach ($data as $e => $dt)
                                    <tr style="cursor: pointer" wire:click.prevent="select_user({{ $dt->id }})">
                                        <td>{{ $dt->role->name }}</td>
                                        <td>{{ $dt->name }}</td>
                                        <td>{{ $dt->email }}</td>
                                        <td>{{ $dt->no_hp }}</td>
                                        <td>{{ date_indo($dt->tanggal_lahir) }}</td>
                                        <td>{{ $dt->no_ktp }}</td>
                                        <td>{{ $dt->no_kk }}</td>
                                        <td>{{ $dt->status_perkawinan }}</td>
                                        <td>
                                            <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                                                wire:target="select_user({{ $dt->id }})">
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
