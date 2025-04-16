@extends ('layouts.app')

@section('content')

<section class="home-section section-hero overlay bg-image" style="background-image: url(' {{ asset('assets/images/hero_1.jpg') }} ');" id="home-section">
  <a href="#next" class="scroll-button smoothscroll">
    <span class=" icon-keyboard_arrow_down"></span>
  </a>
</section>

<!-- <section class="py-3 bg-image overlay-primary fixed overlay" id="next" style="background-image: url('images/hero_1.jpg');">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2 text-white">JobBoard Site Stats</h2>
        <p class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita unde officiis recusandae sequi excepturi corrupti.</p>
      </div>
    </div>
    <div class="row pb-0 block__19738 section-counter">

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="1930">0</strong>
        </div>
        <span class="caption">Candidates</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="54">0</strong>
        </div>
        <span class="caption">Jobs Posted</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="120">0</strong>
        </div>
        <span class="caption">Jobs Filled</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="550">0</strong>
        </div>
        <span class="caption">Companies</span>
      </div>


    </div>
  </div>
</section> -->

<section>
  <div class="container">
    <div class="row my-5">
      <div class="col">
      <h2> Hello, {{$profile->name}} !</h2>
      <p class="text-primary">You have applied for {{$appliedJobsCount}} positions</p>
      </div>
    </div>
    <table class="table table-striped">
      <!-- <caption>List of applied jobs</caption> -->
      <thead>
        <tr>
          <th class="col">Job Title</th>
          <th class="col">Company</th>
          <th class="col">Region</th>
          <th class="col">Job Type</th>
          <th class="col">Experience</th>
          <th class="col">Facebook</th>
          <th class="col">twitter</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($appliedJobs as $job)
        <tr>
          <td>{{ $job->job_title }}</td>
          <td>{{ $job->company }}</td>
          <td>{{ $job->job_region}}</td>
          <td>{{ $job->job_type}}</td>
          <td>{{ $job->experience}}</td>
          <td>{{ $job->facebook }}</td>
          <td>{{ $job->twitter }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</section>
<section class="py-5 bg-image overlay-primary fixed overlay" id="next-section" style="background-image: url('images/hero_1.jpg');">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2 text-white">JobBoard Site Stats</h2>
        <p class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita unde officiis recusandae sequi excepturi corrupti.</p>
      </div>
    </div>
    <div class="row pb-0 block__19738 section-counter">

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="1930">0</strong>
        </div>
        <span class="caption">Candidates</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="54">0</strong>
        </div>
        <span class="caption">Jobs Posted</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="120">0</strong>
        </div>
        <span class="caption">Jobs Filled</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="550">0</strong>
        </div>
        <span class="caption">Companies</span>
      </div>


    </div>
  </div>
</section>
@endsection