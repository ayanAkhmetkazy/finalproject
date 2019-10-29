<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  	<a class="navbar-brand" href="profile.php?page=user">Twitter</a>
  	<ul class="navbar-nav mr-auto">
      	<li class="nav-item">
        	<a class="nav-link" href="index.php?page=login">Log Out</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link <?php if($page == 'user'){echo 'active';} ;?>" href="profile.php?page=user">My Profile</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link <?php if($page == 'search'){echo 'active';} ;?>" href="search">Search</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link <?php if($page == 'followers'){echo 'active';} ;?>" href="followers">Followers</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link <?php if($page == 'follows'){echo 'active';} ;?>" href="follows">Follows</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link <?php if($page == 'tweets'){echo 'active';} ;?>" href="tweets">Tweets</a>
      	</li>
    </ul>
</nav>