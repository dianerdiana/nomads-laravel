@extends('layouts.app')

@section('title', 'Detail Travel')

@section('content')
  <main>
    <section class="section-details-header"></section>
    <section class="section-details-contents">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">Paket Travel</li>
                <li class="breadcrumb-item active">Details</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 pl-lg-0">
            <div class="card card-details">
              <h1>{{ $item->title }}</h1>
              <p>{{ $item->location }}</p>
              @if ($item->galleries->count())
                <div class="gallery">
                  <div class="xzoom-container">
                    <img src="{{ Storage::url($item->galleries->first()->image) }}" class="xzoom img-fluid img-cover"
                      style="max-height: 400px" id="xzoom-default"
                      xoriginal="{{ Storage::url($item->galleries->first()->image) }}" />
                  </div>
                  <div class="xzoom-thumbs">
                    @foreach ($item->galleries as $gallery)
                      <a href="{{ Storage::url($gallery->image) }}">
                        <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery img-cover" width="127"
                          xpreview="{{ Storage::url($gallery->image) }}" style="max-height: 75px" />
                      </a>
                    @endforeach
                  </div>
                </div>
              @else
              @endif
              <h2>Tentang Wisata</h2>
              <p>
                {!! $item->about !!}
              </p>
              <div class="row features">
                <div class="col-md-4">
                  <div class="description">
                    <img src="{{ asset('frontend/assets/icons/ic_event.png') }}" alt="" class="features-image" />
                    <div class="description">
                      <h3>Featured Event</h3>
                      <p>{{ $item->featured_event }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 border-left">
                  <div class="description">
                    <img src="{{ asset('frontend/assets/icons/ic_language.png') }}" alt=""
                      class="features-image" />
                    <div class="description">
                      <h3>Language</h3>
                      <p>{{ $item->language }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 border-left">
                  <div class="description">
                    <img src="{{ asset('frontend/assets/icons/ic_foods.png') }}" alt="" class="features-image" />
                    <div class="description">
                      <h3>Foods</h3>
                      <p>{{ $item->foods }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-details card-right">
              <h2>Members are going</h2>
              <div class="members my-2">
                <img src="{{ url('frontend/assets/images/profile-1.png') }}" class="member-image me-0" />
                <img src="{{ url('frontend/assets/images/profile-2.png') }}" class="member-image me-1" />
                <img src="{{ url('frontend/assets/images/profile-3.png') }}" class="member-image me-1" />
                <img src="{{ url('frontend/assets/images/profile-4.png') }}" class="member-image me-1" />
                <img src="{{ url('frontend/assets/images/profile-5.png') }}" class="member-image me-1" />
              </div>
              <hr />
              <h2>Trip Informations</h2>
              <table class="trip-informations">
                <tr>
                  <th width="50%" class="thead">Date of Departure</th>
                  <td width="50%" class="text-end tcell">
                    {{ \Carbon\Carbon::create($item->departure_date)->format('m F, Y') }}
                  </td>
                </tr>
                <tr>
                  <th width="50%" class="thead">Durations</th>
                  <td width="50%" class="text-end tcell">{{ $item->duration }}</td>
                </tr>
                <tr>
                  <th width="50%" class="thead">Type</th>
                  <td width="50%" class="text-end tcell">{{ $item->type }}</td>
                </tr>
                <tr>
                  <th width="50%" class="thead">Price</th>
                  <td width="50%" class="text-end tcell">${{ $item->price }},00 / person</td>
                </tr>
              </table>
            </div>
            <div class="join-container">
              @auth
                <form class="d-grid gap-2" action="{{ route('checkout-process', $item->id) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-block btn-join-now mt-3 py-2">
                    Join Now
                  </button>
                </form>
              @endauth
              @guest
                <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">
                  Login or Register to join
                </a>
              @endguest
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@push('prepend-style')
  <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}" />
@endpush

@push('addon-script')
  <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.xzoom, .xzoom-gallery').xzoom({
        zoomWidth: 500,
        title: false,
        tint: '#333',
        Xoffset: 15,
      })
    })
  </script>
@endpush
