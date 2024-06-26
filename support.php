<?php
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/config.php';
require_once __DIR__. '/sql/message.php';
require_once __DIR__.'/sql/ticket.php';
require_once __DIR__. '/sql/users.php';
require_once __DIR__.'/auth/permission.php';
include(__DIR__.'/auth/session.php');


?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
<style>
	html,body {
    height: 95%;
	margin-top:0%;
	background-color: <?php echo TERTIARY_COLOR; ?>;
  }
#container{
	height: 85%;
	width: 98%;
	margin: 10px;
	border-radius: 20px;
	background-color: <?php echo PRIMARY_COLOR; ?>;
	display: flex;
	align-items: flex-end;
	padding-bottom: 20px;
}
#messages{
	width: 100%;
}
#message{
	width: 80%;
	display: flex;
	flex-direction: row;
}
#message2{
	width: 80%;
	display: flex;
	flex-direction: row-reverse;
	padding-left: 15%;
	text-align: right;
}

#message2 #content{
	background-color: #F5F5DC;
}

#message2 #content #text{
	background-color: #F5F5DC;
	margin-right: 10px;
}

#message2 #content #name{
	background-color: #F5F5DC;
	margin-right: 10px;
}

#profile{
	background-color: transparent;
	height: 40px;
	width: 40px;
	margin-left: 10px;
	margin-right: 15px;
	align-self: flex-start;
	margin-top: 10px;
}
#content{
	background-color: #CCCCC6;
	height: max-content;
	width: 80%;
	margin: 10px;
	border-radius: 10px;
	overflow: hidden;
	font-size: 15px;
}
#inputs{
	width: 100%;
	display:flex;
	justify-content: space-between;
}
#textinput{
	display: flex;
	flex-direction: row;
	min-height: 25px;
	min-width: 3px;
}
#textinput textarea {
  width: 100%;
  resize: none;
}
#button{
	border-radius: 10%;
	height: 42px;
	width: 80px;
	align-self: flex-end;
}
.submit_button
{
	width:68px;
	height: 25px;
	border-radius: 20px;
	border-color: <?php echo SECONDARY_COLOR; ?>;
	background-color: <?php echo PRIMARY_COLOR; ?>;
	color:<?php echo SECONDARY_COLOR; ?>;
}
#content_inputs{
	height: max-content;
	width: calc(100%- 90px);
	margin: 10px;
	border-radius: 10px;
	overflow: hidden;
}

#name{
	margin-left: 10px;
	margin-top: 5px;
}

#text{
	margin-left: 12px;
	margin-top: 2px;
	margin-bottom: 10px;
	font-size: 12px;
	font-weight: lighter;
}

</style>

</head>
<body>
	<?php

		if (is_user_has_ticket($_SESSION['uuid']) && !has_permission($_SESSION['uuid'], "VIEW_TICKET") && !isset($_GET['id'])){
			echo '<script>window.location.href = "/support.php?&id='.get_ticketid_of_user($_SESSION['uuid']).'";</script>';
		}
		
	?>

<Div id="container"> 
		<Div id="messages">
			
			<?php
			
				if(isset($_GET['id'])){
					$ticket_id = $_GET['id'];
					$array_of_msg_ids = get_array_of_msgids($ticket_id);
					foreach($array_of_msg_ids as $id){
						if(has_permission(get_message_user_id($id), "VIEW_TICKET")){
							echo '<Div id="message2">';
						}else{
							echo '<Div id="message">';
						}
						echo '<Div id="profile">';
						echo '<img src ="'.get_user_profile_picture_url(get_message_user_id($id), 60).'">';
						echo '</Div>';
						echo '<div id="content">';
						echo '<div id="name">';
						echo get_user_name(get_message_user_id($id));
						echo '</Div>';
						echo '<div id="text">';
						echo get_message_content($id);
						echo '</Div>';
						echo '</Div>';
						echo '</Div>';
					}
				}
			
			?>

			<br><br>

			<Div id="inputs">
			<div id="content_inputs">
			<form action="" method="post">
				<div id="textinput">
					<textarea rows="2" cols="200" maxlength="300" name="content_textbox" id="content"></textarea>
			 	</div>
			 </div>
			 <div id="button">
				<input type="submit" value='Send' name="submit" class="submit_button">
				</form>
			</div>
		</Div>
	</Div>
	<?php
		if(isset($_POST['content_textbox']))
		{
				
			msg_send($_SESSION['uuid'],$_POST['content_textbox']);

		}
	function msg_send($uuid,$content)
	{
		if(has_permission($uuid,'VIEW_TICKET')&& isset($_GET['id']))
		{
			add_messages($_GET['id'],$uuid,$content);
			return ;
		}

		if(is_user_has_ticket($uuid))
		{
			$ticket_id=get_ticketid_of_user($uuid);
			add_messages($ticket_id,$uuid,$content);
		}
		else{
			add_ticket($uuid);
			$ticket_id=get_ticketid_of_user($uuid);
			add_messages($ticket_id,$uuid,$content);
		}
	}
	?>
	<script src="scriots/support.js"></script>
</body>
</html>