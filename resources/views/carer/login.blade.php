@extends('app')

@section('page')
    <section class="login-form d-flex align-items-center" style="padding-bottom: 150px">
        <div class="container">
            <div class="login-form-title text-center mb-4">
                <h2>Register As a Carer</h2>
            </div>

            <div class="login-form-box">
                <div class="login-card">

                    <form method="POST" action="/register-as-carer">
                        @csrf
                        <!-- Tab Navs -->
                        <ul class="nav nav-tabs mb-4" id="carerTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-basic" data-toggle="tab" href="#tab1" role="tab">Basic Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-details" data-toggle="tab" href="#tab2" role="tab">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account" data-toggle="tab" href="#tab3" role="tab">Account</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="carerTabContent">

                            <!-- Tab 1: Basic Info -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                <div class="form-group">
                                    <input class="input-field form-control" type="text" name="name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input class="input-field form-control" type="text" name="whatsapp" value="+440" placeholder="WhatsApp number with Country Code">
                                </div>
                                <div class="form-group">
                                    <input class="input-field form-control" type="text" name="location" id="location" placeholder="Location">
                                </div>
                                <div class="nav nav-tabs text-center mt-3">
                                    <a class="nav-link btn btn-primary hover-effect" id="tab-details" data-toggle="tab" href="#tab2" role="tab">Next</a>
                                </div>

                            </div>

                            <!-- Tab 2: Details -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel">
                                <div class="form-group">
                                    <input class="input-field form-control" type="number" name="experience" placeholder="Experience (e.g., 3 years)">
                                </div>
                                <div class="form-group">
                                    <textarea class="input-field form-control" name="about" style="height:150px;line-height: 25px" placeholder="About You"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="input-field form-control" type="text" name="service_area"

                                           placeholder="Service Areas: e.g HD1,HD2,HD12">
                                </div>
                                <div class="form-group">
                                    <input class="input-field form-control" type="text" name="training" placeholder="Training or Certifications">
                                </div>
                                <div class="nav nav-tabs text-center mt-3">
                                    <a class="nav-link btn btn-primary hover-effect" id="tab-accounts" data-toggle="tab" href="#tab3" role="tab">Next</a>
                                </div>
                            </div>

                            <!-- Tab 3: Account -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel">
                                <div class="form-group">
                                    <input class="input-field form-control" type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input class="input-field form-control" type="text" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="form-group">
                                    <input class="input-field form-control" type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="gdpr_consent" required class="form-check-input" id="gdprCheck">
                                    <label class="form-check-label" for="gdprCheck">
                                        I agree to the processing of my data in accordance with the privacy policy.
                                    </label>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary hover-effect">Register</button>
                                </div>
                            </div>
                        </div>
                                    <a class="text-center" href="/login">Have you registered? Login Now</a>

                        <!-- Submit Button -->

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
