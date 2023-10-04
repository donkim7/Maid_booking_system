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
    /* background:darkred; */
    color:black;
    transform: scale(1.05);
    background-color: rgb(240, 240, 240);

}
.service:hover i{
    /* color:white; */
    
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
.ourservices{
   margin-left:45% auto;
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

.service{
    background-color:darkgray;
    box-shadow:
     16.7px 10.2px 1.4px rgba(0, 0, 0, 0.008),
     25.9px 15.7px 3.3px rgba(0, 0, 0, 0.016),
     30.2px 18.3px 6.1px rgba(0, 0, 0, 0.025),
     33.4px 20.3px 10.9px rgba(0, 0, 0, 0.033),
     43.1px 26.2px 20.5px rgba(0, 0, 0, 0.042),
     135px 82px 49px rgba(0, 0, 0, 0.05)
}

        </style>
        
    </head>
<body>

<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
       <i class="fa fa-reorder"></i>
    </label>

    <a  href="../home.php"> <label class="logo" >MaidServs</label></a>
       <!-- <img src="logowhite250.png" class="logo"> -->
        <ul>
           <li><a class="active" href="">Home</a></li>
           
           <li><a href="">About</a></li>
           <li><a href="">Contacts</a></li>
           <li><a href="bookhistory.php">booking history</a></li>
           <li><a href="logout.php">Log out</a></li>
       </ul> 
   </nav>
</div>


<div class="responsive_alignment">
    <div class="ourservices"><h1>our services</h1></div>

    <div class="row">
         <a href="modifications/laundry.php">
            <div class="service">
                <!-- <i class="fa-solid fa-fire-burner"></i> -->
                <h2>Laundry</h2>
            </div>
         </a>
        
        
    
        <a href="modifications/cooking.php">
            <div class="service">
                <!-- <i class="fa-brands fa-pagelines"></i> -->
                <h2>Cooking</h2>
        
            </div>
        </a>
            
        <a href="modifications/cleaning.php">
             <div class="service">
                <!-- <i class="fa-solid fa-shirt"></i> -->
                <h2>Cleaning</h2>
            
             </div>
        </a>

        <a href="modifications/gardening.php">
             <div class="service">
                <!-- <i class="fa-solid fa-shirt"></i> -->
                <h2>Gardening</h2>
            
             </div>
        </a>       
        
    </div>
</div>
</body>
    </html>
    