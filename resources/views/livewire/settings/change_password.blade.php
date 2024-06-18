<div class="row">
    <div class="col-md-4">

        <div class="card card-primary">

            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="change_password">
                <div class="card-body">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" wire:model.lazy="forms.password"
                            placeholder="Password" autocomplete="off">
                        @error('forms.password')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            wire:model.lazy="forms.password_confirmation" placeholder="Password Conf"
                            autocomplete="off">
                        @error('forms.password_confirmation')
                            <span style="color: red;" class="error">{{ $message }}</span>
                        @enderror
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
