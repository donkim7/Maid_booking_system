<?php

require "maidserver.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = login($_POST);

	if(count($errors) == 0)
	{
		header("Location: profilehome.php");
		die;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Maid Login</title>
<style type="text/css">
/* 
Ey dont forget to look for a background pic for this
 */


*{
    padding: 0;
    margin: 0;
    text-decoration: none;
    list-style: none;
    box-sizing:border-box;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

body{
    background: lightgray ;

}
.container{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
    margin-top: 2px;
}

.box{
    background: white;
    display: flex;
    flex-direction: column;
    padding: 25px 25px;
    border-radius: 15px;
    box-shadow:
  16.7px 10.2px 1.4px rgba(0, 0, 0, 0.008),
  25.9px 15.7px 3.3px rgba(0, 0, 0, 0.016),
  30.2px 18.3px 6.1px rgba(0, 0, 0, 0.025),
  33.4px 20.3px 10.9px rgba(0, 0, 0, 0.033),
  43.1px 26.2px 20.5px rgba(0, 0, 0, 0.042),
  135px 82px 49px rgba(0, 0, 0, 0.05)

}

.form-box{
    width: 450px;
    margin: 0px 10px;
}

.form-box header{
    font-size: 25px;
    font-weight: 700;
    padding-bottom: 10px;
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 10px;
}

.form-box form .field{
    /* display: flex; */
    margin-bottom: 10px;
    flex-direction: column;

}

.form-box form .input input{
    height: 40px;
    width: 100%;
    font-size: 16px;
    padding: 0 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
}
.btn{
    height: 35px;
    /* background: rgb(204, 159, 11); */
    background: rgb(27, 27, 27);
    border-radius: 5px;
    font-size: 15px;
    color: white;
    cursor: pointer;
    transition: all;
    margin-top: 10px;
    padding: 0 10px;
    width: 100%;
}
.btn:hover{
    opacity: 0.82;
}
.submit{
    width: 100%;
}

.links{
    margin-bottom: 15px;
}






/* navigation tab css */
.navtab{
                display: flex; 
                
            }
            /* img{
                width: 100%;
                height: auto;
            } */

            label.logo{
                color: black;
                font-size: 35px;
                line-height: 80px;
                padding: 0 100px;
                font-weight: bold;
            }

            nav ul{
                float: right;
                margin-right: 30px;
            }

            nav ul li{
                display: inline-block;
                line-height: 80px;
                margin: 0 5px;
            }

            nav ul li a{
                color: black;
                font-size: 20px;
                padding: 7px 13px;
                border-radius: 3px;
                text-transform: uppercase;
            }

            /* nav ul li a::after{
                content: '';
                height: 3px;
                width: 0;
                background: black;
                position: absolute;
                left: 0;
                bottom: -10px;
                transition: 0.5s;
            } */

            nav ul li a:hover{
                color: rgb(240, 240, 240);
            }
            a.active, a:hover{

                /* background: gray; */
                transition: .5s;
            }

            .checkbtn{
                font-size: 30px;
                color: black;
                float: right;
                line-height: 80px;
                margin-right: 40px;
                cursor: pointer;
                display: none;
            }

            #check{
                display: none;

            }
            /* for laptop and ipad/tablet black hover for the navigation tab */
            @media (min-width:768px){
                nav ul li a:hover{
                color: black;
                background: white ;
            }

            }
            @media (max-width:952px){
                label.logo{
                    font-size: 30px;
                    padding-left: 50px;
                }
                nav ul li a{
                    font-size: 16px;
                }
               
            }
            /* For the phone and well basically the ipad/tablet */
            @media (max-width:768px){
                .checkbtn{
                    display: block;
                }
                ul{
                    position: fixed;
                    width: 100%;
                    height: 100vh;
                    background: rgb(180, 177, 177);
                    top: 80px;
                    left: -100%;
                    text-align: center;
                    transition: all .5s;
                }
                nav ul li{
                    display: block;
                    margin: 50px 0;
                    line-height: 30px;
                }
                nav ul li a{
                    font-size: 20px;
                }
                a:hover{
                    
                    color: #fff2d6;
                }
                a.active{
                    background: none;
                }
                #check:checked ~ ul{
                    left: 0;

                }
            }
            /* section{

            } */

            .wrapper{
                width: 100%;
            }

            .img-info{
                width: 100%;
            }

            .img-info h1{
                padding: 30px 30px 20px;
                font-size: 50px;
                color: 111;
                line-height: 44px;
            }

            .img-info p{
                padding: 0px 30px 20px;
                font-size: 16px;
                color: 111;
                line-height: 24px;
            }

            .img-secc{
                width: 100%;
            }

            @media only screen and (min-width: 768px){
                .wrapper{
                    width: 600px;
                    margin: 0 auto;
                }

                .img-info h1{
                padding: 20px 30px 0px;
                
            }

            .img-info p{
                padding: 20px 0px 0px;
                
            }

            .img-secc{
                padding-top: 30px;
            }

            }

            @media only screen and (min-width: 1000px){
                .wrapper{
                    width: 1000px;
                    margin: 0 auto;
                }

                .img-info{
                    width: 50%;
                    float: right;
                }

                .img-info h1{
                padding: 20px 0px 0px 30px ;
                
            }

            .img-info p{
                padding: 20px 0px 0px 30px;
                
            }

                .img-secc{
                    padding-top: 20px 40px 0px 0px;
                    width: 50%;
                    float: left;
                }

            }

            .logo{

                cursor: pointer;
            }
</style>
</head>
<body>

    <!-- navigation bar html -->
    <div class="navigate">

        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
               <i class="fa fa-reorder"></i>
            </label>
       
            <a  href="../home.php"> <label class="logo" >MaidServs</label></a>
               <!-- <img src="logowhite250.png" class="logo"> -->
                <ul>
                   <li><a class="active" href="">Home</a></li>
                   <li><a href="about.html">About</a></li>
                   <li><a href="contacts.html">Contacts</a></li>
               </ul> 
           </nav>
       </div>

<!-- End of navigtion bar thingy -->

<div class="container">

<div class="box form-box">
<header>Login</header>
<form action="" method="post">
<div style="color: brown;" >
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div>
    <div class="field input">
        <label for="username">email:</label>
        <input type="text" name="email" id="username" required>
    </div>
    <div class="field input">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" required>
    </div>
    <div class="field ">
        <input class="btn" type="submit" name="submit" value="Login" required>
    </div>
    <div class="links">
        Don't have an account?<a href="Maidregphp.php"> Register here</a>
    </div>
    
</form>

</div>

</body>
</html>