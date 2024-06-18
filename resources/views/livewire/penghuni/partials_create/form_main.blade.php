<div class="card card-default">
    {{-- <div class="card-header">
            <h3 class="card-title">Select2 (Default Theme)</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div> --}}
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Pilih User:</label>

                    <div class="input-group">
                        <div class="input-group-prepend" style="cursor: pointer;" wire:click.prevent="create_user">
                            <span class="input-group-text"><i class="bi bi-person-plus"></i></span>
                        </div>
                        <input type="text" wire:click.prevent="modal_user" class="form-control"
                            wire:model.lazy="forms.name" readonly placeholder="Pilih User Disini..">
                        @error('forms.name')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                        <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                            wire:target="modal_user,create_user">
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" class="form-control" wire:model.lazy="forms.no_hp">
                    @error('forms.no_hp')
                        <span style="color: red;" class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">

                <div class="form-group">
                    <label>No KTP</label>
                    <input type="text" class="form-control" wire:model.lazy="forms.no_ktp">
                    @error('forms.no_ktp')
                        <span style="color: red;" class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input wire:model.lazy="forms.tanggal_lahir" type="date" class="form-control" id="tanggal_lahir"
                        placeholder="tanggal_lahir">
                    @error('forms.tanggal_lahir')
                        <span style="color: red;" class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
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
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Data Produk</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                        </div>
                        <input type="text" wire:click.prevent="modal_product" class="form-control"
                            wire:model.lazy="forms.product_name" readonly placeholder="Pilih Produk Disini..">
                        @error('forms.product_name')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                        <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="modal_product">
                    </div>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input wire:model.lazy="forms.tanggal_masuk" type="date" class="form-control" id="tanggal_masuk"
                        placeholder="tanggal_masuk">
                    @error('forms.tanggal_masuk')
                        <span style="color: red;" class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->
</div>
