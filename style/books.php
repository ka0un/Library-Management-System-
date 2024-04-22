<?php
header("Content-type: text/css");
require_once __DIR__ . '/../config.php';
// if your file is in root use : require_once __DIR__ . '/config.php';
?>

<style>

body{
    background-color:<?php echo SECONDARY_COLOR; ?>;
}

.main{
    display: flex;
    padding-top: 10px;
    font-family: Inter, sans-serif;
}

.category{
    width:18%;
    background-color:<?php echo PRIMARY_COLOR; ?>;
    display :grid;
    grid-template-rows: 9vh 63vh ;
    border:3px;
    border-radius: 20px;
    margin-right: 10px;
    overflow-scrolling: auto;
    margin-left:0px;
    
}

.books{
    width:82%;
    height:79vh;
    border:3px  ;
    border-radius: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    grid-template-rows: 30vh 30vh;
    overflow-x: auto;
    background-color: <?php echo TERTIARY_COLOR; ?>;
    
}

.searchbar{
    grid-row:1;
    margin-top: 10px;
    margin-bottom: 10px;
}



#searchinput {
    width: 93%;
    height : 37px;
    border-radius: 10px;
    margin: 10px;
    padding-left: 14px;
    color: <?php echo PRIMARY_COLOR; ?>;
    font-weight: bold;
    font-size: large;
    border-color: <?php echo PRIMARY_COLOR; ?>;
    background-color: <?php echo SECONDARY_COLOR; ?>;
    
}


.categorylist{
    grid-row:2;
    flex:1;
    display: flex;
    flex-direction: column;
    padding-left: 0px;
    width:100%
}


.cat-item-button{
    background-color: <?php echo TERTIARY_COLOR; ?>;
    color:<?php echo SECONDARY_COLOR; ?>;
    padding: 2px;
    height:40px;
    margin:0px;
    width:100%;
    display: flex;
    font-size:large;
    font-weight: bold;
    align-items: center;
    cursor: pointer;
}

.book-holder{
    display:grid;
    grid-template-rows: 75% 25%;
    justify-content: center;
    border:2px ;
    width:180px;
    height:265px;
    margin:10px;
    border-radius: 20px;
    background-color: <?php echo PRIMARY_COLOR; ?>;
}

.book-holder img{
    border-radius: 20px;
}

.front-image{
    grid-row: 1;
    object-fit: cover;
    width:180px;
    height:265px;
}

.title {
    margin-top: 18px;
    grid-row:2;
    font-weight: bold;
    font-size: medium;
    margin-left: 0px;
    background-color: <?php echo SECONDARY_COLOR; ?>;
    width: 180px;
    border-bottom: 2px;
    border-radius: 0px 0px 20px 20px;
    display: flex;
    align-items: center;
    justify-content:center;

}

.author{
    grid-row: 3;
    margin-left:5px;
    font-size:15px;

}

@media (max-width: 600px) {

    .main {
        flex-direction: column;
    }
  
    .categorylist {
      display: none;
    }

    .category{
        height:60px;
        margin 0;
        padding: 0;
        width: 100%;
        background-color: <?php echo SECONDARY_COLOR; ?>;
    }

    .searchbar{
        width: 100%;
        height:60px;
        display: block;
        margin: 0;
        padding: 0;
    }

    .books {
      width: 100%;
      height: auto;
      overflow: visible;
      margin-top: 10px;
      justify-content: center;
    }

    .book-holder {
      width: 100%;
      height: auto;
      margin: 10px 10px 0px 10px;
    }

    .front-image {
      width: 100%;
      height: auto;
    }

    .title {
      width: 100%;
    }

    #searchinput {
        width: 100%;
        border-radius: 20px;
        font-weight: bold;
        font-size: large;
        padding-left: 10px;
        margin: 0 10px 0 0;
        height: 60px;
    }


}


 
</style>



  

  

  
    


  