<div>
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Bordered Table</h3> --}}
            @if (akses('create-category'))
                <div class="buttons float-right">
                    <a wire:click.prevent="tambah_data" href="#" class="btn btn-icon icon-left btn-primary"><i
                            class="bi bi-clipboard-plus"></i>
                        Add Data</a>
                </div>
            @endif
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
                    <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="paging,search">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 40px">Action</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Status</th>
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
                                                @if (akses('edit-category'))
                                                    <a class="dropdown-item has-icon" href="#"
                                                        wire:click.prevent="edit_data({{ $dt->id }})"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Edit</a>
                                                @endif

                                                @if (akses('delete-category'))
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
                                <td>{{ $dt->code }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>
                                    @if (akses('edit-role'))
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalAdd" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <form wire:submit.prevent="store">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input wire:model.lazy="forms.code" type="text" class="form-control" id="code"
                                        placeholder="code">
                                    {{-- {{ $forms['code'] }} --}}
                                    @error('forms.code')
                                        <span style="color: red;" class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input wire:model.lazy="forms.name" type="text" class="form-control" id="name"
                                        placeholder="Name">
                                    {{-- {{ $forms['name'] }} --}}
                                    @error('forms.name')
                                        <span style="color: red;" class="error">{{ $message }}</span>
                                    @enderror
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
