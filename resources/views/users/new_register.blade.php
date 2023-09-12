<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Register</title>
    <link
      href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  
  <style>
*, *:before, *:after {
  box-sizing: border-box;
}

html {
  overflow-y: scroll;
}

body {
  
  font-family: 'Titillium Web', sans-serif;
}

a {
  text-decoration: none;
  color: #1ab188;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
a:hover {
  color: #179b77;
}

.form {
  background: rgba(19, 35, 47, 0.9);
  padding: 40px;
  max-width: 1000px;
  margin: 40px auto;
  border-radius: 4px;
  box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
}

.tab-group {
  list-style: none;
  padding: 0;
  margin: 0 0 40px 0;
}
.tab-group:after {
  content: "";
  display: table;
  clear: both;
}
.tab-group li a {
  display: block;
  text-decoration: none;
  padding: 15px;
  background: rgba(160, 179, 176, 0.25);
  color: #a0b3b0;
  font-size: 20px;
  float: left;
  width: 50%;
  text-align: center;
  cursor: pointer;
  -webkit-transition: .5s ease;
  transition: .5s ease;
}
.tab-group li a:hover {
  background: #57CCC5;
  color: #ffffff;
}
.tab-group .active a {
  background: white;
  color: black;
}

.tab-content > div:last-child {
  display: none;
}

h1 {
  text-align: center;
  color: #ffffff;
  font-weight: 300;
  margin: 0 0 40px;
}

label {
  position: absolute;
  -webkit-transform: translateY(6px);
          transform: translateY(6px);
  left: 13px;
  color: rgba(255, 255, 255, 0.5);
  -webkit-transition: all 0.25s ease;
  transition: all 0.25s ease;
  /* -webkit-backface-visibility: hidden; */
  pointer-events: none;
  font-size: 22px;
}
label .req {
  margin: 2px;
  color: #57CCC5;
}

label.active {
  -webkit-transform: translateY(50px);
          transform: translateY(50px);
  left: 2px;
  font-size: 14px;
}
label.active .req {
  opacity: 0;
}

label.highlight {
  color: #ffffff;
}

input, textarea {
  font-size: 22px;
  display: block;
  width: 100%;
  height: 100%;
  padding: 5px 1    0px;
  background: none;
  background-image: none;
  border: 1px solid #a0b3b0;
  color: #ffffff;
  border-radius: 0;
  -webkit-transition: border-color .25s ease, box-shadow .25s ease;
  transition: border-color .25s ease, box-shadow .25s ease;
}
input:focus, textarea:focus {
  outline: 0;
  border-color: #1ab188;
}

textarea {
  border: 2px solid #a0b3b0;
  resize: vertical;
}

.field-wrap {
  position: relative;
  margin-bottom: 40px;
}

.top-row:after {
  content: "";
  display: table;
  clear: both;
}
.top-row > div {
  float: left;
  width: 48%;
  margin-right: 4%;
}
.top-row > div:last-child {
  margin: 0;
}

.button {
  border: 0;
  outline: none;
  border-radius: 0;
  padding: 15px 0;
  font-size: 2rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .1em;
  background: white;
  color: black;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  /* -webkit-appearance: none; */
}
.button:hover, .button:focus {
  background: #57CCC5;
}

.button-block {
  display: block;
  width: 100%;
}

.forgot {
  margin-top: -20px;
  text-align: right;
}

.heading{
    color: black;
    top: 10%;
    font-size: 50px;

}
  </style>
  <body style="background-color: #D1EAF0;">
    <h1 class="heading" id="heading">GMi Chäft Account</h1>
    <div class="form">
      
        <ul class="tab-group">
          <li class="tab active"><a href="#signup">Register</a></li>
          <li class="tab"><a href="#login">Log In</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="signup">   
            
            <form action="/users" method="post">
            @csrf

            <div class="field-wrap mb-6">
                <label for="name" class="inline-block text-2g mb-2"> Name <span class="req">*</span></label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" />

                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
          
  
            <div class="field-wrap mb-6">
                <label for="email" class="inline-block text-2g mb-2"> Email <span class="req">*</span></label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" />

                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

           
            <div class="field-wrap mb-6">
                <label for="password" class="inline-block text-2g mb-2"> Password <span class="req">*</span></label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" value="{{old('password')}}" />

                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror   
            </div>

            <div class="field-wrap mb-6">
                <label for="password2" class="inline-block text-2g mb-2"> Confirm Password <span class="req">*</span></label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" value="{{old('password_confirmation')}}" />

                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            
            <button type="submit" class="button button-block"> Register </button>
            
            <div class="mt-8 text-white text-lg">
                <p> Already have an account?
                    <a href="/login" class="text-laravel">Login</a>
                </p>
            </div>
            </form>

          </div>
          
          <div id="login">   
            <h1>Welcome!</h1>
            
            <form action="/users/authenticate" method="post">
            @csrf
                <div class="field-wrap mb-6">
                    <label for="email" class="inline-block text-2g mb-2"> Email <span class="req">*</span></label>
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" />

                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

            
                <div class="field-wrap mb-6">
                    <label for="password" class="inline-block text-2g mb-2"> Password <span class="req">*</span></label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" value="{{old('password')}}" />

                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror   
                </div>
            
            <p class="forgot"><a href="forgotpass.html">Forgot Password?</a></p>
              
            <button class="button button-block" onclick="window.Location"> <a href="userpage.html"></a> Log In</button>
            
            </form>
  
          </div>
          
        </div><!-- tab-content -->
        
  </div> <!-- /form -->
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  
          <script src="js/index.js"></script>
          <script>$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
            var $this = $(this),
                label = $this.prev('label');
          
                if (e.type === 'keyup') {
                      if ($this.val() === '') {
                    label.removeClass('active highlight');
                  } else {
                    label.addClass('active highlight');
                  }
              } else if (e.type === 'blur') {
                  if( $this.val() === '' ) {
                      label.removeClass('active highlight'); 
                      } else {
                      label.removeClass('highlight');   
                      }   
              } else if (e.type === 'focus') {
                
                if( $this.val() === '' ) {
                      label.removeClass('highlight'); 
                      } 
                else if( $this.val() !== '' ) {
                      label.addClass('highlight');
                      }
              }
          
          });
          
          $('.tab a').on('click', function (e) {
            
            e.preventDefault();
            
            $(this).parent().addClass('active');
            $(this).parent().siblings().removeClass('active');
            
            target = $(this).attr('href');
          
            $('.tab-content > div').not(target).hide();
            
            $(target).fadeIn(600);
            
          });</script>
  
      
      
      
    </body>
  </html>
  
  </body>
</html>
