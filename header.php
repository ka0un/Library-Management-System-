<?php
    
    function genarateheader($pathLinks)
    {
        
        
        $html = '
                <style>
                   


.part1 {
    height : 100px;
    border:3px solid black;
    border-radius:20px;
    grid-row:1;
    display: grid;
    grid-template-columns: 5vw 35vw 18vw 40vw;
    background-color:black;
    
    
    
    
}

.part2 {
    height: 30px;
    background-color: none;
    padding-left: 3px;
   
}
.part2 a{
   color:black;
}





.imgbook {
    grid-column: 1;
}

.brand {
    padding-left: 10px;
    grid-column: 2;
    
    font-size: 30px;
    font-weight: bold;
    height: 50px;
    margin-top: 25px;
    margin-left: 20px;

    
    
}

.nav {
    grid-column: 3;
    
    display: grid;
    grid-template-rows: 15vw 15vw 15vw;

    height: 50px;
    margin-top: 25px;
    color: white;
    
}
.nav a,.brand,.hellow,.log a  {
color:white;
}



.rightcon {
    grid-column: 4;
    
    height: 50px;
    margin-top: 13px;
    margin-left: 280px;
    margin-right: 10px;
    display: grid;
    grid-template-columns: 16vw 18vw;
    text-align: right;
    
    
    

}

.imgbook img {
    width: 80px;
    height: 60px;
    margin-left: 10px;
    margin-top: 5px;
}



 
 
.text{
    grid-column: 1;
    display: grid;
    grid-template-rows:4vh 6vh;

}
.hellow{
    grid-row: 1;
    margin-top: 15px;
    margin-right: 3px;

}
.log{
    grid-row:2;
    margin-right: 3px;
    margin-top: 3px;
}
.userimg{
    grid-column: 2;
    height:60px ;
    width: 60px;
    margin-left: 7px;
    border-radius: 50%; 
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.userimg img{
    width: 60px;
    margin-left: 10px;
    margin-top: 5px;
    height: auto;
    display: block;
    margin: auto;
   
    
}

.navhome{
    grid-column: 1;

    
    

}

.navdashboard{
    grid-column: 3;
}

.navbook{
    grid-column: 2;
}



.brand{
background-color:black;
}
                </style>
                    
                        
        <div class ="part1">
            <div class="imgbook">
                <img src ="images/booknew2.jpg">
            </div>
            <div class="brand">
                SLIIT Main Library
            </div>
            <div class="nav">
                <div class ="navhome"><a href ="#">HOME</a></div>
                <div class ="navbook"><a href ="#">BOOK</a></div>
                <div class ="navdashboard"><a href="#">DASHBOARD</a></div>
            </div>
            <div class="rightcon">
                <div class="text">
                    <div class ="hellow"> Hello User!</div>
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
        $html .= '<a href = "'.$path['url']. '" >'.$path['text'].'</a>';
    } 

    $html .= '</div></div>';

        return $html;
    }

?>



<!--example arry------ 
    $navLinks = array(
    array('text' => 'Book', 'url' => '#'),
    array('text' => 'Dashboard', 'url' => '#')
);  -->