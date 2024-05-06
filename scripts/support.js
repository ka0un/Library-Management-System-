<script>
function sendMessage() {
    var content = document.getElementById("content").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "your_php_script.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4) {
            if(xhr.status === 200) {
                // Success message
                alert("Message sent successfully!");
            } else {
                // Error message
                alert("Error sending message. Please try again later.");
            }
        }
    };
    xhr.send("content_textbox=" + encodeURIComponent(content));
}
</script>
