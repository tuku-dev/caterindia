<div class="container">
  <div id="subscribe"> 
    <!-- Subscribe Form -->
      <div class="row">
        <div class="col-sm-6 col-md-7">
          <div class="input-group"> <span class="news">newsletter</span>
            <p>Subscribe to our newsletter. Don't miss out on our great offers.</p>
          </div>
        </div>
        <div class="col-sm-6 col-md-5 form-group">
          <div class="input-group">
            {!! Form::email('news_ltr_email',old('news_ltr_email'), array('id' => 'news_ltr_email','required', 'maxlength' => 50,'placeholder'=>'Join our email list','autocomplete' => 'off')) !!}
            <button class="btn btn-news" type="submit" value="submit" onclick="newsletterValidation();">Send</button>
            <span style="padding-left:20px; color:#FFF; display:block" id="nl_msg"></span>
            
          </div>
        </div>
      </div>
    <!-- Subscribe Form --> 
  </div>
</div>
