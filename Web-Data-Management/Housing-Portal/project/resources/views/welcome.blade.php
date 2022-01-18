<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IHM</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="/css/service.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/f99306dc1c.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Contact US -->
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <style type="text/css">
        #map {
            height: 400px;
            width: 100%;
        }
    </style>

    <script>
        function initMap() {
            const coord = {
                lat: 32.735668,
                lng: -97.105476
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: coord,
            });
            const marker = new google.maps.Marker({
                position: coord,
                map: map,
            });
        }
    </script>

    <script type="text/javascript">
        function sendEmail() {
            event.preventDefault();

            let name = $("#name").val();
            let email = $("#email").val();
            let number = $("#number").val();
            let query = $("#query").val();

            let response = `<!doctype html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
          <head>
            <title>
            </title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style type="text/css">
              #outlook a{padding: 0;}
                          .ReadMsgBody{width: 100%;}
                          .ExternalClass{width: 100%;}
                          .ExternalClass *{line-height: 100%;}
                          body{margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
                          table, td{border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
                          img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
                          p{display: block; margin: 13px 0;}
            </style>
            <!--[if !mso]><!-->
            <style type="text/css">
              @media only screen and (max-width:480px) {
                                    @-ms-viewport {width: 320px;}
                                    @viewport { width: 320px; }
                              }
            </style>
            <!--<![endif]-->
            <!--[if mso]> 
                <xml> 
                    <o:OfficeDocumentSettings> 
                        <o:AllowPNG/> 
                        <o:PixelsPerInch>96</o:PixelsPerInch> 
                    </o:OfficeDocumentSettings> 
                </xml>
                <![endif]-->
            <!--[if lte mso 11]> 
                <style type="text/css"> 
                    .outlook-group-fix{width:100% !important;}
                </style>
                <![endif]-->
            <style type="text/css">
              @media only screen and (max-width:480px) {
              
                            table.full-width-mobile { width: 100% !important; }
                              td.full-width-mobile { width: auto !important; }
              
              }
              @media only screen and (min-width:480px) {
              .dys-column-per-100 {
                  width: 100.000000% !important;
                  max-width: 100.000000%;
              }
              }
            </style>
          </head>
          <body>
            <div>
              <!--[if mso | IE]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
        <![endif]-->
              <div style='background:#F5774E;background-color:#F5774E;margin:0px auto;max-width:600px;'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='background:#F5774E;background-color:#F5774E;width:100%;'>
                  <tbody>
                    <tr>
                      <td style='direction:ltr;font-size:0px;padding:10px 0;text-align:center;vertical-align:top;'>
                        <!--[if mso | IE]>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
        <![endif]-->
                        <div class='dys-column-per-100 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                          <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='vertical-align:top;' width='100%'>
                            <tr>
                              <td align='center' style='font-size:0px;padding:0;word-break:break-word;'>
                                <div style="color:#FFFFFF;font-family:'Droid Sans', 'Helvetica Neue', Arial, sans-serif;font-size:36px;line-height:1;text-align:center;">
                                  Query Submitted!
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td align='center' style='font-size:0px;padding:10px 25px;padding-top:10px;word-break:break-word;'>
                                <div style="color:#933f24;font-family:'Droid Sans', 'Helvetica Neue', Arial, sans-serif;font-size:18px;line-height:1;text-align:center;">
                                  Hi, ${name} We've received your query, we'll get back in touch with you soon.
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td align='center' style='font-size:0px;padding:5px;word-break:break-word;'>
                                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='border-collapse:collapse;border-spacing:0px;'>
                                  <tbody>
                                    <tr>
                                      <td style='width:147px;'>
                                        <img alt='Descriptive Alt Text' height='121' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg6S8NFluCsjH4zN0A-7rW20p0VJLgQAfv5Q&usqp=CAU' style='border:none;display:block;font-size:13px;height:121px;outline:none;text-decoration:none;width:100%;' width='147' />
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td align='center' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                <div style="color:#933f24;font-family:'Droid Sans', 'Helvetica Neue', Arial, sans-serif;font-size:13px;line-height:1;text-align:center;">
                                  We do our best to serve you to your satisfaction. Stay tuned at our <a href="http://ack.blog.axs4635.uta.cloud">Blog</a>.
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->
            </div>
          </body>
        </html>`;

            Email.send({
                Host: "mail.cxt1398.uta.cloud",
                Username: "ihmsupport@cxt1398.uta.cloud",
                Password: "Wdm@2021",
                To: email,
                From: "ihm_support@gmail.com",
                Subject: "Query Recieved",
                Body: response
            }).then(message => console.log(message));
            alert("Query successfully recieved!");
            location.reload();
        }
    </script>
    <!-- Contact US -->


    <!-- Styles -->
    <style>
        html,
        body {
            background-image: filter(url("images/main.jpg"), blur(2px));
            background-repeat: no-repeat;
            background-size: 100% 100%;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 80vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
            color: white;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: white;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
            transition: transform .2s;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="top-right links">
        @if (Route::has('login'))
        @auth
        @php
        $val = auth()->user()->id;
        @endphp
        <nav class="navbar fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="#">Home</a>
            <a class="navbar-brand" href="#aboutUs">About Us</a>
            <a class="navbar-brand" href="#services">Services</a>
            <a class="navbar-brand" href="#contactUs">Contact Us</a>
            <a class="navbar-brand" href="http://ack.blog.axs4635.uta.cloud/" target="_blank">Blog</a>
            <a class="navbar-brand" href="http://ack.blog.axs4635.uta.cloud/our-team/" target="_blank">Our Team</a>
            <a class="navbar-brand" href="{{ url('/profile/'.$val) }}">Dashboard</a>
        </nav>

        @else
        <nav class="navbar fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="#">Home</a>
            <a class="navbar-brand" href="#aboutUs" class="badge badge-dark">About Us</a>
            <a class="navbar-brand" href="#services" class="badge badge-dark">Services</a>
            <a class="navbar-brand" href="#contactUs" class="badge badge-dark">Contact Us</a>
            <a class="navbar-brand" href="http://ack.blog.axs4635.uta.cloud/" target="_blank" class="badge badge-dark">Blog</a>
            <a class="navbar-brand" href="http://ack.blog.axs4635.uta.cloud/our-team/" target="_blank" class="badge badge-dark">Our Team</a>
            <a class="navbar-brand" href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))

            <a class="navbar-brand" href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </nav>
        @endif
    </div>
    <div class="flex-center position-ref full-height" style="height: 100%">
        <div class="content">
            <div class="title m-b-md">
                <h1 class="display-2" class="font-weight-bold"><i class="fa fa-asl-interpreting" style="font-size:36px"></i>Intelligent Housing Manager<h1>
            </div>
            <br>
            <br>
            <div class="lead">
                <p class="text-info">Home is the most productive and relaxing place for every individual. So we bring your Dream Home to Reality.</p>
                <p class="text-info">This site manages, controls and monitors a subdivision of buildings where each building has several apartments, and each apartment has a responsible contact/owner.</p>
                <button type="button" class="btn btn-outline-dark btn-lg">GET STARTED</a></button>
            </div>
        </div>
    </div>
    <div id="aboutUs">
        <section class="about">
            <div class="content-box">
                <h2 class="heading"><i class="fas fa-arrow-alt-circle-right black"></i>&nbsp;About us</h2>
                <p class="para">This site manages, controls and monitors a subdivision of buildings where each building has several apartments, and each apartment has a responsible contact/owner. The site provides access to three dashboards which work on three different levels i.e., Subdivision, Building and Apartment. Authorized respective persons can generate the corresponding report of apartment, building or subdivision for their service consumption. The portal not only helps the person monitor their service consumption but also provides a detailed report (including public and private services).</p>
            </div>
            <div class="image-box"></div>
        </section>

        <section class="modes">
            <h2 class="heading white">Why us?</h2>
            <p class="para white">Providing one of the finest user experience and with all the essential services in your home and even more amenities which makes you feel useless to search for something different out of your home is what we think makes you choose your home. We believe that should be the most essential preference any housing must provide and we do</p>
            <div class="image-box">
                <img src="/images/bc.jpg" />
                <img src="/images/cntct2.jpg" />
                <img src="/images/servicee.png" />
                <img src="/images/seo.jpg" />
            </div>
        </section>
    </div>
    <div id="services">
        <section class="services">
            <h2 class="heading">Our Services</h2>
            <p class="para">Providing all the assistance with the facilities, ameneties and services with your home which makes you feel homely and unnecessary to move out of the place. Additionally, giving all the online assistance for different departments like Sub-Division, Building and Apartment. Easy accessible and one-tap navigation for different services.
            </p>
            <div class="container">
                <div class="service-box">
                    <div>
                        <img src="/images/seo.jpg" alt="">
                        <h2>Management</h2>
                    </div>
                </div>
                <div class="service-box">
                    <div>
                        <img src="/images/cntct2.jpg" alt="">
                        <h2>Synchronization</h2>
                    </div>
                </div>
                <div class="service-box">
                    <div>
                        <img src="/images/dash.jpg" alt="">
                        <h2>Dashboard </h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="tech">
            <div class="content-box">
                <h2 class="heading"><i class="fas fa-arrow-alt-circle-right black"></i>&nbsp;SERVICES</h2>
                <p class="para">Briefly divided into 2 sectors named Private and Public services. <br /><br />
                    <b>Private service:</b> The private service consists of the Internet. Each apartment uses the Internet as per its requirements. The reports generated by these services are individual for each apartment.
                    <br></br>
                    <b>Public service:</b> The public services consist of basic amenities like gas, electricity and water which is consumed by every apartment, building and subdivision. The owner of an apartment can get a report of the usage of his/her services. The owner of a building can gets a combined report of all the apartments that exist inside the building and the owner of the entire subdivision can get the overall report of consumption of services by all the buildings.
                </p>
            </div>
            <div class="image-box">
                <img src="/images/5.jpg">
            </div>
        </section>
        <!-- <div ></div> -->
    </div>

        
        <section class="footer" id="contactUs">
            <h1 class="text-xl-center text-center text-white">CONTACT US</h1>
        </section>
        <section class="about contactt">
            <div class="content-box bg-red">
                <form method="post" id="contactform">
                    <div class="form">
                        <div class="input-box">
                            <input type="text" name="name" id="name" placeholder="Full Name" aria-required="true" required />
                        </div>
                        <div class="input-box">
                            <input type="text" name="email" id="email" placeholder="Email" aria-required="true" required />
                        </div>
                        <div class="input-box">
                            <input type="text" name="number" id="number" placeholder="Contact number" aria-required="true" required />
                        </div>
                        <div class="input-box">
                            <textarea placeholder="Shoot your query?" aria-required="true" name="query" id="query" required></textarea>
                        </div>
                        <div class="input-box">
                            <input type="submit" name="SubmitButton" onclick="sendEmail()" value="Send" aria-required="true" required />
                        </div>
                    </div>
                </form>
            </div>

            <div class=" image-form">
            </div>
        </section>

        <div id='map'>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzWBsqRq2laUavT7BbIWlR8_RqpRxjwc4&callback=initMap&libraries=&v=weekly" async>
            </script>
        </div>
    

    <section class="footer">
        <p class="para white">Designed and developed by "ACK" Team.</p>
        <ul>
            <p class="para white">Follow us on:</p>
            <li><a href="#"><i class="fab fa-facebook-square fa-2x"></i></a></li>
            <li><a href="#"><i class="fab fa-google fa-2x"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin fa-2x"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram fa-2x"></i></a></li>
        </ul>
    </section>
</body>

</html>