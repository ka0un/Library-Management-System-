currently not using thissssssssssssss
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