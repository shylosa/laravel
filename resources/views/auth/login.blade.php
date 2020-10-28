@extends('layouts.app')

@section('content')
  <div class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="leave-comment mr0">
            @if(session('status'))
              <div class="alert alert-danger">{{ session('status') }}</div>
            @endif
              <h3 class="text-uppercase">{{ __('main.login') }}</h3>
            @include('admin.errors')
            <br>
            <form class="form-horizontal contact-form" role="form" method="post" action="{{ route('login') }}">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-md-12">
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                         placeholder="{{ __('main.email')}}">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('main.password') }}">
                </div>
              </div>
              <button type="submit" class="btn send-btn capitalize">{{ __('main.login') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection