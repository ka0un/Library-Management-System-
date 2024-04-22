<?php
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/sql/books.php';
require_once __DIR__ . '/sql/copies.php';
?>

<!DOCTYPE html>
<html lng="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
        <title>Book</title>
        <link rel ="stylesheet" href="style/books.php">
    </head>
    <body bgcolor=<?php echo SECONDARY_COLOR;?>>
    <?php
    generate_header(array());
    ?>
        <div class ="main">
            <div class ="category">
                <div class="searchbar">
                    <div class ="searchbar-container"><input type ="text" id="searchinput" placeholder="Search" ></div>
                </div>
            
                <div class ="categorylist">
                    <form id="categoryForm">
                        <!-- Buttons styled as category items -->
                        <button type="submit" class="cat-item-button" value="Novels">Novels</button>
                        <button type="submit" class="cat-item-button" value="Kernels">Kernels</button>
                        <button type="submit" class="cat-item-button" value="Storylines">Storylines</button>
                        <button type="submit" class="cat-item-button" value="Programming">Programming</button>
                        <button type="submit" class="cat-item-button" value="History">History</button>
                    </form>
                </div>
            </div>
                    
            <div class ="books">
        
                
                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad<br>long name checking</div>
            
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                        
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
            
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                        
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                        
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                        
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                        
                        
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    </div>

                    
                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad Good Days With us</div>
                    </div>

                   
                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad </div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    </div>

                    <div class ="book-holder">
                        <img  class="front-image" src="images/bookpage1.jpeg" width="100px" height ="100px">
                        <div class="title">Rich Dad Poor Dad</div>
                    </div>

                    
                
                
                
            </div>
        </div>

    </body>

</html>
