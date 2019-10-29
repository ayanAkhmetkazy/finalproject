<?php
   $user = $_REQUEST['USER_PROFILE'];
   if($user!=null){ ?>
		<div class="card mt-3 ml-3" style="width: 18rem;">
		  	<div class="card-body">
		    	<h5 class="card-title">User's Profile</h5>
		    	<p class="card-text"><b>Name: </b><?php echo $user->name; ?></p>
		    	<p class="card-text"><b>Surname: </b><?php echo $user->surname; ?></p>
		    	<p class="card-text"><b>Gender: </b><?php echo $user->gender; ?></p>			
		    	<p class="card-text"><b>Country: </b><?php echo $user->country; ?></p>
		    	<p class="card-text"><b>City: </b><?php echo $user->city; ?></p>
		   	 	<a href="edit" class="card-link">Update</a>
		    	<a href="delete" class="card-link">Delete</a>
		  	</div>
		</div>
<?php } ?> 