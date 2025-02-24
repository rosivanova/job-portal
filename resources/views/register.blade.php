@extends ('layouts.app')


@section('content')
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Register</h1>
                <div class="custom-breadcrumbs">
                    <a href="#">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Register</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">
        <div class="row">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
            <div class="col-md-12 mb-5">
                <!-- <form action="#" class="p-4 border rounded"> -->
                <form  method="POST" action="{{ route('register.user') }}" class="p-4 border">
                    @csrf
                      <!-- @csrf -->
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Username</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Username">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Email</label>
                            <input type="text"  name="email" id="email" class="form-control" placeholder="Email address">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Password</label>
                            <input type="password"  name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="row form-group mb-4">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Re-Type Password</label>
                            <input type="password"  name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-type Password">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Sign Up" class="btn px-4 btn-primary text-white">
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>

@endsection