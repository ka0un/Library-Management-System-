<?php
    function header($pathLinks)
    {
        $html = '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>LMS</title>
                    <link rel ="stylesheet" href="header.css">
                    
            
                </head>
                <body>
                    
                        <div class ="part1">
                        
                            <div class="imgbook">
                                <img src ="images/books.svg">
                            </div>
                            <div class="brand">
                                    SLIIT Main Library
                            </div>
                            <div class="nav">
                                <div class ="navhome"><a href ="#">HOME</a></div>
                                <div class ="navbook"><a href ="#">BOOK</a></div>
                                <div class ="navdashboard"><a href="#">DASHBOARD</a></div>';

                                
                                
                $html2= '</div>
                            <div class="rightcon">
                                <div class="text">
                                    <div class ="hellow"> Hellow User!</div>
                                    <div class ="log"><a href="register/login.php">Login</a></div>
                                </div>
                                <div class ="userimg"> <img src ="images/userimage2.jpg"></div>
                                    
                            
            
                            </div>
            
                            
            
                        </div>
            
                        <div class ="part2">
                            <div class ="path">
                                <a href ="#">HOME</a> > ';


        foreach($pathLinks as $path)
        {
            $html .= '<a href = "'.$path['url']. '" >'.$path['text'].'</a></div';
        } 

        $html .= '   </div>
                  </div>
                  </body>
                  </html>';

        return $html;
    }

?>



<!--example arry------ 
    $navLinks = array(
    array('text' => 'Book', 'url' => '#'),
    array('text' => 'Dashboard', 'url' => '#')
);  -->