@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                    {{ __('Reset Password') }}
                    </p>
                </header>
                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="content">
                        <form method="POST" action="{{ url('/reset_password_without_token') }}">
                            @csrf
    
                            <div class="field">
                                <label class="label">{{ __('E-Mail Address') }}</label>
    
                                <div class="control">
                                    <input id="email" type="email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-link">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
