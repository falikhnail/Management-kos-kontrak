<div>
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent="store">
        @include('livewire.penghuni.partials_create.form_main')

        @include('livewire.penghuni.partials_create.form_payment')

        <div class="card">
            {{-- <div class="card-header">
            <h3 class="card-title">Application Buttons</h3>
        </div> --}}
            <div class="card-body">
                {{-- <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a&gt;</code> tag to achieve the following:</p> --}}
                <a class="btn btn-app bg-warning" href="{{ url('penghuni/index') }}">
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

    @livewire('penghuni.modalusers')
    @livewire('penghuni.createuser')
    @livewire('penghuni.modalproduct')

    @section('scripts')
        <script>
            Livewire.on('modalUser', aksi => {

                if (aksi == 'show') {
                    $('#modalUser').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalUser').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>

        <script>
            Livewire.on('modalCreateUser', aksi => {

                if (aksi == 'show') {
                    $('#modalCreateUser').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalCreateUser').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>

        <script>
            Livewire.on('modalProduct', aksi => {

                if (aksi == 'show') {
                    $('#modalProduct').modal('show');
                } else {
                    // alert(aksi);
                    $('#modalProduct').modal('hide');
                    // $('#modalAdd').hide();
                    // $('#modalAdd').find('.close').click();
                }

            })
        </script>
    @endsection
</div>
