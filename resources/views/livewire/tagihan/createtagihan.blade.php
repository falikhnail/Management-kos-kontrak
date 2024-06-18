<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div id="modalCreateTagihan" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form wire:submit.prevent="store">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>Search User / Product</label>
                                            <input type="text" class="form-control"
                                                placeholder="Search User/Product.." wire:model="search_penghuni">
                                            @error('forms.user_name')
                                                <span style="color: red;" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                                            wire:target="search_penghuni">
                                        <!-- /.form-group -->
                                        @if ($search_penghuni)
                                            <div class="card">
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <ul>
                                                        @foreach ($hasil_search_penghuni as $e => $hs)
                                                            <li wire:click.prevent="select_penghuni({{ $hs->id }})"
                                                                style="cursor: pointer">
                                                                {{ $hs->user->name . ' | ' . $hs->product->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        @endif

                                    </div>

                                    @if ($forms['user_name'])
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input type="text" class="form-control" wire:model="forms.user_name"
                                                    readonly>
                                                {{-- @error('forms.user_name')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror --}}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control"
                                                    wire:model="forms.product_name" readonly>
                                                {{-- @error('forms.product_name')
                                                    <span style="color: red;"
                                                        class="error">{{ $message }}</span>
                                                @enderror --}}
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>Nominal</label>
                                            <input type="text" class="form-control" wire:model.lazy="forms.amount">
                                            @error('forms.amount')
                                                <span style="color: red;" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Transaction Date</label>
                                            <input wire:model.lazy="forms.transaction_date" type="date"
                                                class="form-control" id="transaction_date"
                                                placeholder="transaction_date">
                                            @error('forms.transaction_date')
                                                <span style="color: red;" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>Status Pembayaran</label>
                                            <select class="form-control" wire:model.lazy="forms.status">
                                                <option value="">Select Option</option>
                                                @foreach ($status_pembayarans as $e => $sp)
                                                    <option value="{{ $e }}">{{ $sp }}</option>
                                                @endforeach
                                            </select>
                                            @error('forms.status')
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

                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="{{ asset('loading-bar.gif') }}" alt="" wire:loading
                                            wire:target="store" class="float-right">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
