<?php
	$guest = $_REQUEST['GUEST_PROFILE'];
	$status = $_REQUEST['FOLLOW_STATUS'];
?>
<div class="card mt-3 ml-3" style="width: 18rem;">
	<div class="card-body">
		<h5 class="card-title"><?php echo $guest->email;?></h5>
		<p class="card-text"><b>Name: </b><?php echo $guest->u_name; ?></p>
		<p class="card-text"><b>Surname: </b><?php echo $guest->u_surname; ?></p>
		<p class="card-text"><b>Gender: </b><?php echo $guest->u_gender; ?></p>			
		<p class="card-text"><b>Country: </b><?php echo $guest->u_country; ?></p>
		<p class="card-text"><b>City: </b><?php echo $guest->u_city; ?></p>
		<div>
			<input type="hidden" id="status" value="<?php echo $_GET['id']; ?>">
			<input id="button" type="button" class="btn btn-link" value="<?php echo $status ;?>">
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
        $("#button").click(function(){
            if($("#button").val()=="follow"){
            	$.post("follow", {
            		"follow" : $("#status").val()
            	});
            	$("#button").val("unfollow");
            }
            else{
            	$.post("unfollow", {
            		"unfollow" : $("#status").val()
            	});
            	$("#button").val("follow");
            } 
        });
    });
</script>