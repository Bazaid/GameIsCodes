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
					  <li class="active"><a href="<?php echo base_url();?>dashboard/Challanges/">Challanges</a></li>
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
		
		 <!-- Challanges Start -->
		  
		 <div class="col-lg-9"> 
		  <div class="panel panel-primary">
              <div class="panel-heading">Challanges</div>
              <div class="panel-body">
                
				<?php if($IsChid == "NO") { ?>
				<ul class="nav nav-tabs" style="margin-bottom: 15px;">
                <li class="active"><a href="#MainChallanges" data-toggle="tab">Main Challanges</a></li>
                <li class="disabled"><a>Levels Challanges</a></li>
				<li class="disabled"><a>Teams Challanges</a></li>
              </ul>
			  
			  
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="MainChallanges">
				
				<div class="row">
				
				<?php foreach($MainChallangesArray as $MainChallange) { ?>
				
					<div class="col-lg-4">
						<div class="well">
							<center>
							
								<img data-toggle="tooltip" data-placement="bottom" title="<?php echo $MainChallange['info']; ?>" src="<?php echo base_url();?>bootstrap/images/challanges/<?php echo $MainChallange['pic']; ?>"/></br>
								
								<font color="#0066a6"><?php echo $MainChallange['name']; ?></font></br>
								
								</br>
								
								<span class="label label-default"><?php echo $MainChallange['level']; ?></span></br>
								
								<font size="2" color="#0066a6"><?php echo $MainChallange['limit']; ?></font>
								
								</br></br>
								
								<?php 
								// check if is challange of week
							    if($MainChallange['name'] == "Week Challange")  { if($ChallangeOfWeek == "Close") { ?> 
								<button type="button" class="btn btn-default btn-sm btn-block disabled">Closed</button>
								<?php } else { ?>
								<a href="<?php echo base_url();?>dashboard/Challange/<?php echo $MainChallange['chid'] . '/mainchallanges'; ?>"><button type="button" class="btn btn-primary btn-sm btn-block">Start</button></a>
								<?php } } else { ?>
								<a href="<?php echo base_url();?>dashboard/Challange/<?php echo $MainChallange['chid'] . '/mainchallanges'; ?>"><button type="button" class="btn btn-primary btn-sm btn-block">Start</button></a>
								<?php } ?>
								
							</center>
						</div>
					</div>
					
					<?php } ?>
				
					
				</div> <!-- row end -->
				
			  <ul class="pagination pagination-sm">
                <li class="disabled"><a href="#">«</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li>
              </ul>
				
				</div> <!-- main challanges tab end -->
				
				<div class="tab-pane fade" id="LevelsChallanges">
				
				<div class="row">
				
					<div class="col-lg-4">
						<div class="well">
							<center>
							
								<img data-toggle="tooltip" data-placement="bottom" title="Small Desciprtion of the challange" src="<?php echo base_url();?>bootstrap/images/challanges/<?php echo $MainChallange['pic']; ?>"/></br>
								
								<font color="#0066a6">Challange Name</font></br>
								
								</br>
								
								<span class="label label-default">Normal</span></br>
								
								<font size="2" color="#0066a6">3 Days limit</font>
								
								</br></br>
								
								<button type="button" class="btn btn-primary btn-sm btn-block">Start</button>
								
							</center>
						</div>
					</div>
				</div> <!-- row end -->
				
				</div> <!-- Levels challanges tab end -->
				
				
              </div> <!-- main tab end -->
			  
			  <?php } else { ?>
				 <div class="alert alert-dismissable alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					You can't view other challanges until you win or lose the challange you're in .
				</div>
				</br>
				<center>
				
				<?php foreach($MainChallangesArray as $MainChallange) { if($MainChallange['chid'] == $IsChid) { ?>
				
					<div class="col-lg-4">
						<div class="well">
							<center>
							
								<img data-toggle="tooltip" data-placement="bottom" title="<?php echo $MainChallange['info']; ?>" src="<?php echo base_url();?>bootstrap/images/challanges/<?php echo $MainChallange['pic']; ?>""/></br>
								
								<font color="#0066a6"><?php echo $MainChallange['name']; ?></font></br>
								
								</br>
								
								<span class="label label-default"><?php echo $MainChallange['level']; ?></span></br>
								
								<font size="2" color="#0066a6"><?php echo $MainChallange['limit']; ?></font>
								
								</br></br>
								
								<?php 
								// check if is challange of week
							    if($MainChallange['name'] == "Week Challange")  { if($ChallangeOfWeek == "Close") { ?> 
								<button type="button" class="btn btn-default btn-sm btn-block disabled">Closed</button>
								<?php } else { ?>
								<a href="<?php echo base_url();?>dashboard/Challange/<?php echo $MainChallange['chid'] . '/mainchallanges'; ?>"><button type="button" class="btn btn-primary btn-sm btn-block">Continue</button></a>
								<?php } } else { ?>
								<a href="<?php echo base_url();?>dashboard/Challange/<?php echo $MainChallange['chid'] . '/mainchallanges'; ?>"><button type="button" class="btn btn-primary btn-sm btn-block">Continue</button></a>
								<?php } ?>
								
							</center>
						</div>
					</div>
					
					<?php } } ?>
				
				</center>
			  <?php } ?>
			  
            </div>
		 </div>
		  
		  <!-- Challanges End -->
		  
		</div>
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