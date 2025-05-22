@extends ('layouts.app')

@section('content')
<!-- <section class="home-section section-hero overlay bg-image" style="background-image: url(' {{ asset('assets/images/hero_1.jpg') }} ');" id="home-section"> -->
<section>
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
        <ol class="list-group list-group-flush">
          <li class="list-group-item">Users</li>
          <li class="list-group-item">Roles</li>
          <li class="list-group-item">Permissions</li>
          <li class="list-group-item">Settings</li>
          <li class="list-group-item">Reports</li>
          <li class="list-group-item">Logs</li>
          <li class="list-group-item">Notifications</li>
          <li class="list-group-item">Analytics</li>
          <li class="list-group-item">Integrations</li>
          <li class="list-group-item">Support</li>
          <li class="list-group-item">Documentation</li>
        </ol>

        @foreach ($users as $user)

        <div class="row g-0">
          <div class="col">
            <img src="{{ asset('assets/images/user.png') }}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col">
            {{$user->id}}
          </div>
          <div class="col">
            {{ $user->name }}
          </div>
          <div class="col">
            @if ($user->is_admin)
            <span class="badge bg-success">Admin</span>
            @else
            <span class="badge bg-secondary">User</span>
            @endif
          </div>
          <div class="col">
            @if ($user->is_active)
            <span class="badge bg-success">Active</span>
            @else
            <span class="badge bg-danger">Inactive</span>
            @endif
          </div>
          <div class="col">
            @if ($user->is_verified)
            <span class="badge bg-success text-white">Verified</span>
            @else
            <span class="badge bg-danger text-white">Not Verified</span>
            @endif
          </div>
          <div class="col">
            {{ $user->email }}
          </div>

          <div class="col">
            Last updated {{ $user->updated_at }}
          </div>
          <div class="col">
            <a href="{{ route('admins.edit', $user->id) }}" class="btn btn-primary">Edit</a>
            <!-- <a href="{{ route('admins.delete', $user->id) }}" class="btn btn-danger">Delete</a> -->
          </div>
          <div class="col">
            <form action="{{ route('admins.delete', $user->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </div>
          <div class="col">
            Created at {{ $user->created_at }}
          </div>
        </div>

        @endforeach

      </div>
    </div>
  </div>