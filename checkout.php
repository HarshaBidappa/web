<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

require 'PHPMailerAutoload.php';

$connect = mysqli_connect('localhost', 'root', '', 'cart');
$u_email=$_SESSION['EmailId'];
$isAddress = "";

if ($_SESSION['IsLoggedin'] == 'true') {

    if($_SESSION['isBackFromOrders'] == 'no'){
        if(filter_input(INPUT_GET, 'cod') == 'on'){
            $dynamicProductsRows = "";
            $total = 0;
            $email = $_SESSION['EmailId'];
            $uid = $_SESSION['UserId'];
            $query = "SELECT c.ProductId, c.Quantity, p.Name, p.Price
                        FROM products p
                        INNER JOIN cart c ON p.Id = c.ProductId 
                        where c.UserId = '$uid'";
            $result = mysqli_query($connect, $query);
            while ($product = mysqli_fetch_assoc($result)) {
                $ProductId = $product['ProductId'];
                $Quantity = $product['Quantity'];
                $Price = $product['Price'];
                $date = date_default_timezone_set('Asia/Kolkata');
                $Date = date("Y-m-d H:i:s");
                if(mysqli_query($connect, "INSERT INTO orders(ProductId, UserId, OrderDate, Quantity)
                                            VALUES('$ProductId','$uid','$Date','$Quantity')")){
                    mysqli_query($connect, "UPDATE products SET InStock = InStock - '$Quantity' WHERE Id = '$ProductId'");
                }

                $dynamicProductsRows .= '<tr>
                                            <td>'.$product['Name'].'</td>
                                            <td>₹ '.$Price.'</td>
                                            <td style="text-align:center">'.$Quantity.'</td>
                                            <td>₹ '.number_format($Quantity * $Price, 2).'</td>
                                            <td>'.$Date.'</td>
                                        </tr>';
                $total = $total + ($Quantity * $Price);
            }

            //Load Composer's autoloader
            require 'vendor/autoload.php';

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'beerendramc@gmail.com';                 // SMTP username
                $mail->Password = 'sweetdad';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('beerendramc@gmail.com', 'Beerendra M C');
                $mail->addAddress($email);     // Add a recipient

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Order Confirmed';
                $mail->Body    = 'Dear, <b>'.$_SESSION['UserName'].'</b>,<p>Your order has been confirmed for the following products:<p>
                                    <table border="1">
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Order Date</th>    
                                    </tr>'.$dynamicProductsRows.'
                                    </table><br/><p>Payable Amount = <b>₹ '.number_format($total,2).'</b></p>
                                    <p>Your order will be delivered within 7 working days.
                                    <p>Thank you for shopping with us,</p>
                                    <p>Scotch Hub team.</p>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                //echo 'success';
            }
            catch (Exception $e) 
            {
                echo 'Mailer Error: ', $mail->ErrorInfo;
            }

            mysqli_query($connect, "DELETE FROM cart WHERE UserId = '$uid'");
            
            $_SESSION['isFromCheckout'] = 'yes';
            header('location: orders.php');
        }
    }
    else{
        header('location: orders.php');
    }

    if (filter_input(INPUT_GET, 'action') == 'logout') {
        $_SESSION['IsLoggedin'] = 'false';
        $_SESSION['UserId'] = '';
        $_SESSION['UserName'] = '';
        header('location: index.php');
    }
} else {
    header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="cart.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,700" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body style="background-color:rgb(232,232,232);width:100%">


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
                    <li><a href="index.php?user=<?php echo $u_email?>" class="page-scroll">Home</a></li>


                    <?php 	if($u_email != "") { ?>

                    <li>
                        <a href="cart.php"><i class="fa fa-shopping-cart" style="color:white"></i> &nbsp;Cart
                            <?php

                            $uid = $_SESSION['UserId'];
                            $query = "SELECT COUNT(*) FROM cart where UserId = $uid";
                            $result = mysqli_query($connect, $query);
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


    <!--Add Address Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Delivery Address</h4>
			  </div>
			  <div class="modal-body">
				<form method="post" id="address_form" name="address_form">
					<div class="form-group">
						<label for="bname">House/ Building Name</label>
						<input type="text" class="form-control" Placeholder="Enter House/ Building Name" name="bname" id="bname" required>
					</div>
					<div class="form-group">
						<label for="area">Area</label>
                        <input type="text" class="form-control" Placeholder="Enter Area" name="area" id="area" required>
					</div>
					<div class="form-group">
						<label for="landmark">Landmark</label>
						<input type="text" class="form-control" Placeholder="Enter Landmark" name="landmark" id="landmark" required>
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" class="form-control" Placeholder="Enter City" name="city" id="city" required>
					</div>
					<div class="form-group">
						<label for="pincode">Pincode</label>
						<input type="number" class="form-control" Placeholder="Enter Pincode" name="pincode" id="pincode" required>
					</div>
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" class="form-control" Placeholder="Enter State" name="state" id="state" required>
					</div>
					<div class="form-group">
						<button type="submit" name="btnAddress" id="btnAddress" class="btn btn-info"
						style="width:7em;margin-left:40%">Add</button> <!-- data-dismiss="modal" data-toggle="modal" data-target="#myModal" -->
					</div>
				</form>
			  </div>
			  <div class="modal-footer">
			  </div>
			</div>

		  </div>
        </div>


        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><span style="font-size:20px">1 Delivery Address</span></div>
                        <div class="panel-body">
                            <?php
                                $UserId = $_SESSION['UserId'];
                                $query = "SELECT Address, Area, Landmark, State, City, PinCode FROM users WHERE Id = '$UserId'";
                                $result = mysqli_query($connect, $query);

                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    if ($row["Address"] != '') {
                                        $isAddress = 'yes';
                            ?>
                                <div class="col-md-11">
                                    <h4><?php echo $_SESSION['UserName']; ?></h4>
                                    <p style="line-height: 80%"><b><?php echo $_SESSION['MobileNo']; ?></b></p>
                                    <p style="line-height: 80%"><?php echo $row["Address"] . ', '; ?></p>
                                    <p style="line-height: 80%"><?php echo $row["Area"] . ', ' . $row["Landmark"] . ', '; ?></p>
                                    <p style="line-height: 80%"><?php echo $row["City"] . ', ' . $row["State"] . ' - ';?><b><?php echo $row["PinCode"]; ?></b></p>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-info">Edit</button>
                                </div>

        <!--Edit Address Modal -->
		<div id="myModal2" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Delivery Address</h4>
			  </div>
			  <div class="modal-body">
				<form method="post" id="editaddress_form" name="editaddress_form">
					<div class="form-group">
						<label for="bname2">House/ Building Name</label>
						<input type="text" class="form-control" value="<?php echo $row["Address"]; ?>" name="bname" id="bname2" required>
					</div>
					<div class="form-group">
						<label for="area2">Area</label>
                        <input type="text" class="form-control" value="<?php echo $row["Area"]; ?>" name="area" id="area2" required>
					</div>
					<div class="form-group">
						<label for="landmark2">Landmark</label>
						<input type="text" class="form-control" value="<?php echo $row["Landmark"]; ?>" name="landmark" id="landmark2" required>
					</div>
					<div class="form-group">
						<label for="city2">City</label>
						<input type="text" class="form-control" value="<?php echo $row["City"]; ?>" name="city" id="city2" required>
					</div>
					<div class="form-group">
						<label for="pincode2">Pincode</label>
						<input type="number" class="form-control" value="<?php echo $row["PinCode"]; ?>" name="pincode" id="pincode2" required>
					</div>
					<div class="form-group">
						<label for="state2">State</label>
						<input type="text" class="form-control" value="<?php echo $row["State"]; ?>" name="state" id="state2" required>
					</div>
					<div class="form-group">
						<button type="submit" name="btnUpdateAddress" class="btn btn-info"
						style="width:7em;margin-left:40%">Update</button> <!-- data-dismiss="modal" data-toggle="modal" data-target="#myModal" -->
					</div>
				</form>
			  </div>
			  <div class="modal-footer">
			  </div>
			</div>

		  </div>
		</div>
                    <?php  } else {
                            ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="margin-left:43%;">Add an Address</button>
                            <?php
                            }
                        }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">


            <div class="panel panel-default">
            <div class="panel-heading"><span style="font-size:20px">2 Order Summary</span></div>
            <div class="panel-body">
            <?php
                $connect = mysqli_connect('localhost', 'root', '', 'cart');
                $uid = $_SESSION['UserId'];
                $query = "SELECT c.Id, p.Name, p.Price, p.Image, c.Quantity
                            FROM products p
                            inner join cart c on p.Id = c.ProductId
                            where c.UserId = $uid
                            order by c.Id";
                $result = mysqli_query($connect, $query);
                $count = mysqli_num_rows($result);
                if ($count > 0):
            ?>
            <table class="table">
                <tr>
                    <th width="20%">Product</th>
                    <th width="30%">Product Name</th>
                    <th width="10%" class="text-center">Quantity</th>
                    <th width="20%" class="text-center">Price</th>
                    <th width="15%" class="text-center">Total</th>
                    <!-- <th width="5%">Action</th> -->
                </tr>

            <?php
                $total = 0;
                while ($product = mysqli_fetch_assoc($result)) {
            ?>

                <tr>
                    <td>
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($product['Image']); ?>" name="image" style="width:100px;height:100px" />
                    </td>
                    <td><?php echo $product['Name']; ?></td>
                    <td class="text-center"><?php echo $product['Quantity']; ?></td>
                    <td class="text-center">₹ <?php echo $product['Price']; ?></td>
                    <td class="text-center">₹ <?php echo number_format($product['Quantity'] * $product['Price'], 2); ?></td>
                </tr>
            <?php
                $total = $total + ($product['Quantity'] * $product['Price']);
                }
            ?>
            <tr>
                <td colspan="4" class="text-right">Total</td>
                <td class="text-center">₹ <?php echo number_format($total, 2); ?></td>
            </tr>
        </table>

            <?php
               else: ?>
                <h4 class="text-center">Your Shopping Cart is empty</h4>
                <a href="home.php" style="margin-left:40%;width:20%" class="btn btn-info col-md-6"><i class="fa fa-cart-plus" ></i>&nbsp; Add Items Now </a>
            <?php
               endif;?>
            </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><span style="font-size:20px">3 Payment Options</span></div>
                        <div class="panel-body">
                        <form >
                            <input type="radio" checked name="cod"> &nbsp;Cash On Delivery
                            <br/><br/>
                            <?php if($isAddress == 'yes'){ ?>
                            <input type="submit" class="btn btn-info" style="margin-left:40%;width:15em" name="confirmOrder" id="confirmOrder" value="Confirm Order">
                            <?php }
                                  else{ ?>
                                  <div class="alert alert-warning text-center">
                                    <strong>Please Add your delivery address first!</strong>
                                  </div>
                            <?php } ?>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
<script>

$(document).ready(function(){
    $('#address_form').on('submit', function(e){
    e.preventDefault();
        $.ajax({
            url: "addAddress.php",
            method: "POST",
            data: $('#address_form').serialize(),
            success: function(data)
            {
                if(data == 'saved')
                {
                    $('#address_form')[0].reset();
                    $('#myModal').modal('hide');
                    swal({  title: 'Address saved Successfully!',
                            text: 'You can continue buying',
                            icon: 'success' ,
                    }).then(function() {
                    window.location = "checkout.php";
                    });
                }
                else{
                    $('#address_form')[0].reset();
                    swal({  title: 'Something wrong happened!',
                            text: 'Please try again later',
                            icon: 'warning' ,
                    }).then(function() {
                    window.location = "checkout.php";
                    });
                }
            }
        });
    });

    $('#editaddress_form').on('submit', function(e){
    e.preventDefault();
    //alert('aaaa');
    $.ajax({
        url: "addAddress.php",
        method: "POST",
        data: $('#editaddress_form').serialize(),
        success: function(data)
        {
            if(data == 'saved')
            {
                $('#editaddress_form')[0].reset();
                $('#myModal2').modal('hide');
                swal({  title: 'Address updated Successfully!',
                        text: 'You can continue buying',
                        icon: 'success' ,
                }).then(function() {
                window.location = "checkout.php";
                });
            }
            else{
                $('#editaddress_form')[0].reset();
                $('#myModal2').modal('hide');
                swal({  title: 'Something wrong happened!',
                        text: 'Please try again later',
                        icon: 'warning' ,
                }).then(function() {
                window.location = "checkout.php";
                });
            }
        }
    });
    });

    // $("#confirmOrder").click(function(event){
    //     swal({  title: 'Your Order has been Placed Successfully!',
    //             text: 'Thank you for shopping with us',  
    //             icon: 'success' ,
    //     }).then(function() {
    //     window.location = "orders.php";
    //     });
    //     event.preventDefault();
    // });

});

</script>
</html>