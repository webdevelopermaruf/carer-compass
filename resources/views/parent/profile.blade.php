@extends('app')

@section('page')
    <div class="banner-container-comming-soon" style="padding-bottom:20px;">
        <div class="container">
            <div class="row">
                <form action="/search" method="GET" class="input-group input-field-form">
                    <input style="text-transform: uppercase"  maxlength="3"
                           type="text" class="form-control input-form-input" value=""
                           placeholder="Enter your post Code..." name="q" required="">
                    <div class="input-group-append form-button">
                        <button type="submit" class="btn btn-form-section">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="profile-container">
        <div class="profile-card-details" style="width: 100%">
            <div class="profile-header">
                <div class="profile-info">
                    <div class="d-flex">
                        <div class="avatar mr-3">{{$profile->name[0]}}</div>
                        <h2>{{$profile->name}}</h2>
                    </div>
                    <p>Located in {{$profile->address}}</p>
                </div>
            </div>
            <a href="/account/delete" class="btn btn-danger">Delete Account</a>
        </div>
    </div>
@endsection
