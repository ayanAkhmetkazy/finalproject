<?php
	$user = $_REQUEST['USER_PROFILE'];
?>
<form class="ml-3 mt-3" style="width: 18rem;" action="update" method="post">
	<div class="form-group">
	    <label>Name</label>
	    <input type="text" class="form-control" name="name" placeholder=<?php echo $user->name;?>>
	</div>
	<div class="form-group">
	    <label>Surname</label>
	    <input type="text" class="form-control" name="surname" placeholder=<?php echo $user->surname;?>>
	</div>
	<div class="form-group">
	    <label>Gender</label>
	    <select name="gender">
			<option value='male' <?php if($user->gender == "male") { echo "selected"; } ?>>Male</option>
			<option value='female'<?php if($user->gender == "female") { echo "selected"; } ?>>Female</option>
		</select>
	</div>
	<div class="form-group">
	    <label>Country</label>
	    <select name="country">
			<option value='KZ' <?php if($user->country == "KZ") { echo "selected"; } ?>>KZ</option>
			<option value='US' <?php if($user->country == "US") { echo "selected"; } ?>>US</option>
		</select>
	</div>
	<div class="form-group">
	    <label>City</label>
	    <select name="city">
			<option value='Almaty' <?php if($user->city == "Almaty") { echo "selected"; } ?>>Almaty</option>
			<option value='New-York' <?php if($user->city == "New-York") { echo "selected"; } ?>>New-York</option>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Update</button>
</form>