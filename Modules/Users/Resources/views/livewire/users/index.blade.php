<div>

    <div class="card">
        <div class="card-header">
            {{-- <h4>Simple Table</h4> --}}
            @if (akses('create-user'))
                <div class="buttons float-right">
                    <a wire:click.prevent="tambah_data" href="#" class="btn btn-icon icon-left btn-primary"><i
                            class="bi bi-clipboard-plus"></i>
                        Add Data</a>
                </div>
            @endif
        </div>
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
                <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="paging,search">
            </div>

            <div class="table-responsive" style="height: 400px;">
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <th>Action</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>No WA</th>
                            <th>Tgl Lahir</th>
                            <th style="width: 100%;">Usia</th>
                            <th>No KTP</th>
                            <th>No KK</th>
                            <th>Status Perkawinan</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                        @foreach ($data as $e => $dt)
                            <tr>
                                <td>
                                    {{-- @if ($dt->is_paten != 1) --}}
                                    <div class="dropdown d-inline">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            {{-- @if (akses('edit-user')) --}}
                                            <a class="dropdown-item has-icon" href="#"
                                                wire:click.prevent="edit_data({{ $dt->id }})"><i
                                                    class="bi bi-pencil-square"></i>
                                                Edit</a>
                                            {{-- @endif --}}

                                            @if (akses('delete-user'))
                                                <a class="dropdown-item has-icon"
                                                    onclick="return confirm('Confirm delete?') || event.stopImmediatePropagation()"
                                                    href="#" wire:click.prevent="destroy({{ $dt->id }})"><i
                                                        class="bi bi-trash3"></i>
                                                    Delete</a>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                </td>
                                <td>{{ $dt->role->name }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>{{ $dt->email }}</td>
                                <td>{{ $dt->no_hp }}</td>
                                <td>{{ date_indo($dt->tanggal_lahir) }}</td>
                                <td>{{ usia($dt->tanggal_lahir) }}</td>
                                <td>{{ $dt->no_ktp }}</td>
                                <td>{{ $dt->no_kk }}</td>
                                <td>{{ $dt->status_perkawinan }}</td>
                                <td>
                                    @if (akses('change-status-user'))
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

                                    <img wire:loading wire:target="update_status"
                                        src="{{ asset('loading-bar.gif') }}" alt="">
                                </td>
                                <td>{{ user_by($dt->created_by)['name'] }}</td>
                                <td>{{ user_by($dt->updated_by)['name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalAdd" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-header">
                            {{-- <h4>Horizontal Form</h4> --}}
                            <p style="color: red">
                                <b><i>** Password default: {{ password_default() }}</i></b>
                            </p>
                        </div>
                        <form wire:submit.prevent="store">
                            <div class="card-body">
                                {{ $message ?? '' }}
                                <div class="form-group">
                                    <label for="name">Name**</label>
                                    <input wire:model.lazy="forms.name" type="text" class="form-control" id="name"
                                        placeholder="Name">
                                    {{-- {{ $forms['name'] }} --}}
                                    @error('forms.name')
                                        <span style="color: red;" class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Email**</label>
                                        <input wire:model.lazy="forms.email" type="text" class="form-control"
                                            id="inputEmail4" placeholder="Email">
                                        @error('forms.email')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="no_hp">No WA** (Untuk Notifikasi)</label>
                                        <input wire:model.lazy="forms.no_hp" type="text" class="form-control"
                                            id="no_hp" placeholder="no_hp">
                                        @error('forms.no_hp')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="tanggal_lahir">Tgl Lahir</label>
                                        <input wire:model.lazy="forms.tanggal_lahir" type="date" class="form-control"
                                            id="tanggal_lahir" placeholder="tanggal_lahir">
                                        @error('forms.tanggal_lahir')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="no_ktp">No KTP</label>
                                        <input wire:model.lazy="forms.no_ktp" type="text" class="form-control"
                                            id="no_ktp" placeholder="no_ktp">
                                        @error('forms.no_ktp')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="no_kk">No KK</label>
                                        <input wire:model.lazy="forms.no_kk" type="text" class="form-control"
                                            id="no_kk" placeholder="no_kk">
                                        @error('forms.no_kk')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="status_perkawinan">Status Perkawinan</label>
                                        <select class="form-control" wire:model="forms.status_perkawinan">
                                            <option value="">Select Option</option>
                                            @foreach ($statuses as $rl)
                                                <option value="{{ $rl }}">{{ $rl }}</option>
                                            @endforeach
                                        </select>
                                        @error('forms.status_perkawinan')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="role_id">Role**</label>
                                        <select class="form-control" wire:model="forms.role_id">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $rl)
                                                <option value="{{ $rl->id }}">{{ $rl->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('forms.role_id')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="store">
                            </div>
                        </form>
                    </div>

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            Livewire.on('modalAdd', aksi => {

                if (aksi == 'show') {
                    $('#modalAdd').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalAdd').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>
    @endsection

</div>
