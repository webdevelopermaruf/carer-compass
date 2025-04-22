@extends('app')
@section('page')

    <section class="login-form d-flex align-items-center" style="padding-bottom: 150px">
        <div class="container">
            <div class="login-form-title text-center">
                <h2>Change Password</h2>
            </div>
            <div class="login-form-box">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    @if (session('success'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                <div class="login-card">
                    <form action="/reset-password" method="POST">
                        @csrf
                        <input type="hidden" name="reset_token" value="{{$token}}">
                        <input type="hidden" name="email" value="{{request()->query('email')}}">
                        <div class="form-group">
                            <input class="input-field form-control" type="password" placeholder="Password" required name="password">
                        </div>
                        <div class="form-group">
                            <input class="input-field form-control" type="password" placeholder="Password" required name="password_confirmation">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="gdpr_consent" required class="form-check-input" id="gdprCheck">
                            <label class="form-check-label" for="gdprCheck">
                                I agree to the processing of my data in accordance with the privacy policy.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary hover-effect">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
