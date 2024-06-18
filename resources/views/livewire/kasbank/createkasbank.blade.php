<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="row">
        <div class="col-md-12">

            <form wire:submit.prevent="store">

                <div class="card card-primary">
                    {{-- <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" wire:model="forms.type">
                                        <option value="">Select Option</option>
                                        @foreach ($types as $e => $tp)
                                            <option value="{{ $e }}">{{ $tp }}</option>
                                        @endforeach
                                    </select>
                                    @error('forms.type')
                                        <span style="color: red;" class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="transaction_date">Transaction Date</label>
                                    <input type="date" class="form-control" id="transaction_date"
                                        placeholder="Transaction Date" wire:model="forms.transaction_date">
                                    @error('forms.transaction_date')
                                        <span style="color: red;" class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" id="note" cols="30" rows="1" wire:model="forms.note"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card card-primary">
                    <!-- /.card-header -->
                    <div class="card-body">

                        @foreach ($forms['lines'] as $e => $fm)
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" placeholder="Amount"
                                            wire:model.lazy="forms.lines.{{ $e }}.amount">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        <input type="text" class="form-control" placeholder="note"
                                            wire:model.lazy="forms.lines.{{ $e }}.note">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        <p>
                                            <button wire:click.prevent="delete_line({{ $e }})"
                                                class="btn btn-danger btn-md"><i class="fa fa-trash"></i></button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button wire:click.prevent="add_line" class="btn btn-primary btn-xs"><i class="fa fa-plus">
                                Tambah Baris
                                Baru</i></button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('kasbank/index') }}" type="submit" class="btn btn-app bg-warning">
                            <i class="fas fa-backward"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-app bg-success">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading wire:target="store">
                    </div>
                    <!-- /.card-body -->
                </div>

            </form>

        </div>
    </div>
</div>
