@extends('app')

@section('page')
    <div class="banner-container-comming-soon py-4">
        <div class="container">
            <form action="/search" method="GET" class="input-group input-field-form">
                <input style="text-transform: uppercase" maxlength="3"
                       type="text" class="form-control input-form-input" value=""
                       placeholder="Enter your post Code..." name="q" required="">
                <div class="input-group-append form-button">
                    <button type="submit" class="btn btn-form-section">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow p-4">
        <form action="/profile/update/carer" method="POST" enctype="multipart/form-data">
            @csrf

            <h2 class="text-center mb-4">Edit Profile</h2>

            {{-- Name & Location --}}
            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">Full Name</label>
                <div class="col-md-9">
                    <input type="text" name="name" class="form-control" value="{{ $profile->name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">Location</label>
                <div class="col-md-9">
                    <input type="text" name="location" class="form-control" value="{{ $profile->location }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">Service Areas</label>
                <div class="col-md-9">
                    <input type="text" name="service_area" class="form-control"
                           value="{{ implode(', ', json_decode($profile->service_area)) }}" required>
                    <small class="text-muted">Separate areas by commas (e.g., Manchester, Leeds)</small>
                </div>
            </div>

            {{-- Contact Info --}}
            <hr>
            <h5 class="text-primary mb-3">Contact Information</h5>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">WhatsApp Number</label>
                <div class="col-md-9">
                    <input type="text" name="whatsapp" class="form-control" value="{{ $profile->whatsapp }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">Phone</label>
                <div class="col-md-9">
                    <input type="text" name="phone" class="form-control" value="{{ $profile->phone }}">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label text-md-end">Email</label>
                <div class="col-md-9">
                    <input type="email" name="email" class="form-control" value="{{ $profile->email }}">
                </div>
            </div>

            {{-- About Me --}}
            <hr>
            <h5 class="text-primary mb-3">About Me</h5>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label text-md-end">Bio</label>
                <div class="col-md-9">
                    <textarea name="about" class="form-control" rows="4">{{ strip_tags($profile->about) }}</textarea>
                </div>
            </div>

            {{-- Experience --}}
            <hr>
            <h5 class="text-primary mb-3">Experience</h5>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label text-md-end">Experience (Years)</label>
                <div class="col-md-9">
                    <input type="number" name="experience" class="form-control" value="{{ $profile->experience }}">
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label text-md-end">Training & Qualities</label>
                <div class="col-md-9">
                    <textarea name="training" class="form-control" rows="3">{{ $profile->training }}</textarea>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-success px-5">
                    💾 Save Profile
                </button>
            </div>
        </form>
    </div>
@endsection
