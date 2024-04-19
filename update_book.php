<html>
<head>
	<link rel="stylesheet" href="update_book.css">
</head>
<body>
	<div class="container_1">
		<div class="box_1">
			<form action="" method="post">
				<img width="25" height="19" src="https://img.icons8.com/pastel-glyph/64/FFFFFF/search--v2.png">
				<input type="text" id="textbox" placeholder=" Book ID" class="book_id_class">
				<button class="fetch_button" id="buttons">Fetch</button>
			</form>
		</div>
		<div class="box_2">
				<h2>Copies of the Book</h2>
		</div>
		<div class="box_3">
			<form action="" method="post">
				<input type="text" id="textbox" placeholder="Book Name"><br><br>
				<input type="text" id="textbox" placeholder="Auther"><br><br>
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
				<textarea class="update_book_textarea" cols=23 rows=4>Description</textarea>
				<br><br>
				<div class="container_2">
					<div class="box_3_1">
						<img src="update_book_image.jpg" alt="book image" width=120px height=170px>
					</div>	
					<div class="box_3_2">
						<button id="buttons" class="change_image_button">Change image</button>
						<br><br>
						<button class="update_button" id="buttons"><img width="20" height="17" src="https://img.icons8.com/puffy/32/FFFFFF/edit.png" alt="edit"/>&nbsp&nbsp Update</button>
						<br><br>
						<button class="delete_button" id="buttons"><img width="20" height="17" src="https://img.icons8.com/glyph-neue/64/FFFFFF/delete-trash.png" alt="delete-trash"/>&nbsp&nbsp Delete</button>
						<br><br>
					</div>
				</div>
			</form>
		</div>
		<div class="box_4">
			<table border="2" cellpadding="15" cellspacing="0">
				<tr class="table_heading">
					<th>Book ID</th>
					<th>Copy ID</th>
					<th>status</th>
					<th>Rem</th>
				</tr>
				<tr>
					<td>15</td>
					<td>01</td>
					<td>Pending Return</td>
					<td><img width="20" height="17" src="https://img.icons8.com/ios/50/FFFFFF/cancel.png" alt="cancel"/></td>
				</tr>
				<tr>
					<td>15</td>
					<td>02</td>
					<td>Available</td>
					<td><img width="20" height="17" src="https://img.icons8.com/ios/50/FFFFFF/cancel.png" alt="cancel"/></td>
				</tr>
				<tr>
					<td>15</td>
					<td>03</td>
					<td>Available</td>
					<td><img width="20" height="17" src="https://img.icons8.com/ios/50/FFFFFF/cancel.png" alt="cancel"/></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
		</div>
		
	</div>
</body>
</html>