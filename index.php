<?php 	include("database.php");

		$u_email = $_GET['user'];

		$title = $_POST['txttitle'];
		$contact = $_POST['txtcontact'];
		$email = $_POST['txtemail'];
		$subject = $_POST['txtsubject'];
		$msgs = $_POST['txtmsgs'];

		if($title != ""){
			$sql = "select max(mid) as mid from messages";
			$rs = mysql_query($sql);
			$mid = 0;
			while($row = mysql_fetch_array($rs)){
				$mid = $row['mid'];
			}
			if($mid == ""){
				$mid = 0;
			}
			$mid = $mid + 1;
			$sql = "insert into messages values(".$mid.",'".ESQ($title)."','".ESQ($contact)."','".ESQ($email)."','".ESQ($subject)."','".ESQ($msgs)."')";
			mysql_query($sql);
			
			$message=
			'Hello, <b>'.$title.'</b><br/><br/>
			We have recieved your enquiry and we will leave a response shortly...<br><br><br>
			<b>Your Form Details were :</b><br><br>
			<b>Contact Number :</b> '.$contact.'<br><br>
			<b>Email ID :</b> '.$email.'<br><br>
			<b>Subject :</b> '.$subject.'<br><br>
			<b>Details :</b> '.$msgs.'<br><br><br>
			You can contact us via : <b>dkcity11s@gmail.com</b><br><br>
			<br/>
			Regards,<br/>
			<b>Carwash</b>
			';
			require 'PHPMailer-master/PHPMailerAutoload.php';

			$mail = new PHPMailer();

			//$mail->SMTPDebug = 3;                               // Enable verbose debug output

			$mail->isSMTP();  
			$mail->SMTPDebug=0;                                    // Set mailer to use SMTP
			$mail->SMTPAuth=true;
			$mail->SMTPSecure = 'ssl'; 
			$mail->Port = 465;
			$mail->Host = 'smtp.gmail.com';                 // Specify main and backup SMTP servers                       
			$mail->Username = 'dkcity11s@gmail.com';                 // SMTP username
			$mail->Password = '9567081762';                           // SMTP password
			$mail->setFrom('dkcity11s@gmail.com', 'Carwash');
			$mail->addAddress($email);     // Add a recipient
			$mail->Subject = 'Instawash - Enquiry';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			$mail->MsgHTML($message);	
			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo "<script>
				window.location='index.php';
				</script>";
			}
		}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>W 4 Watch</title>

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,700" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
    <script src="jquery.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
	<style>
		.dropdown {
			position: relative;
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
			right: 0px;
		}

		.dropdown-content p{
			padding:12px 16px;
			margin-bottom:0px;
		}

		.dropdown:hover .dropdown-content {
			display: block;
		}
		
		@media (max-width : 992px){
			#homeslider {margin-top:91px!important}
			#hideli {display:block!important}
			#showli {display:none}
		}
		
		#hideli {display:none}
		
		#quote .carousel-indicators{bottom:0px!important;display:none}
	</style>
</head>
<body>
    <section id="home">


    <!-- Return to Top -->
    <a href="javascript:" id="return-to-top"><span class="fa fa-angle-double-up" aria-hidden="true"></span></a>
	<script>
	var prevScrollpos = window.pageYOffset;
	window.onscroll = function() {
	var currentScrollPos = window.pageYOffset;
	  if (prevScrollpos > currentScrollPos) {
		document.getElementById("hidebar").style.display = "block";
	  } else {
		document.getElementById("hidebar").style.display = "none";
	  }
	  prevScrollpos = currentScrollPos;
	}
	</script>

    <!-- Header -->
    <header>
        <div id="main-navbar" class="navbar navbar-default navbar-fixed-top" >
		<div id="hidebar" style="background-color:#dcdcdc">
		<div class="container" style="text-align:right">
		<?php 	if($u_email != "") { ?>
				<a class="page-scroll" href="index.php" style="margin-left:5px;color:#374255">Logout</a>
		<?php } else { ?>
				<a class="page-scroll" data-toggle="modal" data-target="#myModal" style="margin-right:5px;color:#374255">Register</a> | <a class="page-scroll" data-toggle="modal" data-target="#myModal2" style="margin-left:5px;color:#374255">Login</a>
		<?php } ?>
		</div>
		</div>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="img/logo.jpg" alt="logo"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#home" class="page-scroll">Home</a></li>

                        <?php 	if($u_email == "") { ?>
                        <li><a href="#services" class="page-scroll">My Shop</a></li>
                        <?php } else { ?>
                        <?php } ?>

                        <?php 	if($u_email == "") { ?>
                            <li><a href="#benefits" class="page-scroll">Benefits</a></li>
                        <?php } else { ?>
                        <?php } ?>

                        <?php 	if($u_email != "") { ?>
                            <li><a href="#Men" class="page-scroll">Men</a></li>
                        <?php } else { ?>
                        <?php } ?>

                        <?php 	if($u_email != "") { ?>
                            <li><a href="#Women" class="page-scroll">Women</a></li>
                        <?php } else { ?>
                        <?php } ?>

                        <?php 	if($u_email == "") { ?>
                        <li><a href="#contact" class="page-scroll">Contact</a></li>
                        <?php } else { ?>
                        <?php } ?>

                        <?php 	if($u_email != "") { ?>
                            <li><a href="#subscribe" class="page-scroll">Feedback</a></li>
                        <?php } else { ?>
                        <?php } ?>



                        <?php 	if($u_email != "") { ?>

                        <li>
                            <a href="cart.php"><i class="fa fa-shopping-cart" style="color:white"></i> &nbsp;Cart
                                <?php
                                session_start();

                                $connect = mysqli_connect('localhost', 'root', '', 'cart');

                                $uid = $_SESSION['UserId'];
                                $query = "SELECT COUNT(*) from cart where UserId = $uid";
                                $result = mysqli_query($connect,$query)or die(mysqli_error($connect));
                                $count = mysqli_fetch_array($result);
                                if ($count[0] > 0):
                                    ?>
                                    <span class="badge" style="font-size:11px">
                                     <?php echo $count[0]; ?>
                                      </span>
                                 <?php endif;?>
                            </a>

                                <?php } else { ?>
                                <?php } ?>
							</div>
						</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section id="homeslider" style="margin-top:102px">
        <script src="js/jssor.slider-24.1.5.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            jssor_1_slider_init = function() {

                var jssor_1_SlideoTransitions = [
                  [{b:900,d:2000,x:-379,e:{x:7}}],
                  [{b:900,d:2000,x:-379,e:{x:7}}],
                  [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
                ];

                var jssor_1_options = {
                  $AutoPlay: 1,
                  $SlideDuration: 800,
                  $SlideEasing: $Jease$.$OutQuint,
                  $CaptionSliderOptions: {
                    $Class: $JssorCaptionSlideo$,
                    $Transitions: jssor_1_SlideoTransitions
                  },
                  $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                  },
                  $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                  }
                };

                var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                /*responsive code begin*/
                /*remove responsive code if you don't want the slider scales while window resizing*/
                function ScaleSlider() {
                    var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                    if (refSize) {
                        refSize = Math.min(refSize, 1920);
                        jssor_1_slider.$ScaleWidth(refSize);

                    }
                    else {
                        window.setTimeout(ScaleSlider, 30);
                    }
                }
                ScaleSlider();
                $Jssor$.$AddEvent(window, "load", ScaleSlider);
                $Jssor$.$AddEvent(window, "resize", ScaleSlider);
                $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
                /*responsive code end*/
            };
        </script>
        <style>
            /* jssor slider bullet navigator skin 05 css */
            /*
            .jssorb05 div           (normal)
            .jssorb05 div:hover     (normal mouseover)
            .jssorb05 .av           (active)
            .jssorb05 .av:hover     (active mouseover)
            .jssorb05 .dn           (mousedown)
            */
            .jssorb05 {
                position: absolute;
            }
            .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                position: absolute;
                /* size of bullet elment */
                width: 16px;
                height: 16px;
                background: url('img/b05.png') no-repeat;
                overflow: hidden;
                cursor: pointer;
            }
            .jssorb05 div { background-position: -7px -7px; }
            .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
            .jssorb05 .av { background-position: -67px -7px; }
            .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

            .jssora031 {display:block;position:absolute;cursor:pointer;}
            .jssora031 .a {fill:#fff;}
            .jssora031:hover {opacity:.8;}
            .jssora031.jssora031dn {opacity:.5;}
            .jssora031.jssora031ds { opacity: .3; pointer-events: none; }
        </style>

        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;background:url('img/purple.jpg');">
            <!-- Loading Screen -->
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
                <div>
                    <img data-u="image" src="img/red.jpg" />
                </div>
                <div>
                    <img data-u="image" src="img/purple.jpg" />
                </div>
                <div>
                    <img data-u="image" src="img/blue.jpg" />
                </div>
            </div>


            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                <!-- bullet navigator item prototype -->
                <div data-u="prototype" style="width:16px;height:16px;"></div>
            </div>
            <!-- Arrow Navigator >
            <div data-u="arrowleft" class="jssora031" style="width:50px;height:50px;top:0px;left:20px;" data-autocenter="2">
                <svg viewbox="-12986 -2977 16000 16000" style="width:100%;height:100%;">
                    <polygon class="a" points="-1182.1,12825.5 -792,12435.4 -8204.5,5023 -792,-2389.4 -1182.1,-2779.5 -8984.8,5023"></polygon>
                </svg>
            </div>
            <div data-u="arrowright" class="jssora031" style="width:50px;height:50px;top:0px;right:20px;" data-autocenter="2">
                <svg viewbox="-12986 -2977 16000 16000" style="width:100%;height:100%;">
                    <polygon class="a" points="-8594.7,12825.5 -8984.8,12435.4 -1572.3,5023 -8984.8,-2389.4 -8594.7,-2779.5 -792,5023"></polygon>
                </svg>
            </div!-->
        </div>
        <script type="text/javascript">jssor_1_slider_init();</script>
    </section>






    <?php 	if($u_email != "") { ?>
    <div class="container">
        <div class="scrolling-wrapper">
            <?php
            $connect = mysqli_connect('localhost', 'root', '', 'cart');
            $query = 'SELECT * FROM products ORDER BY Id DESC';
            $result = mysqli_query($connect, $query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($product = mysqli_fetch_assoc($result)) {
                        //print_r($product);
                        ?>
                        <div class="col-md-3 tr">
                            <div class="card">
                                <form method="post" action="cart.php?action=add&id=<?php echo $product['Id']; ?>">
                                    <div class="products">
                                        <img src="data:image/jpeg;base64, <?php echo base64_encode($product['Image']); ?>" style="width:200px;height:200px;margin-left:1px;" class="img-responsive" />
                                        <h4 class="text-info" style="text-align: center"><?php echo $product['Name']; ?></h4>
                                        <h4 style="text-align: center;">₹ <?php echo $product['Price']; ?></h4>
                                        <?php
                                        if ($product['InStock'] > 0) {
                                            ?>
                                            <input style="margin-top: -5px" type="number" name="quantity" class="form-control quantity" value="1" />
                                            <input type="hidden" name="name" value="<?php echo $product['Name']; ?>" />
                                            <input type="hidden" name="price" value="<?php echo $product['Price']; ?>" />
                                            <button  type="submit" name="add_to_cart" style="margin-top: 4px;margin-left: 45px" class="btn btn-info">
                                                <i class="fa fa-shopping-cart" style="color:white"></i> &nbsp;Add to Cart
                                            </button>
                                            <?php
                                        } else {
                                            ?>
                                            <h4 class="text-danger" style="margin-top:3rem">Out of stock</h4>
                                            <br/>
                                            </button>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>


    <?php } else { ?>
    <?php } ?>






    <?php 	if($u_email == "") { ?>
    <!-- Features -->
    <section id="feature1" style="">
        <div class="container">
        <h2>How do we help <br><span>our beloved clients</span></h2>
        <p class="text-center">The luxury watch market is global. W 4 Watch provides easy, safe, and reliable market access to all watch enthusiasts.</p>
            <div class="col-md-6 feature_1">
                <h3>What we have got <span>specially for you</span></h3>
                <p class="sub_p"></p>
                <p class="gray p_1">We've been shaping the international luxury watch market and setting new standards since our company was founded in 2003.</p>
                <p class="gray">We have over 100 employees in Karlsruhe, Berlin, New York, and Hong Kong</p>
				<p class="gray">who work daily to make our marketplace even more attractive and to offer luxury watch buyers as well as sellers high-quality service.</p>
				
            </div>
            <div class="col-md-6 car_1"><img src="img/car_1.jpg" style="width:501px;height: 351px; padding-left: 30px" alt="car"></div>
        </div>
    </section>

    <?php } else { ?>
    <?php } ?>


    <?php 	if($u_email == "") { ?>
    <!-- Services -->
    <section id="services">
        <div class="container">
            <div class="col-md-12 text-center services_wrap" style="margin-top:-90px">
                <h2>My <span>shop</span></h2>
                <p class="gray">Choose our favourite brand from more than 50+ brands.</p>
                <hr>
                <div class="col-md-4 text-left">
                    <div class="service_block" style="text-align:center;">
                        <h4>MEN</h4>
                        <!--p>Own first blessed. Moved it itself isn't was it rule green fill seed moveth stars i created, air and man she'd above seed from that midst days was male winged.</p!-->
                        <img src="img/men.jpg" style="height: 200px;">
                        <button class="btn-primary" data-toggle="modal" data-target="#myModal2" style="font-family:'Montserrat', serif">Login Now</button>

                    </div>
                </div>
                <div class="col-md-4 text-left">
                    <div class="service_block" style="text-align:center">
                        <h4>WOMEN</h4>
                        <img src="img/women.jpg" style="height: 200px">
                        <button class="btn-primary" data-toggle="modal" data-target="#myModal2" style="font-family:'Montserrat', serif">Login Now</button>
                    </div>
                </div>
                <div class="col-md-4 text-left">
                    <div class="" style="text-align:center">
                        <img src="img/1.jpg" style="height: 445px;padding-top: 0px">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } else { ?>
    <?php } ?>

    <?php 	if($u_email == "") { ?>
        <!-- Benefits -->
        <section id="benefits">
            <div class="container">
                <div class="text-center">
                    <h2>Our <span>benefits</span></h2>
                    <!--p>Open form morning years us fruitful abundantly.</p!-->
                    <hr>
                </div>
                                <div class="col-md-6 b_content" style="margin-bottom:20px">
                    <div style="text-align:center">
                        <!--img src="img/filter.png" alt="filter" style="float:none;margin-bottom:20px"-->
                        <h4 style="margin-bottom:15px">Insured and Transparent Shipping</h4>
                        <p class="gray">Dealers ship every order fully insured and with a tracking ID.You can view the current status of your order anytime in your dashboard.  </p>
                    </div>
                </div>
                <div class="col-md-6 b_content" style="margin-bottom:20px">
                    <div style="text-align:center">
                        <!--img src="img/growth.png" alt="filter" style="float:none;margin-bottom:20px"-->
                        <h4 style="margin-bottom:15px">Authorised Dealers</h4>
                        <p class="gray">Dealers from over 90 different countries are selling watches on W 4 Watch.It's easy to make international payments using Trusted Checkout.If you need assistance,our multilingual team is always there to help </p>
                    </div>
                </div>
				<div class="col-md-6 b_content" style="margin-bottom:20px">
                    <div style="text-align:center">
                        <!--img src="img/growth.png" alt="filter" style="float:none;margin-bottom:20px"-->
                        <h4 style="margin-bottom:15px">Safe & Secure Payment</h4>
                        <p class="gray">Yourmoney is held securely in an escrow account where it remains until you have recieved your order.Only then do we inititate the dealer's payout.</p>
                    </div>
                </div>
				<div class="col-md-6 b_content" style="margin-bottom:20px">
                    <div style="text-align:center">
                        <!--img src="img/growth.png" alt="filter" style="float:none;margin-bottom:20px"-->
                        <h4 style="margin-bottom:15px">In Case of Complaints</h4>
                        <p class="gray">In the case that the watch isn't delivered or deviates from the description given by the dealer,you can be refunded the money from escrow account.FI the transaction is canceleded and the watch is returned,you will recieve your money back quickly and easily. </p>
                    </div>
                </div>

            </div>
        </section>
    <?php } ?>


    <?php 	if($u_email != "") { ?>
    <!-- Subscribe -->
    <section id="subscribe">
        <div class="container">
		<form name="frmtemple" method="post" action="feedback.php" enctype="multipart/form-data">
            <div class="col-md-12 text-center">
                <h2>Send us your Feedback!</h2>
				<?php	$sql = "select * from register where email = '$u_email'";
						$rs = mysql_query($sql);
						while($row = mysql_fetch_array($rs)){ ?>
						<input type="hidden" name="txttitle" id="txttitle" value="<?php print $row['title']; ?>">
						<input type="hidden" name="txtemail" id="txtemail" value="<?php print $row['email']; ?>">
						<input type="hidden" name="txtlocation" id="txtlocation" value="<?php print $row['location']; ?>">
				<?php } ?>
				<input type="hidden" name="txtdate" id="txtdate" value="<?php print  date("Y/m/d"); ?>">
                <input type="text" name="txtcontent" id="txtcontent" placeholder="Your Feedback here..." required>
                <button type="submit" class="btn-default">Send</button>
            </div>
		</form>
        </div>
    </section>
	<?php } else { ?>
	<?php } ?>



    <?php 	if($u_email == "") { ?>
    <!-- Contact -->
    <section id="contact">
        <div class="container">
            <h2 class="text-center">Get <span>in touch</span> with us</h2>
            <div class="col-md-6 media_wrap">
                <div class="media">
                    <div class="media-body">
                        <div class="media-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                        <div class="media-content">
                            <h3>Adress</h3>
                            <p>falnir, mangalore, 575001</p>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="media-body">
                        <div class="media-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                        <div class="media-content">
                            <h3>Call us</h3>
                            <p>5264 - 564 - 362 , 4784 - 585 - 214</p>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="media-body">
                        <div class="media-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                        <div class="media-content">
                            <h3>Email</h3>
                            <p>support@gmail.com, help@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="media-body">
                        <div class="media-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                        <div class="media-content">
                            <h3>Working time</h3>
                            <p>10 AM to 22 PM, 01 PM to 00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
            <form name="frmnews" method="post" action="index.php" enctype="multipart/form-data" class="col-md-6 contact-form js-form">
                <div class="col-md-3 form-group"><input autocomplete="off" type="text" name="txttitle" id="txttitle" class="form-control required" placeholder="Your name..."></div>
                <div class="col-md-3 form-group"><input autocomplete="off" type="text" name="txtcontact" id="txtcontact" class="form-control required" placeholder="Your phone number..."></div>
                <div class="col-md-3 form-group"><input autocomplete="off" type="email" name="txtemail" id="txtemail" class="form-control required" placeholder="Your Email..."></div>
                <div class="col-md-3 form-group"><input autocomplete="off" type="text" name="txtsubject" id="txtsubject" class="form-control required" placeholder="Subject..."></div>
                <div class="form-group textarea"><textarea name="txtmsgs" id="txtmsgs" class="form-control required" rows="5" placeholder="Your message..."></textarea></div>
                <div><button type="submit" class="button" onclick="submit_temple();">Send your message</button></div>
                <span class="form-resault"></span>
            </form>
			<script type="text/javascript">
			function submit_temple(){
				var title = document.getElementById('txttitle').value;
					if(title != ""){
						document.forms['frmnews'].submit();
						document.getElementById('txtmsgs').value="";
					}
					else
					{
						}
			}

			$('#date .txtclass').datepicker({
				'format': 'd-m-yyyy',
				'autoclose': true
			});

			</script>
        </div>

    </section>
    <?php } ?>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124440.39881933945!2d74.78202260072291!3d12.922982868269026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba35a4c37bf488f%3A0x827bbc7a74fcfe64!2sMangaluru%2C+Karnataka!5e0!3m2!1sen!2sin!4v1520504565714" width="100%" height="450" frameborder="0" style="border:0;margin-bottom:-6px" allowfullscreen></iframe>
    <!-- Footer -->
    <footer>
        <p class="text-center">2018 &copy; All rights reserved.</p>
    </footer>
	
	  <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Register</h4>
			</div>
			<form name="frmtemple" method="post" action="register.php" enctype="multipart/form-data">
			<div class="modal-body">
			  <p class="form-group" style="width:100%">
			  <input type="text" class="form-control" name="txttitle" id="txttitle" placeholder="Name" style="width:100%;height:40px" minlength="6" required>
			  <input type="text" class="form-control" name="txtcontact" id="txtcontact" placeholder="Contact Number" style="width:100%;height:40px" onkeypress="return event.charCode > 47 && event.charCode < 58;" pattern="[0-9]{10,14}" required>
			  <input type="email" class="form-control" name="txtemail" id="txtemail" placeholder="Email ID" style="width:100%;height:40px" required>
			  <input type="password" class="form-control" name="txtpassword" id="txtpassword" placeholder="Password" style="width:100%;height:40px" minlength="6" required>
			  <input type="password" class="form-control" name="txtconfirmpassword" id="txtconfirmpassword" placeholder="Confirm Password" style="width:100%;height:40px" minlength="6" required>
			  <span id="message"></span>
			  <script>
				$('#txtpassword, #txtconfirmpassword').on('keyup', function () {
				  if ($('#txtpassword').val() == $('#txtconfirmpassword').val()) {
					$('#message').html('Correct Password').css('color', 'green');
				  } else 
					$('#message').html('Please Retype Password').css('color', 'red');
				});
			  </script>
			  <textarea class="form-control" name="txtaddress" id="txtaddress" placeholder="Full Address" style="width:100%;height:80px;resize:none;margin-bottom:20px" required></textarea>
			  <input type="text" name="txtlocation" id="txtlocation" class="form-control" placeholder="Location" style="width:100%;height:40px" required>
			  </p>
			</div>
			<div class="modal-footer">
			  <button type="submit" class="btn btn-primary" style="padding:10px 50px;margin-top:0px;font-family:'Montserrat', serif">Submit</button>
			</div>
			</form>
		  </div>
		  
		</div>
	  </div>
	
	  <div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Login</h4>
			</div>
			<form method="POST" role="form" class="loginForm" action="login.php">
			<div class="modal-body">
			  <p class="form-group" style="width:100%">
			  <input type="text" class="form-control" name="email" placeholder="Email ID" style="width:100%;height:40px">
			  <input type="password" class="form-control" name="password" placeholder="Password" style="width:100%;height:40px">
			  </p>
			</div>
			<div class="modal-footer">
			  <button type="submit" name="submit" class="btn btn-primary" style="padding:10px 50px;margin-top:0px;font-family:'Montserrat', serif">Login</button>
			</div>
			</form>
		  </div>
		  
		</div>
	  </div>
	
	  <div class="modal fade" id="myList" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">My Orders</h4>
			</div>
			<div class="modal-body" style="padding-top:0px">
			<?php 	$sql = "select * from service where email='$u_email' order by sid desc";
					$rs = mysql_query($sql);
					while($row = mysql_fetch_array($rs)){ ?>
				<p class="form-group" style="border-bottom:1px solid #ccc;font-size:12px;line-height:18px;padding:12px 0">
				<span style="font-size:16px;font-weight:600"><?php print $row['type']; ?></span><br>
				Placed on <?php print $row['date']; ?><br>
				Order <?php print $row['status']; ?>
				</p>
				<?php } ?>
			</div>
			<div class="modal-footer">
			  <button class="btn btn-primary" type="button" data-dismiss="modal" style="padding:10px 50px;margin-top:0px;font-family:'Montserrat', serif">Exit</button>
			</div>
		  </div>
		  
		</div>
	  </div>
	  
    <script src="../ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="../use.fontawesome.com/ceca91f341.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom JS -->
    <script src="js/custom.js"></script>
    </body>

</html>