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

		
		 <!-- team profile -->
		   <div class="col-lg-9">
		   
		   <?php if($ProfileStatus != "danger") { ?>
		   
            <div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo htmlentities($team_info['name'],ENT_QUOTES,'UTF-8'); ?></h3>
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
					  
					<?php } else { if($Team == $team_info['name']) { ?>
						<li><a href="<?php echo base_url();?>dashboard/Leaveteam/">Leave team</a></li>
					<?php } } ?>
					
					</ul>
					
                  </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
              </div><!-- /.navbar -->
					
						<div class="panel-body">
								<div class="col-lg-7">
									<p>Team XP : <font color="#0066a6"><?php echo $team_info['TeamXP']; ?></font></p>
									<p>Team Leader : <a href="<?php echo base_url();?>dashboard/profile/<?php echo htmlentities($team_info['leader'],ENT_QUOTES,'UTF-8'); ?>"><font color="#0066a6"><?php echo htmlentities($team_info['leader'],ENT_QUOTES,'UTF-8'); ?></font></a></p>
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
				<?php echo htmlentities($team_info['Info'],ENT_QUOTES,'UTF-8'); ?>
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
                    <td><a href="<?php echo base_url();?>dashboard/profile/<?php echo htmlentities($team_mem['name'],ENT_QUOTES,'UTF-8'); ?>"><font color="#0066a6"><?php echo htmlentities($team_mem['name'],ENT_QUOTES,'UTF-8'); ?></font></a></td>
                    <td><font color="#0066a6"><?php echo $team_mem['level']; ?></font></td>
                    <td><font color="#0066a6"><?php echo $team_mem['ChallangesWin']; ?>/<?php echo $team_mem['ChallangesLose']; ?></font></td>
                    <td><font color="#0066a6"><?php echo $team_mem['CurrXP']; ?></font></td>
                  </tr>
				  
				  <?php } ?>
                 
                </tbody>
              </table>
				
			    </div>
				
             </div>
		  
		  <?php } else { ?>
		  
		  	<div class="alert alert-dismissable alert-<?php echo $ProfileStatus; ?>">
              <button type="button" class="close" data-dismiss="alert"></button>
              <?php echo $ProfileInfo; ?>
            </div>
			
		<?php } ?>
		  
		    </div>
			
		   </div>
	      <!-- Team End -->

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