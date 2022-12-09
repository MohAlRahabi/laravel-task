@extends('dashboard.auth.layout.auth_layout')

@section('content')

    <div class="login-box">
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <a href="{{route('home')}}"><img width="170" src="{{asset('images/logo.png')}}" alt="logo"></a>
            </div>
            <div class="card-body">

                <form class="form-horizontal m-t-30" method="POST" action="{{route('register')}}">
                    @csrf
                    <input type="hidden" id="uuid" name="uuid" value="">
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
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
                        <input id="password" type="password" min="8" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
                    <div class="input-group mb-3">
                        <input id="password_confirmation" type="password" min="8" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
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

                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-dark w-md waves-effect waves-light" type="submit">Register</button>
                        </div>
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
