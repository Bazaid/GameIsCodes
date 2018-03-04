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
                      <li class="active"><a href="<?php echo base_url();?>dashboard/">Profile</a></li>
					  <li><a href="<?php echo base_url();?>dashboard/Challanges/">Challanges</a></li>
					  <li><a href="<?php echo base_url();?>dashboard/achievements/">Achievements</a></li>
					  <li><a href="<?php echo base_url();?>dashboard/team/">Team</a></li>
					  
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
		
		 <!-- Profile Start -->
		   <div class="col-lg-9">
		   
		   <?php if($ProfileStatus != "danger") { ?>
		   
            <div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Profile</h3>
				</div>
				<div class="panel-body">
				
				<div class="col-lg-2">
				<!-- Profile Picture And info start  -->
				<img src="<?php echo base_url();?>bootstrap/images/profiles/<?php echo $pic_2; ?>"/>
				</div>
				
				<div class="col-lg-10">
					<p>
						
						</br>
						
						<b>
						  <font color="#0066a6"> &nbsp&nbsp&nbsp&nbsp <?php echo htmlentities($PlayerName_2,ENT_QUOTES,'UTF-8'); ?> </font>
						</b>
						
						</br>
						&nbsp&nbsp&nbsp&nbsp Level : <font color="#0066a6"><?php echo $Level_2; ?></font>
						</br>
						&nbsp&nbsp&nbsp&nbsp Challanges : <font color="#0066a6"><?php echo $ChallangesWin_2; ?> / <?php echo $ChallangesLose_2; ?></font>
						</br>
						&nbsp&nbsp&nbsp&nbsp Achievements : <font color="#0066a6"><?php echo $Achv_2; ?></font>
						</br>
						<?php 
							if ($Team_2 == "No Team") { 
						?>
							&nbsp&nbsp&nbsp&nbsp Team : <font color="#bcbcbc"><?php echo htmlentities($Team_2,ENT_QUOTES,'UTF-8'); ?></font>
							
						<?php } else { ?>
							&nbsp&nbsp&nbsp&nbsp Team : <a href="<?php echo base_url();?>dashboard/teamprofile/<?php echo htmlentities($Team_2,ENT_QUOTES,'UTF-8'); ?>"><font color="#0066a6"><?php echo htmlentities($Team_2,ENT_QUOTES,'UTF-8'); ?></font></a>
						<?php }?>
						</br>
						
					</p>
				</div>
				
				<!-- Profile Picture And info end  -->
				
				</br></br>
				</br></br>
				</br></br>
				</br></br>
				
				
				<!-- Achievements Start -->
				<div class="page-header">
				<h4>Achievements ( <?php if($Achv_2 == "0") { ?> <font color="#bcbcbc">No Achievements</font> <?php } else { ?> <font color="#0066a6"><?php echo $Achv_2; ?></font> <?php } ?>)</h4>
				</div>
				
				<!--- loading achvs --->
				<?php foreach($achvs_2 as $val) 
				{  
					if($val['achvlevel'] == "Good") 
					{
				?>
					<div class="col-lg-1">
						<span class="label label-default"> &nbsp <?php echo $val['achvlevel']; ?> &nbsp </span> <img data-toggle="tooltip" data-placement="bottom" title="<?php echo $val['achv']; ?>" src="<?php echo base_url();?>bootstrap/images/achv/<?php echo $val['achvpic']; ?>"/>
					</div>
					
				<?php 
				    }
					else {
				?>
				
				    <div class="col-lg-1">
						<span class="label label-primary"><?php echo $val['achvlevel']; ?></span> <img data-toggle="tooltip" data-placement="bottom" title="<?php echo $val['achv']; ?>" src="<?php echo base_url();?>bootstrap/images/achv/<?php echo $val['achvpic']; ?>"/>
					</div>
				
				<?php
					}
				} ?>
				
				
				<!-- Achievements End -->
				
				</br></br></br>
				
				<!-- Info Start -->
				
				<div id="info" class="page-header">
				<h4>Information</h4>
				</div>
				
					<?php echo htmlentities($Info_2,ENT_QUOTES,'UTF-8'); ?>


				</div>
				
				<!-- Info End -->
				
			</div>
			
			<?php } else { ?>
			
			<div class="alert alert-dismissable alert-<?php echo $ProfileStatus; ?>">
              <button type="button" class="close" data-dismiss="alert"></button>
              <?php echo $ProfileInfo; ?>
            </div>
				
			<?php } ?>
			
           </div>
		  <!-- Profile End -->
		  
		</div>
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