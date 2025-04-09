@extends('app')
@section('page')

    <section class="login-form d-flex align-items-center" style="padding-bottom: 150px">
        <div class="container">
            <div class="login-form-title text-center">
                <h2>Login</h2>
            </div>
            <div class="login-form-box">
                <div class="login-card">
                    @session('error')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> Your Credentials was incorrect.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endsession
                    <form action="/login" method="POST">
                        @csrf
                        <div>
                            <input type="radio" id="parent" name="user" value="parent" checked>
                            <label for="parent" class="mr-2">Parent</label>
                            <input type="radio" id="carer" name="user" value="carer">
                            <label for="carer" class="mr-2">Carer</label>
                            <input type="radio" id="admin" name="user" value="admin">
                            <label for="admin" class="mr-2">Administrator</label>
                        </div>
                        <div class="form-group">
                            <input class="input-field form-control" type="email"  placeholder="Email" required name="email">
                        </div>
                        <div class="form-group">
                            <input class="input-field form-control" type="password" placeholder="Password" required name="password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="gdpr_consent" required class="form-check-input" id="gdprCheck">
                            <label class="form-check-label" for="gdprCheck">
                                I agree to the processing of my data in accordance with the privacy policy.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary hover-effect">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
