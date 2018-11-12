
<?php

session_start();

$connect = mysqli_connect('localhost', 'root', '', 'cart');
$u_email=$_SESSION['EmailId'];
if ($_SESSION['IsLoggedin'] == 'true') {
   
    $_SESSION['isFromCheckout'] = 'no';
    $_SESSION['isBackFromOrders'] = 'no'; 
    
    if (filter_input(INPUT_GET, 'action') == 'delete') {
        $Id = filter_input(INPUT_GET, 'id');
        $query = "DELETE FROM cart where Id = $Id";
        $result = mysqli_query($connect, $query);

    }



} else {
    header('location: cart.php');
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="mainpage.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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



                    <?php 	if($u_email == "") { ?>
                        <li><a href="#contact" class="page-scroll">Contact</a></li>
                    <?php } else { ?>
                    <?php } ?>





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

<form style="margin-top: 120px">
            <div class="col-md-1"></div>
            <div class="col-md-10">
            <div class="panel panel-default">
            <div class="panel-heading"><span style="font-size:20px">My Cart</span></div>
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
                    <th width="5%" class="text-center">Action</th>
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
                    <td class="text-center">
                        <a href="cart.php?action=delete&id=<?php echo $product['Id']; ?>">
                            <div class="btn-xs btn-danger" >Remove</div>
                        </a>
                        <!-- <button name="remove" data-id="<?php echo $product['Id']; ?>" class="btn-xs btn-danger">Remove</button> -->
                    <td>
                </tr>
		    <?php
            $total = $total + ($product['Quantity'] * $product['Price']);
            }
            ?>
		   <tr>
				<td colspan="4" class="text-right">Total</td>
				<td class="text-center">₹ <?php echo number_format($total, 2); ?></td>
		   </tr>
		   <tr>
				<td colspan="6">
                    <div class="row">
					<a href="index.php?user=<?php echo $u_email?>" style="margin-left:10%;width:35%" class="btn btn-info col-md-6"><i class="fa fa-cart-plus" ></i>&nbsp; Continue Shopping </a>
                    <a href="checkout.php" style="margin-left:10%;width:35%" class="btn btn-info col-md-6"><i class="fa fa-credit-card" ></i>&nbsp; Place Order</a>
                    </div>
				</td>
		   </tr>
           </table>

                <?php else: ?>
                <h4 class="text-center">Your Shopping Cart is empty</h4>
                <a href="index.php?user=<?php echo $u_email?>"  style="margin-left:40%;width:20%" class="btn btn-info col-md-6"><i class="fa fa-cart-plus" ></i>&nbsp; Add Items Now </a>
                <?php endif;?>
            </div>
            </div>
            </div>
            <div class="col-md-1"></div>
    </form>
</body>
</html>