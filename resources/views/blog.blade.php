@extends('includes.master')
@section('title') {{ $seo_info[0]->meta_title.' || Our Blog' }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop
@section('content') 
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2>Our Blog</h2>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
        <li class="list-inline-item"><a href="javascript:void(0);">Our Blog</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Breadcrumb End --> 

<!-- Blog Start -->
<div class="blog blog-2">
  <div class="bloggs">
    <div class="container">
      <div class="row"> 
        <!-- Title Content Start -->
        <div class="col-sm-12 commontop text-center">
          <h4>Our Blog</h4>
          <div class="divider style-1 center"> <span class="hr-simple left"></span> <i class="icofont icofont-ui-press hr-icon"></i> <span class="hr-simple right"></span> </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
        </div>
        <!-- Title Content End -->
        <div class="col-md-8 col-sm-12 col-lg-8">
          <div class="row">
            <div class="col-sm-6"> 
              <!-- Single Blog Start -->
              <div class="box"> <img src="{{ asset('public/images/blog/b4.jpg') }}" class="img-fluid" alt="image" title="image" />
                <div class="caption">
                  <h4>Blog Title Here</h4>
                  <p class="text">May 15, 2017 / By admin / 3 Comments</p>
                  <p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan...</p>
                  <a class="btn btn-theme-alt btn-md" href="#">Read More <i class="icofont icofont-curved-double-right"></i></a> </div>
              </div>
              <!-- Single Blog End --> 
            </div>
            <div class="col-sm-6"> 
              <!-- Single Blog Start -->
              <div class="box"> <img src="{{ asset('public/images/blog/b3.jpg') }}" class="img-fluid" alt="image" title="image" />
                <div class="caption">
                  <h4>Blog Title Here</h4>
                  <p class="text">May 15, 2017 / By admin / 3 Comments</p>
                  <p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan...</p>
                  <a class="btn btn-theme-alt btn-md" href="#">Read More <i class="icofont icofont-curved-double-right"></i></a> </div>
              </div>
              <!-- Single Blog End --> 
            </div>
            <div class="col-sm-6"> 
              <!-- Single Blog Start -->
              <div class="box"> <img src="{{ asset('public/images/blog/b8.jpg') }}" class="img-fluid" alt="image" title="image" />
                <div class="caption">
                  <h4>Blog Title Here</h4>
                  <p class="text">May 15, 2017 / By admin / 3 Comments</p>
                  <p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan...</p>
                  <a class="btn btn-theme-alt btn-md" href="#">Read More <i class="icofont icofont-curved-double-right"></i></a> </div>
              </div>
              <!-- Single Blog End --> 
            </div>
            <div class="col-sm-6"> 
              <!-- Single Blog Start -->
              <div class="box"> <img src="{{ asset('public/images/blog/b1.jpg') }}" class="img-fluid" alt="image" title="image" />
                <div class="caption">
                  <h4>Blog Title Here</h4>
                  <p class="text">May 15, 2017 / By admin / 3 Comments</p>
                  <p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan...</p>
                  <a class="btn btn-theme-alt btn-md" href="#">Read More <i class="icofont icofont-curved-double-right"></i></a> </div>
              </div>
              <!-- Single Blog End --> 
            </div>
            <div class="col-sm-6"> 
              <!-- Single Blog Start -->
              <div class="box"> <img src="{{ asset('public/images/blog/b5.jpg') }}" class="img-fluid" alt="image" title="image" />
                <div class="caption">
                  <h4>Blog Title Here</h4>
                  <p class="text">May 15, 2017 / By admin / 3 Comments</p>
                  <p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan...</p>
                  <a class="btn btn-theme-alt btn-md" href="#">Read More <i class="icofont icofont-curved-double-right"></i></a> </div>
              </div>
              <!-- Single Blog End --> 
            </div>
            <div class="col-sm-6"> 
              <!-- Single Blog Start -->
              <div class="box"> <img src="{{ asset('public/images/blog/b2.jpg') }}" class="img-fluid" alt="image" title="image" />
                <div class="caption">
                  <h4>Blog Title Here</h4>
                  <p class="text">May 15, 2017 / By admin / 3 Comments</p>
                  <p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan...</p>
                  <a class="btn btn-theme-alt btn-md" href="#">Read More <i class="icofont icofont-curved-double-right"></i></a> </div>
              </div>
              <!-- Single Blog End --> 
            </div>
            <div class="col-sm-12 col-xs-12"> 
              <!-- Pagination Start -->
              <ul class="pagination justify-content-center">
                <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"><i class="icofont icofont-double-left"></i></a> </li>
                <li class="page-item active"> <a class="page-link" href="#">01</a> </li>
                <li class="page-item"> <a class="page-link" href="#">02</a> </li>
                <li class="page-item"> <a class="page-link" href="#">03</a> </li>
                <li class="page-item"> <a class="page-link" href="#">04</a> </li>
                <li class="page-item"> <a class="page-link" href="#">...</a> </li>
                <li class="page-item"> <a class="page-link" href="#">18</a> </li>
                <li class="page-item"> <a class="page-link" href="#" aria-label="Next"><i class="icofont icofont-double-right"></i></a> </li>
              </ul>
              <!-- Pagination End --> 
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 col-lg-4"> 
          <!--  Blog Sidebar Start  -->
          <div class="sidebar-box"> 
            <!--  Search widget Start  -->
            <div class="search">
              <form class="form-horizontal" method="post">
                <fieldset>
                  <div class="form-group">
                    <input name="s" value="" class="form-control" placeholder="Search" type="text">
                  </div>
                  <button type="submit" value="submit" class="btn"><i class="icofont icofont-search"></i></button>
                </fieldset>
              </form>
            </div>
            <!--  Search widget End  --> 
          </div>
          <div class="sidebar-box"> 
            <!--  Recent Post widget Start  -->
            <h6>Recent Blog Posts</h6>
            <div class="latest">
              <ul class="list-unstyled">
                <li> <img src="{{ asset('public/images/blog-detail/img1.jpg') }}" class="img-fluid" alt="image" title="image">
                  <div class="caption">
                    <h3>Blog Title Here</h3>
                    <p class="test">May 25, 2017</p>
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                  </div>
                </li>
                <li> <img src="{{ asset('public/images/blog-detail/img2.jpg') }}" class="img-fluid" alt="image" title="image">
                  <div class="caption">
                    <h3>Blog Title Here</h3>
                    <p class="test">May 25, 2017</p>
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                  </div>
                </li>
                <li> <img src="{{ asset('public/images/blog-detail/img3.jpg') }}" class="img-fluid" alt="image" title="image">
                  <div class="caption">
                    <h3>Blog Title Here</h3>
                    <p class="test">May 25, 2017</p>
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                  </div>
                </li>
                <li> <img src="{{ asset('public/images/blog-detail/img4.jpg') }}" class="img-fluid" alt="image" title="image">
                  <div class="caption">
                    <h3>Blog Title Here</h3>
                    <p class="test">May 25, 2017</p>
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                  </div>
                </li>
                <li> <img src="{{ asset('public/images/blog-detail/img5.jpg') }}" class="img-fluid" alt="image" title="image">
                  <div class="caption">
                    <h3>Blog Title Here</h3>
                    <p class="test">May 25, 2017</p>
                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                  </div>
                </li>
              </ul>
            </div>
            <!--  Recent Post widget End  --> 
          </div>
          <div class="sidebar-box"> 
            <!--  Instagram widget Start  -->
            <h6>Instagram</h6>
            <div class="gallery">
              <ul class="list-inline">
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/1.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/2.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/3.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/4.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/5.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/6.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/7.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/8.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
                <li class="list-inline-item"><img src="{{ asset('public/images/instagram/9.jpg') }}" alt="img" title="img" class="img-fluid" /></li>
              </ul>
            </div>
            <!--  Instagram widget End  --> 
          </div>
          <div class="sidebar-box"> 
            <!--  Tab widget Start  -->
            <h6>Tags</h6>
            <div class="tag">
              <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Pizza</a></li>
                <li class="list-inline-item"><a href="#">Burger</a></li>
                <li class="list-inline-item"><a href="#">Breakfast</a></li>
                <li class="list-inline-item"><a href="#">Lunch</a></li>
                <li class="list-inline-item"><a href="#">Dinner</a></li>
                <li class="list-inline-item"><a href="#">Fast Food</a></li>
                <li class="list-inline-item"><a href="#">Tandoori Chicken</a></li>
              </ul>
            </div>
            <!--  Tag widget End  --> 
          </div>
          <!--  Blog Sidebar End  --> 
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Blog End -->
@stop 