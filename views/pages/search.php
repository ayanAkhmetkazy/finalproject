<?php
   $searchList = $_REQUEST['SEARCH_LIST'];
?>
<form class="ml-3 mt-3" style="width: 18rem;" action="search" method="get">
	  <div class="form-group">
	    <label>Search for users</label>
	    <input type="text" class="form-control" name="search">
	  </div>
	  <button type="submit" class="btn btn-primary">Show results</button>
</form>
	<?php
   	if($searchList!=null){
	    foreach($searchList as $user){ ?>
	        <div class="card mt-3 ml-3" style="width: 18rem;">
  				<div class="card-body">
    				<h5 class="card-title"><a href="guest?id=<?php echo $user->id;?>"><?php echo $user->email; ?></a></h5>
    				<p class="card-text"><b>Name: </b><?php echo $user->u_name; ?></p>
    				<p class="card-text"><b>Surname: </b><?php echo $user->u_surname; ?></p>
  				</div>
			</div>
	<?php }
	} ?>