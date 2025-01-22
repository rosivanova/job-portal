@extends ('layouts.app')

@section('content')

<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Log In</h1>
                <div class="custom-breadcrumbs">
                    <a href="#">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Log In</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="#" class="p-4 border rounded">

                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Email</label>
                            <input type="text" id="fname" class="form-control" placeholder="Email address">
                        </div>
                    </div>
                    <div class="row form-group mb-4">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Password</label>
                            <input type="password" id="fname" class="form-control" placeholder="Password">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Log In" class="btn px-4 btn-primary text-white">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @endsection