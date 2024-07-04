@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<img src="assets/images/logo.png" alt="" class="img-fluid mb-4">
		<div class="card borderless">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="card-body">
						<h4 class="f-w-400 text-center">Sign up</h4>
						<hr>
                        <form method="POST" action="{{ route('register') }}">
                        @csrf
						<div class="form-group mb-3">
							<input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" id="nama"  placeholder="Nama">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
                        <div class="form-group mb-3">
							<input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" id="no_hp"  placeholder="No HP">
                            @error('no_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-group mb-3">
							<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="Email" placeholder="Email address">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="form-group mb-4">
							<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" id="Password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
                        <div class="form-group mb-4">
                            <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label d-block">Status Sebagai:</label>
                            @php
                            $ar_status = ['Ketua','Sekretaris','Bendahara','Staff'];
                            @endphp
                            @foreach($ar_status as $status)
                            @php
                                $cek = (old('status') == $status)? 'checked':'';
                            @endphp
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('status') is-invalid @enderror"  type="radio" name="status" value="{{ $status }}" {{ $cek }}>
                                <label class="form-check-label" for="gridRadios1">
                                    {{ $status }}
                                </label>
                            </div>
                            @endforeach
                            </br>
                            @error('status')
                                <span class="invalid-feedback d-inline" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
						<div class="custom-control custom-checkbox  text-left mb-4 mt-2">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label class="custom-control-label" for="customCheck1">Remember me.</label>
						</div>
						<button class="btn btn-primary btn-block mb-4">Registrasi</button>
						<hr>
						<p class="mb-2">Sudah punya akun? <a href="{{ route('login') }}" class="f-w-400">Login</a></p>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signup ] end -->
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
{{-- </div> --}}
@endsection
