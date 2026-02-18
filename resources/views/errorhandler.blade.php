@if (session('berhasil'))
    <script>
        $(document).ready(function() {
            swal({
                position: 'top-end',
                type: 'success',
                title: 'Success!',
                text: '{{ session('berhasil') }}',
                showConfirmButton: false,
                timer: 2500
            });
        })
    </script>
    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        {{ session('berhasil') }}
    </div> --}}
@endif

@if (session('gagal'))
    <script>
        swal({
            position: 'top-end',
            type: 'error',
            title: 'Gagal!',
            text: '{{ session('gagal') }}',
            // showConfirmButton: false,
            // timer: 2500
        });
    </script>
    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        {{ session('gagal') }}
    </div> --}}
@endif

@if (session('warning'))
    <script>
        swal({
            position: 'top-end',
            type: 'warning',
            title: 'Warning!',
            text: '{{ session('warning') }}',
            // showConfirmButton: false,
            // timer: 2500
        });
    </script>
    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        {{ session('gagal') }}
    </div> --}}
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach ($errors->all() as $error)
            <span>{{ $error }}</span><br>
        @endforeach
    </div>
@endif --}}
@if ($errors->any())
    <div id="errorHtml" style="display: none">
        @foreach ($errors->all() as $error)
            {{ $error }}

        @endforeach
    </div>
    <script>
        swal({
            position: 'top-end',
            type: 'error',
            title: 'Gagal!',
            text: $('#errorHtml').html(),
            // showConfirmButton: false,
            // timer: 2500
        });
    </script>
@endif


<div class="alert alert-danger alert-dismissible fade in" role="alert" id="berhasil" style="display: none;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span id="textBerhasil"></span>
</div>

<div id="gagal" style="display: none;">
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <span id="textGagal"></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
