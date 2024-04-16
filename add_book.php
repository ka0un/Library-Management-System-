<html>
<head>
	<link rel="stylesheet" href="add_book.css">
</head>
<body>
	<div class="add_book_1st_div">
		<h1>Add Book</h1>
		<form action="" method="post">
			<input type="text" id="textbox" class="" placeholder="Enter Name"><br><br>
			<input type="text" id="textbox" class="" placeholder="Enter Auther"><br><br>
			<select id="textbox">
				<option>Horror</option>
				<option>Cooking</option>
				<option>Satire</option>
				<option>Autobiography</option>
				<option>Romance</option>
				<option>Biography</option>
				<option>Fairy tale</option>
				<option>Thriller</option>
				<option>Mystery</option>
				<option>Fantasy</option>
				<option>Comics</option>
			</select>
			<br><br>
			<textarea cols=23 rows=5 id="textarea_addbook">Discription</textarea><br>
			<input type="text" id="textbox" class="no_of_copies" placeholder="Number Of Copies"><br><br>
			<button class="upload_image_button" id="addbook_buttons"><img width="20" height="17" src="https://img.icons8.com/windows/32/1A1A1A/upload.png" alt="upload"/> Upload image</button><br><br>
			<input type="submit" id="addbook_buttons" class="add_book_submit" value="Submit" name="submit">
		</form>
	</div>
</body>
</html>