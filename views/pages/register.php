<form class="ml-3 mt-3" style="width: 18rem;" action="register" method="post">
	<div class="form-group">
	    <label>Email</label>
	    <input type="text" class="form-control" name="email">
	</div>
	<div class="form-group">
	    <label>Password</label>
	    <input type="text" class="form-control" name="password">
	</div>
	<div class="form-group">
	    <label>Name</label>
	    <input type="text" class="form-control" name="name">
	</div>
	<div class="form-group">
	    <label>Surname</label>
	    <input type="text" class="form-control" name="surname">
	</div>
	<div class="form-group">
	    <label>Gender</label>
	    <select name="gender">
			<option value='male'>Male</option>
			<option value='female'>Female</option>
		</select>
	</div>
	<div class="form-group">
	    <label>Country</label>
	    <select name="country">
			<option value='KZ'>KZ</option>
			<option value='US'>US</option>
		</select>
	</div>
	<div class="form-group">
	    <label>City</label>
	    <select name="city">
			<option value='Almaty'>Almaty</option>
			<option value='New-York'>New-York</option>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Register</button>
	<a href="index.php?page=login">Log in</a>
</form>