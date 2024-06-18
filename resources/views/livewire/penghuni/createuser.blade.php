<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div id="modalCreateUser" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah User Baru</h5>
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name**</label>
                                            <input wire:model.lazy="forms.name" type="text" class="form-control"
                                                id="name" placeholder="Name">
                                            {{-- {{ $forms['name'] }} --}}
                                            @error('forms.name')
                                                <span style="color: red;" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Email**</label>
                                                <input wire:model.lazy="forms.email" type="text" class="form-control"
                                                    id="inputEmail4" placeholder="Email">
                                                @error('forms.email')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="no_hp">No HP**</label>
                                                <input wire:model.lazy="forms.no_hp" type="text" class="form-control"
                                                    id="no_hp" placeholder="no_hp">
                                                @error('forms.no_hp')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="tanggal_lahir">Tgl Lahir</label>
                                                <input wire:model.lazy="forms.tanggal_lahir" type="date"
                                                    class="form-control" id="tanggal_lahir"
                                                    placeholder="tanggal_lahir">
                                                @error('forms.tanggal_lahir')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="no_ktp">No KTP</label>
                                                <input wire:model.lazy="forms.no_ktp" type="text" class="form-control"
                                                    id="no_ktp" placeholder="no_ktp">
                                                @error('forms.no_ktp')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="no_kk">No KK</label>
                                                <input wire:model.lazy="forms.no_kk" type="text" class="form-control"
                                                    id="no_kk" placeholder="no_kk">
                                                @error('forms.no_kk')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
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
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="role_id">Role**</label>
                                                <select class="form-control" wire:model="forms.role_id">
                                                    <option value="">Select Role</option>
                                                    @foreach ($roles as $rl)
                                                        <option value="{{ $rl->id }}">{{ $rl->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('forms.role_id')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

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

            </div>
        </div>
    </div>
</div>
