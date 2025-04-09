@extends('app')
@section('page')

    <section class="login-form d-flex align-items-center" style="padding-bottom: 150px">
        <div class="container">
            <div class="login-form-title text-center">
                <h2>Register As a Parent</h2>
            </div>
            <div class="login-form-box">
                <div class="login-card">
                    <form action="/register-as-parent" method="POST">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $error }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @csrf
                        <div class="form-group">
                            <input class="input-field form-control" type="text" placeholder="Name" required name="name">
                        </div>
                        <div class="form-group">
                            <input class="input-field form-control" type="email"  placeholder="Email" required name="email">
                        </div>
                        <div class="form-group">
                            <input class="input-field form-control" type="text" value="+440" placeholder="Phone" required name="phone">
                        </div>
                        <div class="form-group">
                            <input class="input-field form-control" type="password" placeholder="Password"
                                   pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':&quot;\\|,.<>\/?]).{8,}$"
                                   required="true" name="password">
                        </div>
                        <div class="form-group">
                            <input class="input-field form-control" id="location" type="text" placeholder="Address" required name="address">
                        </div>
                       <div class="form-check">
                                <input type="checkbox" name="gdpr_consent" required class="form-check-input" id="gdprCheck">
                                <label class="form-check-label" for="gdprCheck">
                                    I agree to the processing of my data in accordance with the privacy policy.
                                </label>
                       </div>
                        <button type="submit" class="btn btn-primary hover-effect">Register</button>
                            <a class="text-center" href="/login">Have you registered? Login Now</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@ideal-postcodes/address-finder-bundled"></script>
    <script>
        IdealPostcodes.AddressFinder.setup({
            apiKey: "ak_test",
            inputField: "#location",
            onAddressRetrieved: (address) => {
                const result = [
                    address.line_1,
                    address.line_2,
                    address.line_3,
                    address.post_town,
                    address.postcode
                ]
                    .filter((elem) => elem !== "")
                    .join(", \n");
                document.getElementById("location").value = result;
            }
        });
    </script>
@endsection
