<?php
function generateFooter() {
    $html = '
        <style>
   




.footer {
    background-color: black;
    border: 3px solid black;
    border-radius:20px;
    border-top: none;
    display: grid;
    grid-template-columns: 30vw 39vw 29vw;
 }
 .fpart1,.fpart2,.fpart3,.footer{
   height:240px;
 }
    



 .fpart1{
    grid-column: 1;
    background-color:white;
    border-right: 3px solid black;  
 }



 .fpart2{
    grid-column: 2;
    border-right: 3px solid black;
 }

 .fpart3{
    grid-column: 3;
    
 }
 .fpart1, .fpart3 {
        border-radius: 20px;
        
    }


.inner1{
    display: grid;
    grid-template-columns: 12vw 17vw;
}

.image{
    grid-column: 1;

}
.image img{
    margin-top: 10px;
    margin-left: 30px;
    width:140px;
    height: 130px;
}
.aboutus{
    margin-top: 10px;
    grid-column: 2;
    
}

.inner2{
    display: grid;
    grid-template-rows: 10vh 10vh;
}

.socialmeadia{
    grid-row: 1;
    
    display: grid;
    grid-template-columns: 8vw 8vw 8vw 8vw 8vw;
}

.fb{
   grid-column: 1;
   border-radius: 50%; 
   

}
.insta{
    grid-column: 2;

}
.mail
{
    grid-column: 3;

}
.linkdn{
    grid-column: 4;

}
.whatsapp{
    grid-column: 5;

}
.fb,.insta,.mail,.linkdn,.whatsapp{
   display: flex;
   justify-content: center;
   align-items: center;
   

}

.inner2 img{
    width:40px;
    height:40px;
    border: none;
    padding: 0;
    margin-left:5px;
    border-radius: 10px; 
    overflow: hidden;

}
.quicklinks{


    justify-content: center;
    grid-row: 2;
    display: grid;
    grid-template-columns: 8vw 8vw 8vw ;

}
 a{
    color:rgb(57, 232, 130);

}
.map{
    padding: 4px;
}

quick1{
    grid-column: 1;

}
quick2{
    grid-column: 2;
}

quick3{
    grid-column: 3;
    
}

.inner3{
    display: grid;
    grid-template-columns: 12vw 15vw;
    
}
.details{
    grid-column: 1;
    display: grid;
    grid-template-rows: 10vh 10vh 6vh;
    justify-content: center;
    align-items: center;
}
.map{
    grid-column: 2;
    
    
}

.map iframe {
    width : 180px;
    height:180px;
    margin: 20px; /* Add 20 pixels of margin around the iframe */
    border: 2px solid #ccc; /* Add a 2 pixel solid border around the iframe */
    border-radius: 8px; /* Add a border radius to make the corners rounded */
}

.address{
    grid-row: 2;

}
.tel{
     grid-row: 1;
}
.contactus{

    grid-row: 3;
}




/*---------------------------------------------COLORS------------------------------------------------------------------------------------*/
 .fpart1,.fpart2,.fpart3{
    background-color: black;
   
}

.fpart1,.fpart2 a ,.aboutus,.tel a ,.contactus a,.address{
     color:white;
}
        </style>
            <br><br>
            <div class="main">
           
                <div class ="footer">
                    
                    <div class="fpart1">
                        <div class ="inner1">
                                <div class ="image"> <img src ="images/footimage1.png"></div>  <div class ="aboutus"><b>About us</b><br><br> Welcome to our Library Management System! Simplifying access,<br>  enhancing organization, and fostering learning environments.
                                </div>
                        </div>
                
                    </div>
    
                    <div class="fpart2">
                        <div class ="inner2">
                            <div class ="socialmeadia"> 
                                <div class ="fb"><a href ="#"><img src ="images/fb1.jpeg"></a>  </div> 
                                <div class="insta"><a href ="#"><img src ="images/insta.jpeg"></a> </div> 
                                <div class="mail"><a href ="#"><img src ="images/mail.png"></a> </div> 
                                <div class ="linkdn"> <a href ="#"><img src ="images/linkedin1.png"></a></div> 
                                <div class ="whatsapp"><a href ="#"><img src ="images/whatsapp1.webp"></a> </div> 
                            </div>
                            <div class ="quicklinks"> 
                               
                                <div class ="quick1">
                                    <a href ="#">Contact us</a> <br>
                                     <a href ="#">Rules</a> <br>
                                     <a href ="#">Jobs</a>
                                </div> 
                                <div class ="quick2">
                                    <a href ="#">Terms</a> <br>
                                     <a href ="#">FAQ</a> <br>
                                     <a href ="register/logout.php">Logout</a>
                                </div> 
                                <div class="quick3">
                                    <a href ="#">Books</a> <br>
                                     <a href ="#">Profile</a> <br>
                                     <a href ="#">Dashboard</a>
                                </div> 
    
                            </div>
    
                        </div>
    
                    </div>
    
                    <div class ="fpart3">
                        <div class ="inner3">
                            <div class="details">
                                <br><br>
                                <div class ="tel"><a href ="tel:+94 71 095 36 77">+94 710953677</a><br></div>
                                <div class ="address">SLIIT Malabe Campus,<br> New Kandy Rd,<br> Malabe<br> 10115</div>
                                <div class="contactus"><a href ="#">Contact Us</a> </div>
                            </div>  
                            <div class ="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7985117740163!2d79.9703642102833!3d6.914677493056023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae256db1a6771c5%3A0x2c63e344ab9a7536!2sSri%20Lanka%20Institute%20of%20Information%20Technology!5e0!3m2!1sen!2slk!4v1712893611333!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                           </div>
    
                        </div>
    
                    </div>
                    
                    
    
                </div>
            </div>
        </body>
    </html>
    
    ';

    return $html;
    }

    

?>
