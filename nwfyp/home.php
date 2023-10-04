<!DOCTYPE HTML>
<html>
    <head>
        <title>  responsive navtab  </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/b3f5845c14.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" type="text/css"/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <style type="text/css">
*{
    padding: 0;
    margin: 0;
    box-sizing:border-box;
    text-decoration: none;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}


body{
    background: lightgray ;
    
    text-decoration: none;
}

.container{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
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
                text-decoration: none;
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

            /* .checkbtn{
                font-size: 30px;
                color: black;
                float: right;
                line-height: 80px;
                margin-right: 40px;
                cursor: pointer;
                display: none;
            } */

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



            @media only screen and (min-width: 768px){
                .wrapper{
                    width: 600px;
                    margin: 0 auto;
                }
            }

            .logo{

                cursor: pointer;
            }




                     /* contact */
         .contact{
            position: relative;
            min-height: 100vh;
            padding:50px 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /*background: url(img13.jpg)    ;*/
            background-size: cover;
            

        }

        .contact .contect
        {
          max-width: 800px;
          text-align: center;  
        }
        .contact .contect h2{
            font-size: 36px;
            font-weight: 500;
            color:aliceblue
        }
        .contact .contect p{
            font-weight: 300;
            color:aliceblue;

        }
        .container1 .contactInfo{
            width: 50%;
            display:flex;
            flex-direction: column;
            border: #666;
        }
.container1{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
}


.container1 .contactInfo .box .icon{
min-width:60px;
height: 60px;
background:aliceblue;
display: flex;
justify-content: center;
align-items: center;
font-size: 22px;
border-radius: 50%;

}

.container1 .contactInfo .box {
    position: relative;
    padding: 20px 0;
    display: flex;  
}
.container1 .contactInfo .text {
    display: flex;
    margin-left: 20px;
    font-size: 16px;
    color:aliceblue;
    flex-direction: column;
    font-weight: 300;
}
.container1 .contactInfo .box .text h3{
font-weight: 500;
color:#00bcd4;

}

 .contactForm{
    width:40%;
    padding:40px;
    /*
    background: coral;
    */
 }
 .contactForm h2 {
    font-size: 30px;
    color: #333;
    font-weight: 500;
 }

.contactForm .inputBox{
    position: relative;
    width: 100%;
    margin-top: 18px;
}

.contactForm .inputBox input,
.contactForm .inputBox textarea
{
    width:100% ;
    padding: 5px 0;
    font-size: 16px;
    margin:10px 0;
    border:none;
    border-bottom: 2px solid #333;
    outline: none;
    resize: none;
}

.contactForm .inputBox span{
    position:absolute;
    left: 0;
    padding:5px 0;
    font-size: 16px;
    margin:10px 0;
    pointer-events: none;
    transition: 0.5s;
    color:#666;
}
.contactForm .inputBox input:focus ~ span,
.contactForm .inputBox input:valid ~ span,
.contactForm .inputBox textarea:focus ~ span,
.contactForm .inputBox textarea:valid ~ span
{
    color: #e91e63;
    font-size: 12px;
    transform: translateY(-20px);
}


.contactForm .inputBox input[type="submit"]
{
    width: 100px;
    background:#00bcd4;
    color:#fff;
    cursor: pointer;
    padding: 10px;
    font-size: 18px;
}

@media (max-width:991px)
{
    .contact
    {
        padding: 50px;
    }
    .container1
    {
flex-direction: column;
    }
    .container1 .contactInfo
    {
        margin-bottom:40px ;
    }
    .contact .contactForm
    {
     width: 100%;   
    }
}




/* about */
.body1{
            background: url(img7.jpg) no-repeat left   ;

            background-size: 45%;
            background-color: #666;
            overflow: hidden;
            padding: 70px 0;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
             
        }
        img7{
            transform: scaleX(-1);
        }
       /* .about-section{
        
        
       }  */
       .inner-container{
        width: 55%;
        float:right;
        background-color: darkgray;
        padding: 150px;

       }
       .inner-container h1{
        margin-bottom: 30px;
        font-size: 30px;
        font-weight: 900;
       }
       .text{
        font-size: 13px;
        color: #545454;
        line-height: 30px;
        text-align: justify;
        margin-bottom: 40px;
       }
       .skills{
        display: flex;
        justify-content:space-between;
        font-weight: 700;
        font-size: 18px;

       }
       @media screen and (max-width:1200px){
        .about-section{
            background-size: 100%;
            padding:100px 40px;
        }
        .inner-container{
            width:200% ;
        }
       }


       @media screen and (max-width:1000px){
        .about-section{
        
            padding:0;
        }
        .inner-container{
            width:100% ;
        }
       }


       /* categories */
       .container{
    width:100%;
    height: 100vh;
    padding:0 8%;
}
.container h1{
    text-align: center;
    padding-top: 100px;
    margin-bottom: 200px;
    font-weight: 600;
    position:relative;
}
.container h1::after{
    content:'';
    background:red;
    width: 100px;
    height: 5px;
    position:absolute;
    bottom:-5px;
    left:50%;
    transform: translateX(-50%);

}

.row{
    margin:200px 90px auto;
    grid-gap:20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: 30px;
}
.service{
    text-align: center;
    padding:25px 10px;
    border-radius: 5px;
    font-size: 14px;
    cursor:pointer;
    background: transparent;
    transition: transform 0.5s, background 0.5s;


}

.service i{
    font-size: 90px;
    margin-bottom: 10px;
    color:red;
}
.service h2{
    font-weight: 8000px;
    margin-bottom: 8px;
    text-decoration-color: black;
}

.service:hover{
    background:darkred;
    color:aliceblue;
    transform: scale(1.05);

}
.service:hover i{
    color:white;
}
.back-video{
    position:absolute;
    right:0;
    bottom: 0;
    z-index: -1;
    /*
    position: absolute;
    min-width: 100%;
    max-width: none;
    top:50%;
    left:50%;
    transform: translate(-50%,-50%);*/
    opacity: 0.3;
    
}
@media (min-aspect-ratio:16/9){
    .back-video{
        width: 100%;
        height: auto;
    }
}

@media (max-aspect-ratio:16/9){
    .back-video{
        width: auto;
        height: 100%;
    }
}
        </style>
        
    </head>
<body>
<video autoplay loop muted plays-incline class="back-video">
        <source src="vlc-record-2023-04-29-22h55m01s-mainstage-bg.mp4-.mp4" type="video/mp4">
        </video>
        <!-- navigation bar html -->
        <div class="navigate">

            <nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fa fa-reorder"></i>
    </label>

    <a  href="home.php"> <label class="logo" >MaidServs</label></a>
    <!-- <img src="logowhite250.png" class="logo"> -->
    <ul>
        <li><a class="active" href="">Home</a></li>
        <li><a href="custormaid.php">Register/Login</a></li>
        <li><a href="">About</a></li>
        <li><a href="admin/admin.php">Admin</a></li>
       </ul> 
    </nav>
</div>

<h1>our services</h1>
<div class="row">
    <a href="customer/custlogphp.php">
        <div class="service">
           
            <i class="fa-solid fa-fire-burner"></i>
             <h2>Personal Chef</h2>
        </div></a>
        
        <a href="customer/custlogphp.php">
            <div class="service">
                <i class="fa-solid fa-baby"></i>
        <h2>Baby Sitters</h2>
        
    </div></a>
    
        <a href="customer/custlogphp.php">
            <div class="service">
                <i class="fa-brands fa-pagelines"></i>
                <h2>Gardening</h2>
        
            </div></a>
            
            <a href="customer/custlogphp.php">
                <div class="service">
            <i class="fa-solid fa-shirt"></i>
            <h2>Laundry Services</h2>
            
        </div></a>
        
        <a href="customer/custlogphp.php">
        <div class="service">
            <i class="fa-solid fa-person-cane"></i>
            <h2>Eldery Care</h2>
        
        </div></a>

        <a href="customer/custlogphp.php">
            <div class="service">
            <i class="fa-solid fa-person-half-dress"></i>
           <h2>Maids</h2>
        </div></a>
        
        <a href="customer/custlogphp.php">
            <div class="service">
            <i class="fa-solid fa-broom"></i>
            <h2>Special Event Cleaning </h2>
            
        </div></a>
        
        <a href="customer/custlogphp.php">
            <div class="service">
                <i class="fa-solid fa-house-chimney-window"></i>
                <h2>Home Maintenance Services</h2>
            </div></a>
            
            <a href="customer/custlogphp.php">
                <div class="service">
                    <i class="fa-solid fa-toilet"></i>
                    <h2>Disaster Cleaninig </h2>
                    
                </div></a>
                
                <a href="customer/custlogphp.php">
                    <div class="service">
        <i class="fa-solid fa-envelopes-bulk"></i>
            <h2>Office Cleaninig </h2>
        </div></a>
        <div class="content">
        </div>
    </div>

    
    
    
    <section class="body1">
        
        <div class="about=section">
            <div class="inner-container">
                <h1>About Us </h1>
                <p class="text">
                    In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is availab  
                </p>
<div class="skills">
    <span>Register Yourself</span>
    <!----
    <p>simply contact us and we will send a team to your site along with all the paperwork and other required documentation </p>
    --->
    <span>Setup your Schedule</span>
    <!---
    <p>provide us the schedule and timings,we will set up everything according to your requirements </p>
-->
    <span>Relax and Leave the rest on us</span>
    <!---
    <p>Thats it, you have done your part.Our team will do the regular cleaning according to the schedule you have provide</p>
    --->
</div>
</div>
</div>
</section>




<section class="contact">
    <div class="content">
        <h2>Contact Us </h2>
        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p>
        
        </div>
        <div class="container1">
            <div class="contactInfo">
                <div class="box">
                <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="text">
                    <h3>Address</h3>
                        <p>Coict-Kijitonyama</p>
                    </div>
                </div>
                
                <div class="box">
                    <div class="icon"><i class="fa-solid fa-envelope-circle-check"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>maidservs.gmail.com</p>
                    </div>
                </div>
                    
                
                <div class="box">
                        <div class="icon"><i class="fa-solid fa-phone-volume"></i></div>
                        <div class="text">
                            <h3>Phone</h3>
                            <p>0687032084</p>
                        </div>
                    </div>
                    

                    
                </div>
                <div class="contactForm"></div>
        <form>
            <h2>Send Message</h2>
            <div class="inputBox">
                <input type="text" name="" required="required">
                <span>Full Name</span>
            </div>
            
            <div class="inputBox">
                <input type="text" name="" required="required">
                <span>Email</span>
            </div>

            <div class="inputBox">
                <textarea required="required"></textarea>
                <span>Type your Message...</span>
            </div>

            <div class="inputBox">
                <input type="submit" name="" value="Send">
                
            </div>

            
            
        </form>
       </div> 
    </section>
    
</body>
    </html>
    