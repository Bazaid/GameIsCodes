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
              <a href="<?php echo base_url(); ?>dashboard/">Dashboard</a>
            </li>
			
			<li>
              <a href="#">About</a>
            </li>
            
		     <li>
              <a href="<?php echo base_url(); ?>dashboard/logout/">Logout</a>
            </li>
		
          </ul>

          <ul class="nav navbar-nav navbar-right">
          <!--  <li><a href="#" target="_blank">GIC</a></li> -->
		  
		  <!-- notfications -->
            <li>
				 <li>
				 
				      <li class="dropdown">
					  
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Notifications <span class="badge"><?php echo $notifications_n; ?></span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
						
						<?php foreach($notifications as $notifi)
						{
						?>
						
                          <li><a href="#">
							<?php echo htmlentities($notifi['subject'],ENT_QUOTES,'UTF-8'); ?>
						  </a></li>

						  <?php } ?>
						  
						  <li><a href="#">
							<a href="<?php echo base_url();?>dashboard/clearnotifications/"><font color="#0066a6">Clear Notifications</font></a>
						  </a></li>
						  
                        </ul>
                      </li>
				 
				 </li>
			</li>
		  <!-- notfications -->
		  
          </ul>

        </div>
      </div>
    </div> 

	<img src="<?php echo base_url();?>bootstrap/images/Logo.png"/>

    <div class="container">

	
      <div class="page-header" id="banner">
        <div class="row">
		  
		  
		  <!-- News Start -->
		   <div class="col-lg-3">
            <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Latest Updates</h3>
				</div>
				<div class="panel-body">
				
				<?php foreach ($Updates as $Update) { ?> 
					<p><b><font color="#0066a6"><?php echo htmlentities($Update['title'],ENT_QUOTES,'UTF-8'); ?></font></b><br><?php echo $Update['subject']; ?></p>
					</br>
				<?php } ?>
				
				</br></br></br>
				
				</div>
			</div>
           </div>
		  <!-- News End -->
		  
		  
		  <!-- Info bar Start -->
		   <div class="col-lg-9">        
            <div class="panel panel-default">
			
			<div class="navbar navbar-default">
                <div class="container">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo htmlentities($PlayerName,ENT_QUOTES,'UTF-8'); ?></a>
                  </div>
                  <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">
                      <li><a href="<?php echo base_url();?>dashboard/">Profile</a></li>
					  <li><a href="<?php echo base_url();?>dashboard/Challanges/">Challanges</a></li>
					  <li><a href="<?php echo base_url();?>dashboard/achievements/">Achievements</a></li>
					  <li class="active"><a href="<?php echo base_url();?>dashboard/team/">Team</a></li>
					  
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
					
					<li><a href="<?php echo base_url();?>dashboard/leaderboard/">Leaderboards</a></li>
					
      
					  
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
              </div><!-- /.navbar -->
			  
              <div class="panel-body">
				<div class="col-lg-8">     
					<p>
						Level : <font color="#0066a6"><?php echo $Level; ?></font>
					</p>
					
					
					<p><font color="#0066a6"><?php echo $CurrXP; ?></font> / <?php echo $NextXP; ?></p>
					<div id="pr" class="progress">
						<div class="progress-bar" style="width: <?php echo ($CurrXP / $NextXP) * 100; ?>%;"></div>
					</div>
				</div>
			
              </div>
            </div>
		</div>
		<!-- Info bar end -->
		
		
		<?php if($Team != "No Team")
		{
		?>
		
		 <!-- If There's Team Start -->
		   <div class="col-lg-9">
		   
            <div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $team_info['name'] ?></h3>
				</div>
			 <div class="panel-body">
				
				<div class="col-lg-14">
			
					<div class="panel panel-default">
					
			<div class="navbar navbar-default">
                <div class="container">
				  
                  <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#">Members</a></li>
                    </ul>
                    
					<ul class="nav navbar-nav navbar-right">
					
					<?php if($PlayerName == $team_info['leader']) { ?>
                   
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Leader <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url();?>dashboard/teammanage/">Manage Team</a></li>
                        </ul>
                      </li>
					  
					<?php } else { ?>
						<li><a href="<?php echo base_url();?>dashboard/Leaveteam/">Leave team</a></li>
					<?php } ?>
					
					</ul>
					
                  </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
              </div><!-- /.navbar -->
					
						<div class="panel-body">
								<div class="col-lg-7">
									<p>Team XP : <font color="#0066a6"><?php echo $team_info['TeamXP']; ?></font></p>
									<p>Team Leader : <a href="<?php echo base_url();?>dashboard/profile/<?php echo $team_info['leader']; ?>"><font color="#0066a6"><?php echo $team_info['leader']; ?></font></a></p>
									<p>Team Challanges : <font color="#0066a6"><?php echo $team_info['ChallangesWin']; ?>/<?php echo $team_info['ChallangesLose']; ?></font></p>
									<p>Team Members : <font color="#0066a6"><?php echo $team_info['members']; ?></font></p>
								</div>
							</div>
						</div>
					</div>
					
			<div id="info" class="page-header">
				<h4>Description</h4>
			</div>
			
			<p>
				<?php echo $team_info['Info']; ?>
			</p>
			
			<div id="info" class="page-header">
				<h4>Members</h4>
			</div>
				
			<!-- members -->
		    <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Challanges</th>
                    <th>XP</th>
                  </tr>
                </thead>
                <tbody>
				
				<?php foreach($team_mems as $team_mem)
				{
				?>
				
                  <tr>
                    <td><a href="<?php echo base_url();?>dashboard/profile/<?php echo $team_mem['name']; ?>"><font color="#0066a6"><?php echo $team_mem['name']; ?></font></a></td>
                    <td><font color="#0066a6"><?php echo $team_mem['level']; ?></font></td>
                    <td><font color="#0066a6"><?php echo $team_mem['ChallangesWin']; ?>/<?php echo $team_mem['ChallangesLose']; ?></font></td>
                    <td><font color="#0066a6"><?php echo $team_mem['CurrXP']; ?></font></td>
                  </tr>
				  
				  <?php } ?>
                 
                </tbody>
              </table>
				
			    </div>
				
             </div>
		  
		  
		    </div>
			
		   </div>
	      <!-- Team End -->
	
	<?php } else { ?>
	
	<!-- Team Create - Join Start -->
		   <div class="col-lg-9">
		   
            <div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Join Team</h3>
				</div>
			 <div class="panel-body">
		
		<?php if(!$NoJoinError) { ?>
		
		   <div class="alert alert-dismissable alert-danger">
              <button type="button" class="close" data-dismiss="alert">�</button>
              <strong>Error</strong> Error occurred , it's maight be the team is not found or you have sent a join request allready .
            </div>	
			
		<?php } ?>
		
			<div class="col-lg-7">
			
			<p> Joining a team , when you write a team name and press join your join request will be send to the team leader .</p>
			
			<?php echo form_open('dashboard/join/');?>
			
			     <div class="input-group">
                    <span class="input-group-addon">Team Name</span>
                    <input class="form-control" type="text" id="teamname" name="teamname">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Join</button>
                    </span>
                  </div>
			
			</form>
		    
			</br>
		    </div>
				
				
			<div class="col-lg-6">	
			
				<!-- invites -->
		    <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Team</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>
				
				<?php foreach($invites as $invite) { ?>
				
                  <tr>
					
                    <td><a href="<?php echo base_url();?>dashboard/teamprofile/<?php echo $invite['team']; ?>"><font color="#0066a6"><?php echo $invite['team']; ?></font></a></td>
					
                    <td>
					
						 <div class="btn-group btn-group-justified">
							<div class="col-lg-2">
							
							<?php if($invite['side'] == "leader") { ?>
								<a href="<?php echo base_url();?>dashboard/Accept/<?php echo $invite['team'] . '/' . $invite['id']; ?>" class="btn btn-success btn-sm">Accept</a>
							<?php } ?>
							
								<a href="<?php echo base_url();?>dashboard/Cancle/<?php echo $invite['id']; ?>" class="btn btn-default btn-sm">Cancle</a>
							</div>
						</div>
						
					</td>
					
					
                  </tr>
				  
				  <?php } ?>
                 
                </tbody>
              </table>
			  <!-- invites end -->
			  
			  </div>
				
		 </div>
				
             </div>
		 
		    </div>
			
			
			<!----------------------------------------->
					   <div class="col-lg-9 col-lg-offset-3">
		   
            <div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Create Team</h3>
				</div>
			 <div class="panel-body">
					
			<?php if($CreateStatus != "nothing") { ?>
		   <div class="alert alert-dismissable alert-<?php echo $CreateStatus; ?>">
              <button type="button" class="close" data-dismiss="alert">�</button>
              <?php echo $CreateInfo; ?>
            </div>
			<?php } ?>
		
			<div class="col-lg-7">
			
			<?php if($Level >= 10) { ?>
			
			
				<?php echo form_open('dashboard/createteam/');?>
				
				  <div class="input-group">
                    <span class="input-group-addon">Team Name</span>
                    <input class="form-control" id="teamname" name="teamname" type="text">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Create</button>
                    </span>
                  </div>
				  
				  </form>
				  
			
			<?php } else { ?>
			
			<p> You must be level 10 to create a team . </p>
			
			     <div class="input-group">
                    <span class="input-group-addon">Team Name</span>
                    <input class="form-control" disabled="disabled" type="text">
                    <span class="input-group-btn">
                      <button class="btn btn-default disabled" type="button">Create</button>
                    </span>
                  </div>
				  
			
			<?php } ?>
		    
		    </div>
				
			    </div>
				
             </div>
		</div>
		</div>
			<!---------------------------------------->

	<!-- Team Create - Join End -->
	
	<?php } ?>

	</div>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            
            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
            </ul>
			
            <p>Coded Desgined by <a href="#">Bazaid - unCoder</a>. Contact us at <a href="mailto:dpcoders@gmail.com">dpcoders@gmail.com</a>.</p>
            <p>Code licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>.</p>
            <p>Based on <a href="http://getbootstrap.com/">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts">Google</a>. Favicon by <a href="https://twitter.com/geraldhiller">Gerald Hiller</a>.</p>
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