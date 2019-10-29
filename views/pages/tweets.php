<?php
	$tweetList=$_REQUEST['TWEET_LIST'];
?>
<div class="container">
	<div class="row">
		<div class="col-4">
			<form class="ml-3 mt-3" style="width: 18rem;" action="tweetcreate" method="post">
	  			<div class="form-group">
	    			<label><h5>Tweet about something</h5></label>
	    			<textarea class="form-control" name="tweet" style="height: 18rem;"></textarea>
	  			</div>
	  			<button type="submit" class="btn btn-primary">Tweet</button>
			</form>
		</div>
		<div class="col-8">
		<?php if($tweetList!=null){
	        foreach($tweetList as $tweet){
	        	if($tweet->active==1){ ?>
	        		<div class="card mt-3 ml-3" style="width: 36rem;">
  						<div class="card-body">
    						<h5 class="card-text"><?php echo $tweet->tweet; ?></h5>
    						<p class="card-text"><b>Posted: </b><?php echo $tweet->post_date; ?></p>
    						<p class="card-text"><b>Likes: </b><?php echo $tweet->like_count; ?></p>
    						<form action="deletetweet" method="post">
    							<input type="hidden" name="tweet_id" value="<?php echo $tweet->id; ?>">
    							<a href="edittweet?id=<?php echo $tweet->id;?>" class="btn btn-link">Update</a>
    							<button type="submit" class="btn btn-link">Delete</button>
    						</form>
  						</div>
					</div>
	        	<?php }
	        }
	    }?>
		</div>
	</div>
</div>