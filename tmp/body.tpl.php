<?php include_once 'tmp/header.tpl.php'; ?>
<?php if(isset($_SESSION['user']['login']) && !empty($_SESSION['user']['login'])):?>

<header>
    <div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="#">Online Chat</a>
    <ul class="nav">
      <li><a href="#myModal" role="button" data-toggle="modal">Item</a></li>
      <li class="dropdown" id="drop-list">
      	<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">My rooms
			<b class="caret"></b>
      	</a>
      	<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
      		<li role="presentation"><a href="#" role="menuitem" tabindex="-1">Friends</a></li>
      		<li role="presentation"><a href="#" role="menuitem" tabindex="-1">Family</a></li>
      		<li role="presentation"><a href="#" role="menuitem" tabindex="-1">Work</a></li>
      		<li role="presentation"><a href="#" role="menuitem" tabindex="-1">Something else</a></li>
      	</ul>
      </li>
    </ul>
    <p class="navbar-text navbar-right" id="mark">Signed in as <?= $_SESSION['user']['login']; ?>&nbsp;&nbsp;<a href="?logout=true" class="navbar-link"> <i class="fa fa-sign-out"></i></a></p>

  </div>
</div>
</header>


 




<!-- BODY MESSAGES -->
<div class="container">
<div class="row">
  <div class="span4 fixed col">
	  
	  	<div class="sidebar">
	  		<form>
			  <fieldset>
			    <legend align="center">Create a room</legend>
			    <div class="wrapper-field">
			    <label for="room-name">Name</label>
			    <input type="text" class="room-name fix-form" placeholder="Type here...">
			    <span class="help-block">Type name for your channel</span>

			    Is it private?
			    <button type="button" class="btn btn-primary btn-small" data-toggle="button" id="private">Yes</button>
			    <br>
			    <br>
			    
			    <select class="hide" multiple='multiplie'>
				  <option>Vadik</option>
				  <option>Worik</option>
				  <option>Artem</option>
				  <option>Sasha</option>
				  <option>Sen'a</option>
				</select>
				
			    <button type="submit" class="btn">Create</button>
			    </div>
			  </fieldset>
			</form>
	  	</div>
  	
  </div>

  <div class="span8">
  	<div class="result-messages col" id="wrapper-mess">
  	<!--user message -->

  		
</div>


  		<!-- TEXTAREA TO SEND MESSAGES-->
			
		<textarea class="text-area" cols="3" rows="2"></textarea>
		<button class="btn btn-info" id="button-send">Send</button>
		<div class="alert alert-success">Message's been successfully sent</div>
		<div class="alert alert-danger">Something's wrong</div>


  		<!-- END OF TEXTAREA -->

  	
  </div>


          <!-- SIDEBAR-->
	<div class="span3">
		<div class="sidebar-right-wrapper col">
		<h4 align="center">Chat Rooms</h4>
			<div class="wrapper-field">
				<ul class="nav nav-tabs nav-stacked">
	  				<li><a href="#">Someroom</a></li>
	  				<li><a href="#">Someroom</a></li>
	  				<li><a href="#">Someroom</a></li>
				</ul>
			</div>	
		</div>
	</div>
        <!-- SIDEBAR-->
  
</div>
</div>
<!-- BODY MESSAGES -->


	<?php else:?>
	<?php include_once 'tmp/home.tpl.php'; ?>
	<?php endif;?>

	<?php include_once 'tmp/footer.tpl.php'; ?>
