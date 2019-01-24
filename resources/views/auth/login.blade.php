@extends('admin.layouts.app')

@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
  <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
    <div class="row w-100">
      <div class="col-lg-4 mx-auto">
        <div class="auto-form-wrapper">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
              <label class="label">Email</label>

              <div class="input-group has-danger">
                <input type="email" class="form-control {{ $errors->has('email') ? 'border-danger': '' }}" 
                  name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="mdi mdi-check-circle-outline"></i>
                  </span>
                </div>
              </div>

              @if ($errors->has('email'))
                <label id="cname-error" class="error mt-2 text-danger" for="email">
                  {{ $errors->first('email') }}
                </label>
              @endif
            </div>
            
            <!-- Password -->
            <div class="form-group">
              <label class="label">Password</label>

              <div class="input-group">
                <input type="password" class="form-control {{ $errors->has('email') ? 'border-danger': '' }}" 
                  name="password" placeholder="*********" required>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="mdi mdi-check-circle-outline"></i>
                  </span>
                </div>
              </div>

              @if ($errors->has('password'))
                <label id="cname-error" class="error mt-2 text-danger" for="password">
                  {{ $errors->first('password') }}
                </label>
              @endif
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
            </div>

            <div class="form-group d-flex justify-content-between">
              <div class="form-check form-check-flat mt-0">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
              </div>
              <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
            </div>

          {{--   <div class="form-group">
              <button class="btn btn-block g-login">
                <img class="mr-3" src="../../../assets/images/file-icons/icon-google.svg" alt="">Log in with Google</button>
            </div>
            <div class="text-block text-center my-3">
              <span class="text-small font-weight-semibold">Not a member ?</span>
              <a href="register.html" class="text-black text-small">Create new account</a>
            </div> --}}
          </form>
        </div>
        <ul class="auth-footer">
          <li>
            <a href="#">Conditions</a>
          </li>
          <li>
            <a href="#">Help</a>
          </li>
          <li>
            <a href="#">Terms</a>
          </li>
        </ul>
        <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
</div>
@endsection