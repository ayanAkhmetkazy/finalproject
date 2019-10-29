<?php
    $tweet=$_REQUEST['EDIT_TWEET'];                             
?>
<div class="container">
	<div class="row">
		<div class="col-4">
			<form class="ml-3 mt-3" style="width: 18rem;" action="tweetupdate" method="post">
	  			<div class="form-group">
	    			<label><h5>Change your Tweet</h5></label>
	    			<textarea class="form-control" name="tweet" style="height: 18rem;"><?php echo $tweet->tweet; ?></textarea>
	  			</div>
	  			<input type="hidden" name="tweet_id" value=<?php echo $_GET['id']; ?>>
	  			<button type="submit" class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
</div>