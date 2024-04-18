<?php
header("Content-type: text/css");
require_once __DIR__ . '/../config.php';
// if your file is in root use : require_once __DIR__ . '/config.php';
?>

<style>

body {
    margin: 0;
    padding: 0;
    font-family:Inter, sans-serif;
    background-color: <?php echo PRIMARY_COLOR; ?>;
}

.book-container {
    border-radius: 20px;
    display: flex;
    flex-direction: row;
    margin: 5px auto;
    font-family:Inter, sans-serif;
    background-color: <?php echo TERTIARY_COLOR; ?>;
    color: <?php echo SECONDARY_COLOR; ?>;
    font-size: 25px;
}

.book-image img {
    width: 100%;
    height: 100%;
    object-fit: fill;
}
.book-image{
    width: 20%;
    object-fit: fill;
}

.book-actions {
    display: flex;
    flex-direction: row;
    padding: 20px;
    margin: 20px;
    border-style: solid;
    border-width: 5px;
    border-color: <?php echo SECONDARY_COLOR; ?>;
    background: <?php echo PRIMARY_COLOR; ?>;
    border-radius: 20px;
    justify-content: space-around;
    align-self: flex-end;
}


.book-button {
    display: flex;
    justify-content: flex-end;
}

#button{
    width:260px;
    height:55px;
    font-weight:bold;
    background-color:<?php echo PRIMARY_COLOR; ?>;
    color:<?php echo SECONDARY_COLOR; ?>;
    border-radius: 60px;
    border-color: <?php echo SECONDARY_COLOR; ?>;
    border-style: solid;
    border-width: 3px;
    font-size: 20px;
}

#button:hover{
    cursor: pointer;
}


.book-info {
    width: 80%;
    padding: 20px;
}

.book-category,
.book-author,
.description {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: 20px;
}

.book-category span:first-child,
.book-author span:first-child,
.description span:first-child {
    font-weight: bold;

}

.book-title h1 {
    font-size: 40px;
    margin-bottom: 15px;
}

.book-description {
    margin-bottom: 20px;
    line-height: 1.6; 
}


@media (max-width: 768px) {

    .book-info {
        padding: 0;
        width: 100%;
        margin: 0;
    }

    .book-container {
        flex-direction: column;
        font-size: 20px;
    }


    .book-container {
        flex-direction: column;
    }

    .book-image, .book-info {
        width: 100%;
    }

    .book-actions {
        flex-direction: column;
        justify-content: space-between;
        margin: 0;
        border-radius: 0px;
        border-color: <?php echo PRIMARY_COLOR; ?>;
    }

    .book-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }

    .description {
        font-size: 15px;
        display: flex;
        justify-content: center;
    }

    #button{
        align-self: center;
    }


    .book-button {
        display: flex;
        justify-content: center;
    }
}
</style>