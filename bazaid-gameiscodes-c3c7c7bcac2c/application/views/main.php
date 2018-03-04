<!DOCTYPE html>
<html lang="en"><head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>GameIsCodes - Beta release</title>
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.css" media="screen">
	
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
	
        <div class="navbar-header">
		
          <a href="#" class="navbar-brand"> &lt<font color="#0066a6">&#47</font>&gt GameIsCodes</a>
 
        </div>
		
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
			
            <li>
              <a data-toggle="modal" href="#Login">Login</a> 
            </li>
			
            <li>
              <a data-toggle="modal" href="#register">Register</a>
            </li>
			
			 <li>
              <a href="#">GIC</a>
            </li>
			
			<li>
              <a href="#">About</a>
            </li>
		
		
          </ul>

          <ul class="nav navbar-nav navbar-right">
          <!--  <li><a href="#" target="_blank">GIC</a></li> -->
            <li><a href="#" target="_blank">DPCODERS</a></li>
          </ul>

        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <?php echo form_open('main/login/');?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Member Login</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                <?php echo form_error('username'); ?>
                  <label class="control-label" for="inputSmall">UserName:</label>
                  <input class="form-control input-sm" id="username" name="username"  value="<?php echo set_value('username'); ?>" type="text">
                </div>
                  <div class="form-group">
                  <?php echo form_error('password'); ?>
                  <label class="control-label" for="inputSmall">Password :</label>
                  <input class="form-control input-sm" id="password" name="password"   value="<?php echo set_value('password'); ?>" type="password">
                </div>
        </div>
        <div class="modal-footer">
<button type="submit" class="btn btn-success">Sign In</button>
        </div>
      </div><!-- /.modal-content -->
 </form>	
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
     <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	<?php echo form_open('main/register/');?>
       <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Register</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                <?php echo form_error('username'); ?>
                  <label class="control-label" for="inputSmall">UserName:</label>
                  <input class="form-control input-sm" id="username" name="username"  value="<?php echo set_value('username'); ?>" type="text">
                </div>
                  <div class="form-group">
                  <?php echo form_error('password'); ?>
                  <label class="control-label" for="inputSmall">Password :</label>
                  <input class="form-control input-sm" id="password" name="password"   value="<?php echo set_value('password'); ?>" type="password">
                </div>
				  <div class="form-group">
                  <?php echo form_error('email'); ?>
                  <label class="control-label" for="inputSmall">Email :</label>
                  <input class="form-control input-sm" id="email" name="email"   value="<?php echo set_value('email'); ?>" type="email">
                </div>
        </div>
        <div class="modal-footer">
<button type="submit" class="btn btn-primary">Register</button>
        </div>
      </div><!-- /.modal-content -->
	  </form>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->



	<img src="<?php echo base_url();?>bootstrap/images/Logo.png"/>

    <div class="container">

	
      <div class="page-header" id="banner">
	  
        <div class="row">
		
			  </br>
		      <div class="jumbotron1">
         <?php if(!empty($error)) { ?>
         <div class="alert alert-danger"><?php echo $error ?></div>
        <?php }?>
                <h1>GIC</h1>
                <p>GIC is a simple game for coders "hackers" , it do have a lot of amazing things you can do a lot of challanges by yourself or with a team.
				also from the beginner level to the professional . getting new levels and xp . and a lot of amazing things</p>
			  </br>
			  
              </div>
		  
		</div>

      </div>
	  
	
	
	  
      <footer>
        <div class="row">
          <div class="col-lg-12">
            
            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
            </ul>
			
            <p>Coded , Desgined by <a href="#">Bazaid - unCoder</a>. Contact us at <a href="mailto:dpcoders@gmail.com">dpcoders@gmail.com</a>.</p>
            <p>Code licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>.</p>
            <p>Based on <a href="http://getbootstrap.com/">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts">Google</a></p>
			</br>
			</br>
			
          </div>
        </div>
        
      </footer>
    
	
	</div>
	
    <script src="<?php echo base_url();?>bootstrap/js/jquery.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootswatch.js"></script>

  
</body></html>