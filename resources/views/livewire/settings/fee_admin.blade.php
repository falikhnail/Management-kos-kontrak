<div class="row">
    <div class="col-md-4">

        <div class="card card-primary">

            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="save_fee_admin">
                <div class="card-body">
                    <div class="form-group">
                        <label for="fee_admin">Fee Admin</label>
                        <input type="text" class="form-control" id="fee_admin" placeholder="Fee Admin"
                            wire:model.lazy="forms.fee_admin">
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
