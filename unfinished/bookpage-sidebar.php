<!DOCTYPE html>
<head>
    
</head>
<body>
    <style>
        .category{
            width:18%;
            background-color:#292929  ;
            display :grid;
            grid-template-rows: 9vh 63vh ;
            border:3px solid #292929;
            border-radius: 20px;
        }

        .searchbar{
            grid-row:1;
            border-bottom:2px solid white;
            
            
        }

        .categorylist{
            grid-row:2;
            flex:1;
            overflow-y: auto;
            display: flex; /* Added */
            flex-direction: column; /* Added */
            padding-left: 20px;
            
            
        }
        ul{
            list-style-type: disc;
        }

        a:hover{
            font-size: 1.1em;
        }
        .category-container,.category-container a {
            
            color:white;
        }

        .category-items.visible {
        display: none; 
        }

        .category-items {
        display: block; 

        }

        .book-category-list ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #searchinput {
            width: 93%;
            height : 40px;
            box-sizing: border-box;
            border: 3px ;
            border-radius: 20px;
            margin: 10px;
            padding-left: 14px;
            
            
            
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    function categoryItems(event) {
        var clickedLabel = event.target;
        var categoryItems = clickedLabel.nextElementSibling;

        if (categoryItems) {
            categoryItems.classList.toggle('visible');
            var ul = categoryItems.querySelector('ul'); // Find the ul element inside .category-items
            if (ul) {
                var isVisible = ul.offsetHeight > 0; // Check if ul is visible
                if (!isVisible) {
                    clickedLabel.style.marginTop = "20px"; // Increase margin-top if ul is not visible
                } else {
                    clickedLabel.style.marginTop = "0"; // Reset margin-top if ul is visible
                }
            }
        }
    }

    var labels = document.querySelectorAll('.category-container label');

    labels.forEach(function(label) {
        label.addEventListener('click', categoryItems);
        label.addEventListener('mouseover', function(event) {
            event.target.style.fontSize = '1.1em'; // Increase font size on mouseover
        });
        label.addEventListener('mouseleave', function(event) {
            event.target.style.fontSize = ''; // Reset font size on mouseleave
        });
    });
});
    </script>

    <div class ="category">
        <div class="searchbar">
            <div class ="searchbar-container"><input type ="text" id="searchinput" placeholder="search books here" ></div>
        </div>
    
        <div class ="categorylist">
            <hr>
            <div class="category-container">
                
                <label>Programming </label>
                <div class="category-items">
                    <ul class="preview">
                        <li><a href ="#">Python</a></li>
                        <li><a href ="#">Java</a></li>
                        <li><a href ="#">Java script</a></li>
                        <li><a href ="#">C++</a></li>
    
                    </ul>
                </div>
            </div>
    <!-- test data..................................................................................... -->
            <div class="category-container">
                <label>Engineering </label>
                <div class="category-items">
                    <ul>
                        <li>Machanics</li>
                        <li>Calcus</li>
                        <li>Rubber</li>
                        <li>Construction</li>
    
                    </ul>
                </div>
            </div>
    
            <div class="category-container">
                <label>Nursing</label>
                <div class="category-items">
                    <ul>
                        <li>Heart</li>
                        <li>Brain</li>
                        <li>Birth-Dead</li>
                        <li>Resposibilities</li>
    
                    </ul>
                </div>
            </div>
    
    
            <div class="category-container">
                <label>DataScience </label>
                <div class="category-items">
                <ul>
                    <li>Machine learning</li>
                    <li>Neural Netwoking</li>
                    <li>Statistics</li>
                    <li>Probability</li>
    
                </ul>
                </div>
            </div>
    
    
        </div>
          
    </div>
    

</body>
