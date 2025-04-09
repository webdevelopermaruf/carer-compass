@extends('app')

@section('page')
    <div class="banner-container-comming-soon" style="padding-bottom: 20px">
        <div class="container">
            <div class="row">
                <form action="/search" method="GET" class="input-group mb-3 input-field-form">
                    <input style="text-transform: uppercase" type="text" class="form-control input-form-input"
                           value="{{request()->query('q')}}"  maxlength="3"
                           placeholder="Enter your post Code..." name="q" required>
                    <div class="input-group-append form-button">
                        <button type="submit" class="btn btn-form-section">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mr-5">
        {{ $carers->appends(request()->query())->links() }}
    </div>
    <div class="profile-container" style="margin-bottom: 137px">
        @forelse ($carers as $carer)
        <div class="profile-card" style="max-width: 350px;">
            <div class="profile-image">
                <div class="avatar">{{$carer->name[0]}}</div>
            </div>
            <div class="profile-content">
                <h3 class="profile-name">{{$carer->name}} <i class="fas fa-check-circle verified"></i></h3>
                <p class="location">{{$carer->location}}</p>
                <p class="response-time">⚡ Service Areas - {{ implode(', ', json_decode($carer->service_area)) }} </p>
                <p class="description">
                    {{substr($carer->about, 0, 100)}}...
                </p>
                <div class="icons">
                   {{$carer->training}}
                </div>
                <a href="/profile/{{$carer->id}}">
                    <button  class="custom-btn"><i class="fas fa-book"></i> Read More</button>
                </a>
            </div>

        </div>
            @empty
            <h2>Sorry ! No Carer Found.</h2>
        @endforelse
    </div>
@endsection
