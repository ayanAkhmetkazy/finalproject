<?php
	if(isset($_REQUEST['FOLLOWERS_LIST'])){
	$followersList = $_REQUEST['FOLLOWERS_LIST'];
if($followersList!=null){
	foreach($followersList as $user){ ?>
	    <div class="card mt-3 ml-3" style="width: 18rem;">
  			<div class="card-body">
    			<h5 class="card-title"><a href="guest?id=<?php echo $user->id;?>"><?php echo $user->email; ?></a></h5>
    			<p class="card-text"><b>Name: </b><?php echo $user->u_name; ?></p>
    			<p class="card-text"><b>Surname: </b><?php echo $user->u_surname; ?></p>
  			</div>
		</div>
	<?php }
} 
}?>