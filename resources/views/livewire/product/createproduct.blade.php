<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="modal fade modalAdd" id="modal-xl" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h4 class="modal-title">Extra Large Modal</h4> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data Kontrakan</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form wire:submit.prevent="store">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="category_id">Kategori**</label>
                                            <select class="form-control" wire:model="category_id" id="category_id">
                                                <option value="">Select Option</option>
                                                @foreach ($categories as $ct)
                                                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span style="color: red;" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nama**</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nama"
                                                wire:model.lazy="name">
                                            @error('name')
                                                <span style="color: red;" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="price">Harga**</label>
                                                    <input type="text" class="form-control" id="price"
                                                        placeholder="Harga" wire:model.lazy="price">
                                                    @error('price')
                                                        <span style="color: red;"
                                                            class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="durasi_pembayaran">Durasi Pembayaran**</label>
                                                    <select class="form-control" id="durasi_pembayaran"
                                                        wire:model.lazy="durasi_pembayaran">
                                                        <option value="">Select Option</option>
                                                        @foreach ($durasis as $dr)
                                                            <option value="{{ $dr['name'] }}">{{ $dr['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('durasi_pembayaran')
                                                        <span style="color: red;"
                                                            class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="no_rumah">No Rumah</label>
                                                    <input type="text" class="form-control" wire:model.lazy="no_rumah"
                                                        placeholder="No Rumah">
                                                    @error('no_rumah')
                                                        <span style="color: red;"
                                                            class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="note">Desc</label>
                                                    <textarea class="form-control" wire:model.lazy="note" id="note" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    <textarea class="form-control" wire:model.lazy="address" id="address" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="photo"
                                                        wire:model="photo">
                                                    <label class="custom-file-label" for="photo">Choose
                                                        file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>

                                            @if ($photo)
                                                <center>
                                                    {{-- Photo Preview: --}}
                                                    <img style="width: 200px;" src="{{ $photo->temporaryUrl() }}">
                                                </center>
                                            @endif

                                            {{-- <img wire:loading wire:target="photo"
                                                src="{{ asset('loading-bar.gif') }}" alt=""> --}}
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
