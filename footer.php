<?php
function generateFooter() {
    $html = '<!DOCTYPE html>
    <html lang="en">
        <head>
            <title>LMS</title>
            <link rel ="stylesheet" href="footer.css">
            
    
        </head>
        <body>
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
                                <div class ="fb"><a href ="#"><img src ="images/fb1,jpeg"></a>  </div> 
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
