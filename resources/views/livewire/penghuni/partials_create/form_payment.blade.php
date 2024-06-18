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
    <div class="card">
        <div class="card-header">
            <h5>Pembayaran Pertama</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" class="form-control" wire:model.lazy="forms.nominal">
                        @error('forms.nominal')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Pembayaran</label>
                        <input wire:model.lazy="forms.tanggal_pembayaran" type="date" class="form-control"
                            id="tanggal_pembayaran" placeholder="tanggal_pembayaran">
                        @error('forms.tanggal_pembayaran')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select class="form-control" wire:model.lazy="forms.status_pembayaran">
                            <option value="">Select Option</option>
                            @foreach ($status_pembayarans as $e => $sp)
                                <option value="{{ $e }}">{{ $sp }}</option>
                            @endforeach
                        </select>
                        @error('forms.status_pembayaran')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
    </div>
</div>
