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
                       <div class="avatar mr-3">{{$carer->name[0]}}</div>
                       <h2>{{$carer->name}}</h2>
                   </div>
                    <p>Located in {{$carer->location}}</p>
                    <p class="response-time">⚡ Service Areas - {{ implode(', ', json_decode($carer->service_area)) }} </p>
                </div>
            </div>
            <div class="profile-actions">
                <a href="https://wa.me/{{$carer->whatsapp}}" class="btn btn-lg btn-success">💬 Chat on WhatsApp</a>
                <a href="tel:{{$carer->phone}}" class="btn btn-lg btn-warning">📲 Mobile</a>
                <a href="mailto:{{$carer->email}}" class="btn btn-dark btn-lg">✉ Email</a>
            </div>

            <div class="profile-summary">
                <h3 class="text-center pt-5" style="color: #3b579d">About Me</h3>
                <p class="px-5 py-3" style="font-size: 16px; color: rgb(89, 88, 88);">
                    {!! $carer->about !!}
                </p>
            </div>
            <div class="profile-summary">
                <h3 class="text-center" style="color: #3b579d">My Experience</h3>
                <p style="font-size: 16px; color: rgb(89, 88, 88);">
                I have over {{$carer->experience}}+ experience on this.
                    My Training & Qualities are:
                    <li>{{$carer->training}}</li>
                </p>
            </div>
            <div class="container" style="padding-bottom: 50px; padding-top:20px;">
                <h3 class="text-center mb-4" style="color: #3b579d">📝 Reviews</h3>

                {{-- Only show review form for authenticated parent user --}}
                @auth('parent')
                    <div class="mb-4 text-left">
                        <div class="card-header bg-primary text-white">Leave a Review</div>
                        <div class="card-body">
                            <form action="/leave-review/{{$carer->id}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="rating">Rating (1-5)</label>
                                    <select class="form-control" name="rating" required>
                                        <option value="">Select Rating</option>
                                        @for($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" rows="4" class="form-control" placeholder="Write your review..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Submit Review</button>
                            </form>
                        </div>
                    </div>
                @endauth

                @if(!auth()->guard('parent')->user())
                    <h4>If you want to leave review please <a style="font-size: 22px" href="/register-as-parent">Register as parent</a></h4>
                @endif

                {{-- Past Reviews --}}
                <div>
                    <div class="card-header bg-secondary text-white">Recent Reviews</div>
                    <div class="card-body text-left">
                        @if($carer->review)
                            @foreach($carer->review as $review)
                                <div class="border-bottom mb-3 pb-2">
                                    <strong>{{ $review->parent->name ?? 'Anonymous' }}</strong>
                                    <span class="text-warning">
                            @for($i = 0; $i < $review->rating; $i++) ★ @endfor
                        </span>
                                    <p class="mb-1">{{ $review->review_body }}</p>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No reviews yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Review Section --}}


@endsection
