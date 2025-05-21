@extends ('layouts.app')

@section('content')
<section class="home-section section-hero overlay bg-image" style="background-image: url(' {{ asset('assets/images/hero_1.jpg') }} ');" id="home-section">
  <a href="#next" class="scroll-button smoothscroll">
    <span class=" icon-keyboard_arrow_down"></span>
  </a>
</section>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mt-5">DASHBOARD</h5>
          <h6 class="card-subtitle mb-2 text-muted">Welcome,{{ Auth::user()->name }} </h6>
          <p class="card-text">You are logged in.</p>
       

          <div class="p-4 bg-green-100">
          {{ Auth::user()->email }}
          </div>

          <p>

            <strong>Welcome to the Admin Dashboard!</strong><br>
            Here you can manage all aspects of the application, including users, roles, and permissions.
          </p>

        </div>
        @foreach ($users as $user)
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">{{ $user->email }}</p>

          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>