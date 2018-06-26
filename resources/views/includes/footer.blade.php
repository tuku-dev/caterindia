@php $admin_data = Helpers::getShare(); @endphp
<div class="container">
  <div class="row inner">
    <div class="col-sm-6 col-md-6 col-lg-3"> 
      <!-- Footer Widget Start -->
      <h5>Contact Us</h5>
      <ul class="list-unstyled contact">
        <li><i class="icofont icofont-social-google-map"></i>{{ $admin_data[0]->address }}</li>
        <li><i class="icofont icofont-phone"></i> {{ $admin_data[0]->contact_no }},<br>
          {{ $admin_data[0]->mobile_no }}</li>
        <li><a href="#"><i class="icofont icofont-ui-message"></i>{{ $admin_data[0]->alt_email }}</a></li>
      </ul>
      <!-- Footer Widget End --> 
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3"> 
      <!-- Footer Widget Start -->
      <h5>Information</h5>
      <ul class="list-unstyled">
        <li><a href="{{ url('/') }}/about-us">About us</a></li>
        <li><a href="#">Delivery Information</a></li>
        <li><a href="{{ url('/') }}/contact-us">Contact us</a></li>
        <li><a href="#">Terms & Conditions</a></li>
        <li><a href="{{ url('/') }}/our-blog">Our Blog</a></li>
      </ul>
      <!-- Footer Widget End --> 
    </div>
    <div class="w-100 d-none d-xs-block"></div>
    <div class="col-sm-6 col-md-6 col-lg-3"> 
      <!-- Footer Widget Start -->
      <h5>Open Hours</h5>
      <ul class="list-unstyled">
        <li>Monday - Friday : 9 am to 12 am.</li>
        <li>Saturday - Sunday : 24 Hour Open</li>
        <li>Breakfast : 7 am to 12 pm</li>
        <li>Lunch : 12 pm to 7 pm</li>
        <li>Dinner : 7 am to 12 am</li>
      </ul>
      <!-- Footer Widget End --> 
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3"> 
      <!-- Footer Widget Start -->
      <h5>Instagram</h5>
      <ul class="list-unstyled insta">
        <li><a href="#"><img src="{{ asset('public/images/instagram/1.jpg') }}" alt="image" /></a></li>
        <li><a href="#"><img src="{{ asset('public/images/instagram/2.jpg') }}" alt="image" /></a></li>
        <li><a href="#"><img src="{{ asset('public/images/instagram/3.jpg') }}" alt="image" /></a></li>
        <li><a href="#"><img src="{{ asset('public/images/instagram/4.jpg') }}" alt="image" /></a></li>
        <li><a href="#"><img src="{{ asset('public/images/instagram/5.jpg') }}" alt="image" /></a></li>
        <li><a href="#"><img src="{{ asset('public/images/instagram/6.jpg') }}" alt="image" /></a></li>
      </ul>
      <!-- Footer Widget End --> 
    </div>
  </div>
</div>
<div class="footer-bottom">
  <div class="container">
    <div class="row powered"> 
      <!--  Copyright Start -->
      <div class="col-md-3 col-sm-6 order-md-1"> <img src="{{ asset('public/images/logo/logo-white.png') }}" class="img-fluid" title="logo" alt="logo"> </div>
      <div class="col-md-3 col-sm-6 text-right order-md-3"> 
        <!--  Footer Social Start -->
        <ul class="list-inline social">
          <li class="list-inline-item"><a href="{{ $admin_data[0]->facebook_url }}" target="_blank"><i class="icofont icofont-social-facebook"></i></a></li>
          <li class="list-inline-item"><a href="{{ $admin_data[0]->twitter_url }}" target="_blank"><i class="icofont icofont-social-twitter"></i></a></li>
          <li class="list-inline-item"><a href="{{ $admin_data[0]->linkedin_url }}" target="_blank"><i class="icofont icofont-social-linkedin"></i></a></li>
          <li class="list-inline-item"><a href="{{ $admin_data[0]->instagram_url }}" target="_blank"><i class="icofont icofont-social-instagram"></i></a></li>
        </ul>
        <!--  Footer Social End --> 
      </div>
      <div class="col-md-6 col-sm-12 text-center order-md-2">
        <p>Copyright © <span>{{ $admin_data[0]->admin_name }}</span> @php echo date('Y'); @endphp. All Rights Reserved.</p>
      </div>
      <!--  Copyright End --> 
    </div>
  </div>
</div>
