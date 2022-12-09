@extends('dashboard.auth.layout.auth_layout')

@section('content')
<div class="login-box">
    <div class="card card-outline card-dark">
        <div class="card-header text-center">
            <a href="{{route('home')}}"><img width="170" src="{{asset('images/logo.png')}}" alt="logo"></a>
        </div>
        <div class="card-body">

            <form action="{{route('login')}}" method="post">
                @csrf
                <input type="hidden" id="uuid" name="uuid" value="">
                <div class="input-group mb-3">
                    <input id="username" type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <p>don't have account <a href="{{route('register')}}">register</a></p>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-dark btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection


@push('scripts')
    <script>
        $(function () {
            let hasEnteredBefore = localStorage.getItem('uuid');
            console.log(hasEnteredBefore)
            $.ajax({
                url: "{{route('generate_uuid')}}",
                success: function (data) {
                    if(hasEnteredBefore == null ) {
                        hasEnteredBefore = data.uuid
                        localStorage.setItem('uuid', data.uuid);
                    }
                    $("#uuid").val(hasEnteredBefore);
                }
            })
        })
    </script>
@endpush
