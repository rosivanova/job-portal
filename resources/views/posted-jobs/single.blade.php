@extends ('layouts.app')

@section('content')

<section class="home-section section-hero overlay bg-image" style="background-image: url(' {{ asset('assets/images/hero_1.jpg') }} ');" id="home-section">



  <a href="#next" class="scroll-button smoothscroll">
    <span class=" icon-keyboard_arrow_down"></span>
  </a>

</section>

<section class="py-5 bg-image overlay-primary fixed overlay" id="next" style="background-image: url('images/hero_1.jpg');">
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

<section class="site-section">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="d-flex align-items-center">
          <div class="border p-2 d-inline-block mr-3 rounded">
            <img src="images/job_logo_5.jpg" alt="Image">
          </div>
          <div>
            <h2>{{$posted_job->job_title}}</h2>
            <div>
              <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span>{{$posted_job->company}}</span>
              <span class="m-2"><span class="icon-room mr-2"></span>{{$posted_job->job_region}}</span>
              <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary">{{$posted_job->job_type}}</span></span>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="mb-5">
            <figure class="mb-5"><img src="images/job_single_img_1.jpg" alt="Image" class="img-fluid rounded"></figure>
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
            <p>{{$posted_job->job_description}}</p>

          </div>
          <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
            <ul class="list-unstyled m-0 p-0">
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{{$posted_job->responsibilities}}</span></li>

            </ul>
          </div>

          <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
            <ul class="list-unstyled m-0 p-0">
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{{$posted_job->education_experience}}</span></li>

            </ul>
          </div>

          <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benifits</h3>
            <ul class="list-unstyled m-0 p-0">
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>{{$posted_job->other_benefits}}</span></li>
            </ul>
          </div>
          <div class="row mb-5">
            <div class="col-6">
              <form action="{{ route('posted-jobs.saveJob', ['id' => $posted_job->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-block btn-light btn-md">
                  <i class="icon-heart"></i> Save Job
                </button>
              </form>

              <!-- <button class="btn btn-block btn-light btn-md"><i class="icon-heart"></i>Save Job</button> -->
              <!--add text-danger to it to make it read-->
            </div>
            <div class="col-6">
              <button class="btn btn-block btn-primary btn-md">Apply Now</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="bg-light p-3 border rounded mb-4">
            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
            <ul class="list-unstyled pl-3 mb-0">
              <li class="mb-2"><strong class="text-black">Published on:</strong> {{ \Carbon\Carbon::parse($posted_job->created_at)->format('d-m-Y') }}</li>
              <li class="mb-2"><strong class="text-black">Vacancy:</strong> {{$posted_job->vacancy}}</li>
              <li class="mb-2"><strong class="text-black">Employment Status:</strong> {{$posted_job->job_type}}</li>
              <li class="mb-2"><strong class="text-black">Experience:</strong> 2 to 3 year(s)</li>
              <li class="mb-2"><strong class="text-black">Job Location:</strong> {{$posted_job->job_region}}</li>
              <li class="mb-2"><strong class="text-black">Salary:</strong> {{$posted_job->salary}} Euro</li>
              <li class="mb-2"><strong class="text-black">Gender:</strong> {{$posted_job->gender}}</li>
              <li class="mb-2"><strong class="text-black">Application Deadline:</strong>
              </li>
            </ul>
          </div>

          <div class="bg-light p-3 border rounded">
            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
            <div class="px-3">
              <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
              <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
              <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
            </div>
          </div>

        </div>
      </div>

   
</section>

<section class="site-section" id="next">
  <div class="container">

    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2">22,392 Related Jobs</h2>
      </div>
    </div>

    <ul class="job-listings mb-5">
      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <a href="job-single.html"></a>
        <div class="job-listing-logo">
          <img src="images/job_logo_1.jpg" alt="Image" class="img-fluid">
        </div>

        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Product Designer</h2>
            <strong>Adidas</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> New York, New York
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-danger">Part Time</span>
          </div>
        </div>

      </li>
      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <a href="job-single.html"></a>
        <div class="job-listing-logo">
          <img src="images/job_logo_2.jpg" alt="Image" class="img-fluid">
        </div>

        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Digital Marketing Director</h2>
            <strong>Sprint</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> Overland Park, Kansas
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-success">Full Time</span>
          </div>
        </div>
      </li>

      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <a href="job-single.html"></a>
        <div class="job-listing-logo">
          <img src="images/job_logo_3.jpg" alt="Image" class="img-fluid">
        </div>

        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Back-end Engineer (Python)</h2>
            <strong>Amazon</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> Overland Park, Kansas
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-success">Full Time</span>
          </div>
        </div>
      </li>

      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <a href="job-single.html"></a>
        <div class="job-listing-logo">
          <img src="images/job_logo_4.jpg" alt="Image" class="img-fluid">
        </div>

        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Senior Art Director</h2>
            <strong>Microsoft</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> Anywhere
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-success">Full Time</span>
          </div>
        </div>
      </li>

      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <a href="job-single.html"></a>
        <div class="job-listing-logo">
          <img src="images/job_logo_5.jpg" alt="Image" class="img-fluid">
        </div>

        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Product Designer</h2>
            <strong>Puma</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> San Mateo, CA
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-success">Full Time</span>
          </div>
        </div>
      </li>
      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <a href="job-single.html"></a>
        <div class="job-listing-logo">
          <img src="images/job_logo_1.jpg" alt="Image" class="img-fluid">
        </div>

        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Product Designer</h2>
            <strong>Adidas</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> New York, New York
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-danger">Part Time</span>
          </div>
        </div>

      </li>
      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <a href="job-single.html"></a>
        <div class="job-listing-logo">
          <img src="images/job_logo_2.jpg" alt="Image" class="img-fluid">
        </div>

        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Digital Marketing Director</h2>
            <strong>Sprint</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> Overland Park, Kansas
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-success">Full Time</span>
          </div>
        </div>
      </li>




    </ul>



  </div>
</section>





@endsection