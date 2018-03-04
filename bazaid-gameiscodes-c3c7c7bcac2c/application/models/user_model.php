<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

   	public function get_info($username)
	{
		
       $query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
       return $result;
	}
	
	 public function get_settings()
	{
       $query = $this->db->query("SELECT * from `settings` WHERE `id` = '1'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
       return $result;
	}
	
	public function LimitEnd($username,$team,$chid,$challangetype)
	{

		
			$query = $this->db->query("SELECT * from `challangesrecords` WHERE `chid` = '$chid' AND `playername` = '$username' AND `type` = 'lose'");
			$result = $query->fetch(PDO::FETCH_ASSOC);
			
			if($result > 0 )
			{
			
				$ChallangeInfo = $this->GetChallangeInfo($chid,$challangetype);
				if($ChallangeInfo['limit'] == "No Limit")
				{
					return "No Limit";
				}
				else
				{
					
					$left = '';
					
					$StartDate = new DateTime($result['starttime']);
					$CurrDate  = new DateTime(date("20y-m-d") . "T" . date("h:i:s"));

					$diff = $CurrDate->diff($StartDate);
					
					$hours = $diff->h;
					$hours = $hours + ($diff->d*24);
					
					if($hours <=23)
					{
						$left = ($diff->h) . ":" . $diff->i . ":" . $diff->s . " Time Done";
					}
					else { $left = $diff->d . " Days Done"; }
	
					if($hours == 0)
					{
						if($diff->i >= $ChallangeInfo['limitnum'])
						{
							$this->LoseChallange($username,$team,$chid,$challangetype);
							return "End";
						} 
					}
					
					if($hours >= $ChallangeInfo['limitnum'])
					{
						$this->LoseChallange($username,$team,$chid,$challangetype);
						return "End";
					} 
					else { return $left; } 
					
					
				}
			}
			
			
			$this->LoseChallange($username,$team,$chid,$challangetype);
			return "End";
	}
	
		public function getteamprofile($me,$teamname)
	{
			$query = $this->db->query("SELECT * from `members` WHERE `name` = '$me'");
		    $result = $query->fetch(PDO::FETCH_ASSOC);
			
		    $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$teamname'");
		    $result2 = $query->fetch(PDO::FETCH_ASSOC);
			
			$return = array();
			
			$return['PlayerName']      = $result['name'];
			$return['Level']           = $result['level'];
			$return['Team']           = $result['team'];
			$return['CurrXP']          = $result['CurrXP'];
			$return['NextXP']          = $result['NextXP'];
			$return['notifications_n'] = $result['notifications'];
			$return['notifications']   = $this->get_notifications($me);
			
			$return['ProfileStatus']   = "danger";
			$return['ProfileInfo']     = "<strong>Error</strong> Team not found .";
			
			if($result2 > 0 )
			{
			
			
				$return['team_mems'] = $this->get_team_mems($teamname);
				$return['team_info'] = $this->get_team_info($teamname);
			
				$return['ProfileStatus']   = "nothing";
			
			}
			
			return $return;
	}
	
	public function getprofile($me,$playername)
	{
			$query = $this->db->query("SELECT * from `members` WHERE `name` = '$me'");
		    $result = $query->fetch(PDO::FETCH_ASSOC);
			
		    $query = $this->db->query("SELECT * from `members` WHERE `name` = '$playername'");
		    $result2 = $query->fetch(PDO::FETCH_ASSOC);
			
			$return = array();
			
			$return['PlayerName']      = $result['name'];
			$return['Level']           = $result['level'];
			$return['CurrXP']          = $result['CurrXP'];
			$return['NextXP']          = $result['NextXP'];
			$return['notifications_n'] = $result['notifications'];
			$return['notifications']   = $this->get_notifications($me);
			
			$return['ProfileStatus']   = "danger";
			$return['ProfileInfo']     = "<strong>Error</strong> Player name not found .";
			
			if($result2 > 0 )
			{
			
			$return['PlayerName_2']    = $result2['name'];
			$return['Level_2']         = $result2['level'];
			$return['Team_2']          = $result2['team'];
			$return['Achv_2']          = $result2['achievementsn'];
			$return['ChallangesWin_2'] = $result2['ChallangesWin'];
			$return['ChallangesLose_2']=  $result2['ChallangesLose'];
			$return['Info_2']          =  $result2['info'];
			$return['pic_2']           =  $result2['pic'];
			$return['achvs_2']         =  $this->get_achvs($playername);
			
			$return['ProfileStatus']   = "nothing";
			
			}
			
			return $return;
	}
	
	public function get_notifications($username)
	{
		
		$return = array();
        $query = $this->db->query("SELECT * from `notifications` WHERE `to` = '$username'");
        while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
     
        return $return;
	}
	
	public function get_invites($username)
	{
		$return = array();
        $query = $this->db->query("SELECT * from `invites` WHERE `to` = '$username'");
        while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
     
        return $return;
	}
	
	
	public function get_invites_leader($team)
	{
		
		$return = array();
        $query = $this->db->query("SELECT * from `invites` WHERE `team` = '$team'");
        while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
     
        return $return;
	}
	
	public function get_team_info($teamname)
	{
		
       $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$teamname'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
	}
	
	public function clear_notifications($username)
	{

       $query = $this->db->query("DELETE from `notifications` WHERE `to` = '$username'");
	   $this->db->query("UPDATE `members` SET notifications='0' WHERE `name` ='$username'");
	   
	}
	
	public function get_team_mems($teamname)
	{
		
		$return = array();
        $query = $this->db->query("SELECT * from `members` WHERE `team` = '$teamname'");
        while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
     
        return $return;
	}
	
	public function get_achvs($username)
	{
	

		$return = array();

        $query = $this->db->query("SELECT * from `achv` WHERE `username` = '$username'");
        while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
     
        return $return;
	}
	
	public function update_info($username,$info)
    {

		$stmt = $this->db->prepare("UPDATE `members` SET info= :info WHERE name= :username");
		$stmt->execute(array(':info' => $info,':username' => $username));
        //$this->db->query("UPDATE `members` SET info='$info' WHERE `name` ='$username'");
		return TRUE;
    }
	
	public function GetLeaderboardPlayers()
	{
		$return = array();

        $query = $this->db->query("SELECT * from `members` ORDER BY `CurrXP` DESC");
        while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
     
        return $return;
	}
	
	public function GetLeaderboardTeams()
	{
		$return = array();

        $query = $this->db->query("SELECT * from `teams` ORDER BY `TeamXP` DESC");
        while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
     
        return $return;
	}
		
	public function update_info_team($team,$leader,$info)
    {
		

	    $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$team'");
        $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		   $team = $result['name'];
		   
		   if($result['leader'] == $leader)
		   {
			  $stmt = $this->db->prepare("UPDATE `teams` SET Info= :info WHERE name= :team");
			  $stmt->execute(array(':info' => $info,':team' => $team));
			  
			//  $this->db->query("UPDATE `teams` SET Info='$info' WHERE `name` ='$team'");
			  return TRUE;
		   }
		   
		}
		
    
		return FALSE;
    }

	
	 public function Accept($username,$team,$invite)
	{
	   

       $query = $this->db->query("SELECT * from `invites` WHERE `id` = '$invite'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		  if($result['to'] == $username)
		  {
		  
			       $query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
				   $result2 = $query->fetch(PDO::FETCH_ASSOC);
				   $Win = $result2['ChallangesWin'];
				   $Lose = $result2['ChallangesLose'];
				   $XP = $result2['CurrXP'];
				   
			$this->db->query("DELETE from `invites` WHERE `id` = '$invite'");
			
			$this->db->query("UPDATE `teams` SET members=members+1 WHERE `name` ='$team'");
			$this->db->query("UPDATE `teams` SET ChallangesWin=ChallangesWin+'$Win' WHERE `name` ='$team'");
			$this->db->query("UPDATE `teams` SET ChallangesLose=ChallangesLose+'$Lose' WHERE `name` ='$team'");
			$this->db->query("UPDATE `teams` SET TeamXP=TeamXP+'$XP' WHERE `name` ='$team'");
			
			$this->db->query("UPDATE `members` SET team='$team' WHERE `name` ='$username'");
			
			
									
						$notifi = "You are now a member of team " . $team;
						$this->notifiplayer($username,$notifi);
						
			return $result;
	      }
	   }
	   
        return FALSE;
	}
	
	
	
	public function Leaveteam($username,$team)
	{

		
       $query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		  if($result['team'] == $team)
		  {
			
				   $query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
				   $result2 = $query->fetch(PDO::FETCH_ASSOC);
				   $Win = $result2['ChallangesWin'];
				   $Lose = $result2['ChallangesLose'];
				   $XP = $result2['CurrXP'];
				   
				$this->db->query("UPDATE `teams` SET members=members-1 WHERE `name` ='$team'");
				$this->db->query("UPDATE `teams` SET ChallangesWin=ChallangesWin-'$Win' WHERE `name` ='$team'");
			    $this->db->query("UPDATE `teams` SET ChallangesLose=ChallangesLose-'$Lose' WHERE `name` ='$team'");
			    $this->db->query("UPDATE `teams` SET TeamXP=TeamXP-'$XP' WHERE `name` ='$team'");
			
				$this->db->query("UPDATE `members` SET team='No Team' WHERE `name` ='$username'");
			
			return $result;
			
	      }
	   }
	   
        return FALSE;
	}
	
	
	public function LoseChallange($username,$team,$chid,$challangetype)
	{
		
		$query = $this->db->query("SELECT * from `challangesrecords` WHERE `playername` = '$username' AND `chid` = '$chid' AND `type` ='lose'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		if($result > 0)
		{
					$query = $this->db->query("SELECT * from `$challangetype` WHERE `chid` = '$chid'");
					$result = $query->fetch(PDO::FETCH_ASSOC);
		
					$this->db->query("UPDATE `members` SET `IsChid` ='NO' WHERE `name` ='$username'");
					$this->db->query("UPDATE `members` SET `ChallangesLose` =ChallangesLose+1 WHERE `name` ='$username'");
					$this->db->query("DELETE from `challangesrecords` WHERE `playername` ='$username' AND `chid` = '$chid' AND `type` ='lose'");
					
					if($team != "No Team")
						$this->db->query("UPDATE `teams` SET `ChallangesLose` =ChallangesLose+1 WHERE `name` ='$team'");
						
						$notifi = "You have lost the challange " . $result['name'];
						$this->notifiplayer($username,$notifi);
						
						return TRUE;
		}
		
		return FALSE;
	}
	
	
	public function GetUpdates()
	{
		$return = array();
		$query = $this->db->query("SELECT * from `updates`");
		
		while ($result = $query->fetch(PDO::FETCH_ASSOC))
        {
            $return[] = $result;
        }
		
		return $return;
	}
	
	public function AddXp($username,$team,$xp)
	{
		
		$query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		if($result > 0)
		{
		
			$this->db->query("UPDATE `members` SET `CurrXP` =CurrXP+'$xp' WHERE `name` ='$username'");
			
			if($team != "No Team")
				$this->db->query("UPDATE `teams` SET `TeamXP` =TeamXP+'$xp' WHERE `name` ='$team'");
				
		
			$query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
			$result = $query->fetch(PDO::FETCH_ASSOC);
		
			$NotDone = TRUE;
			
			while($NotDone)
			{
			$query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
			$result = $query->fetch(PDO::FETCH_ASSOC);
			
			// checking level ups
			if($result['CurrXP'] >= $result['NextXP'])
			{
				$this->db->query("UPDATE `members` SET `level` =level+1 WHERE `name` ='$username'");

				if($result['level'] == "1") 
					$this->db->query("UPDATE `members` SET `NextXP` ='1000' WHERE `name` ='$username'");
					
				if($result['level'] == "2") 
					$this->db->query("UPDATE `members` SET `NextXP` ='1500' WHERE `name` ='$username'");
					
										
				if($result['level'] == "3") 
					$this->db->query("UPDATE `members` SET `NextXP` ='2000' WHERE `name` ='$username'");
					
										
				if($result['level'] == "4") 
					$this->db->query("UPDATE `members` SET `NextXP` ='2500' WHERE `name` ='$username'");
					
										
				if($result['level'] == "5") 
					$this->db->query("UPDATE `members` SET `NextXP` ='3000' WHERE `name` ='$username'");
					
										
				if($result['level'] == "6") 
					$this->db->query("UPDATE `members` SET `NextXP` ='3500' WHERE `name` ='$username'");
					
										
				if($result['level'] == "7") 
					$this->db->query("UPDATE `members` SET `NextXP` ='4000' WHERE `name` ='$username'");
					
										
				if($result['level'] == "8") 
					$this->db->query("UPDATE `members` SET `NextXP` ='4500' WHERE `name` ='$username'");
					
										
				if($result['level'] == "9") 
					$this->db->query("UPDATE `members` SET `NextXP` ='5000' WHERE `name` ='$username'");
					
										
				if($result['level'] == "10") 
					$this->db->query("UPDATE `members` SET `NextXP` ='6000' WHERE `name` ='$username'");
					
										
				if($result['level'] == "11") 
					$this->db->query("UPDATE `members` SET `NextXP` ='7000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "12") 
					$this->db->query("UPDATE `members` SET `NextXP` ='8000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "13") 
					$this->db->query("UPDATE `members` SET `NextXP` ='9000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "14") 
					$this->db->query("UPDATE `members` SET `NextXP` ='10000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "15") 
					$this->db->query("UPDATE `members` SET `NextXP` ='11000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "16") 
					$this->db->query("UPDATE `members` SET `NextXP` ='12000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "17") 
					$this->db->query("UPDATE `members` SET `NextXP` ='13000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "18") 
					$this->db->query("UPDATE `members` SET `NextXP` ='14000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "19") 
					$this->db->query("UPDATE `members` SET `NextXP` ='15000' WHERE `name` ='$username'");
					
															
				if($result['level'] == "20") 
					$this->db->query("UPDATE `members` SET `NextXP` ='16500' WHERE `name` ='$username'");
					
				if($result['level'] == "21") 
					$this->db->query("UPDATE `members` SET `NextXP` ='17500' WHERE `name` ='$username'");
			} else {
				$NotDone = FALSE;
			}
			
			}
		
		}
	}
	
	public function AddAchv($username,$achv)
	{
		
		$query = $this->db->query("SELECT * from `achv` WHERE `username` = '$username' AND `achv` = '$achv'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		if($result > 0)
		{
			if($result['achvlevel'] == "Good")
			{
						$this->db->query("UPDATE `achv` SET `achvlevel` ='Danger' WHERE `username` ='$username' AND `achv` = '$achv'");
						
						$notifi = "You have got a new level for achievement " . $result['achv'];
						$this->notifiplayer($username,$notifi);
			}
			else
			{
			}
		}
		else
		{
						$achvpic = $achv . ".png";
						$this->db->query("INSERT INTO `achv` (`id`, `username`, `achv`, `achvpic`, `achvlevel`) VALUES (NULL, '$username', '$achv', '$achvpic','Good');");
						
						$this->db->query("UPDATE `members` SET `achievementsn` =achievementsn+1 WHERE `name` ='$username'");
						
						$notifi = "You have got a new achievement " . $result['achv'];
						$this->notifiplayer($username,$notifi);
		}
	}
	
	public function WinChallange($username,$team,$chid,$challangetype,$answer)
	{
		
		$answer = str_replace("%20"," ",$answer);
		$answer = str_replace(" ","",$answer);
		
		$query = $this->db->query("SELECT * from `challangesrecords` WHERE `playername` = '$username' AND `chid` = '$chid' AND `type` ='lose'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		if($result > 0)
		{
					$query = $this->db->query("SELECT * from `$challangetype` WHERE `chid` = '$chid'");
					$result = $query->fetch(PDO::FETCH_ASSOC);
					
					if($answer == $result['answer'])
					{
					
					$this->db->query("UPDATE `members` SET `IsChid` ='NO' WHERE `name` ='$username'");
					$this->db->query("UPDATE `members` SET `ChallangesWin` =ChallangesWin+1 WHERE `name` ='$username'");
					$this->db->query("UPDATE `challangesrecords` SET `type` ='win' WHERE `playername` ='$username' AND `chid` = '$chid' AND `type` ='lose'");
					
					if($team != "No Team")
						$this->db->query("UPDATE `teams` SET `ChallangesWin` =ChallangesWin+1 WHERE `name` ='$team'");
						
						$notifi = "You have win the challange " . $result['name'];
						$this->notifiplayer($username,$notifi);
						
						$this->AddXp($username,$team,$result['xp']);
						
						// check if challange of the week
						if($result['name'] == "Week Challange")
						{
									$query = $this->db->query("SELECT * from `settings` WHERE `id` = '1'");
									$result2 = $query->fetch(PDO::FETCH_ASSOC);
									
							if($result2['ChallangeOfWeek'] == "Open")		
							{
								$this->AddAchv($username,"Week Challanger");
								$this->db->query("UPDATE `settings` SET `ChallangeOfWeek` ='Close' WHERE `id` ='1'");
								$this->db->query("DELETE from `challangesrecords` WHERE `chid` = '1'"); // week challange index
								$this->db->query("UPDATE `members` SET `IsChid` ='NO' WHERE `IsChid` ='1'"); // set no challanges to all player who play challange of week
								
								$inf = "have won the challange of week";
								$this->db->query("INSERT INTO `updates` (`id`, `title`, `subject`) VALUES (NULL, '$username', '$inf')");
							}
						}
						
						return TRUE;
						} 
						
						return FALSE;
		}
		
		return FALSE;
	}
	
	public function GetChallangeInfo($chid,$challangetype)
	{
		
		$query = $this->db->query("SELECT * from `$challangetype` WHERE `chid` = '$chid'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	public function RegChallange($username,$chid,$challangetype)
	{
		
		$query = $this->db->query("SELECT * from `$challangetype` WHERE `chid` = '$chid'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		if($result > 0)
		{
			$CurrTime = date("20y-m-d") . "T" . date("h:i:s");
			$this->db->query("INSERT INTO `challangesrecords` (`id`, `playername`, `chid`, `type`,`starttime`) VALUES (NULL, '$username', '$chid', 'lose','$CurrTime');");
			$this->db->query("UPDATE `members` SET `IsChid` ='$chid' WHERE `name` ='$username'");
			
						$notifi = "You are now in challange " . $result['name'];
						$this->notifiplayer($username,$notifi);
						
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function CheckChallangeWin($username,$chid,$challangetype)
	{
		
							$query = $this->db->query("SELECT * from `$challangetype` WHERE `chid` = '$chid'");
							$result = $query->fetch(PDO::FETCH_ASSOC);
							
							$query = $this->db->query("SELECT * from `challangesrecords` WHERE `playername` = '$username' AND `chid` = '$chid' AND `type` = 'win'");
							$result2 = $query->fetch(PDO::FETCH_ASSOC);
							
							if($result2 > 0)
							{
								return TRUE;
							}
							else 
							{
								return FALSE;
							}
	}
	
	public function GetChallangesArray($challangestype,$username)
	{

						$return = array();
						
						$query = $this->db->query("SELECT * from `$challangestype`");
						while ($result = $query->fetch(PDO::FETCH_ASSOC))
						{
						
							if(!$this->CheckChallangeWin($username,$result['chid'],"$challangestype"))
								$return[] = $result;
							
						}
						
						return $return;
	}
	
	public function Cancle($username,$invite)
	{
		
		
       $query = $this->db->query("SELECT * from `invites` WHERE `id` = '$invite'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		  if($result['to'] == $username)
		  {
			$this->db->query("DELETE from `invites` WHERE `id` = '$invite'");
			
									
						$notifi = "your request to join the team " . $result['team'] . " has been cancled";
						$this->notifiplayer($username,$notifi);
						
			return $result;
	      }
	   }
	   
        return FALSE;
	}
	
	public function join($username,$team)
	{
		
	   $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$team'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		   $team = $result['name'];
		   
					$return = array();
					$query = $this->db->query("SELECT * from `invites` WHERE `to` = '$username'");
					while ($result_2 = $query->fetch(PDO::FETCH_ASSOC))
					{
						if($result_2['team'] == $team)
							return FALSE;
					}
     
		
			$this->db->query("INSERT INTO `invites` (`id`, `team`, `to`, `side`) VALUES (NULL, '$team', '$username', 'user');");
			return TRUE;
	   }
	   
        return FALSE;
	}

	
	public function invite($username,$team,$leader)
	{
		
	   $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$team'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		   $team = $result['name'];
		   
		   if($result['leader'] == $leader)
		   {
		   
		   	   $query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
			   $result = $query->fetch(PDO::FETCH_ASSOC);
			   
			   if($result > 0)
			   {
					if($result['team'] != $team)
					{
						$username = $result['name'];
					
						$return = array();
						$query = $this->db->query("SELECT * from `invites` WHERE `to` = '$username'");
						while ($result_2 = $query->fetch(PDO::FETCH_ASSOC))
						{
							if($result_2['team'] == $team)
								return FALSE;
						}
				    
		
			$this->db->query("INSERT INTO `invites` (`id`, `team`, `to`, `side`) VALUES (NULL, '$team', '$username', 'leader');");
			 
			 
			 						
						$notifi = "You have invite to join the team " . $team;
						$this->notifiplayer($username,$notifi);
						
			return TRUE;
			
					}
			
			    }
			
		}
		
	   }
	   
        return FALSE;
	}
	
	
	public function notifiplayer($username,$subject)
	{
				
		$this->db->query("INSERT INTO `notifications` (`id`, `to`, `subject`) VALUES (NULL, '$username', '$subject');");
		$this->db->query("UPDATE `members` SET notifications=notifications+1 WHERE `name` ='$username'");
					
	}
	
	public function kick($username,$team,$leader)
	{
		
	   $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$team'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		   $team = $result['name'];
		   
		   if($result['leader'] == $leader)
		   {
		   
		   	   $query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
			   $result = $query->fetch(PDO::FETCH_ASSOC);
			   
			   if($result > 0)
			   {
					if($result['team'] == $team)
					{
						$username = $result['name'];
						$this->db->query("UPDATE `members` SET team='No Team' WHERE `name` ='$username'");
						$this->db->query("UPDATE `teams` SET members=members-1 WHERE `name` ='$team'");
						
						$notifi = "You have been kicked from your team " . $team;
						$this->notifiplayer($username,$notifi);
						
						return TRUE;
			
					}
			
			    }
			
		}
		
	   }
	   
        return FALSE;
	}
	
	
	public function createteam($username,$team,$xp,$ChallangesWin,$ChallangesLose)
	{
		
	   $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$team'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
			return FALSE;
		} else {
		
			$this->db->query("INSERT INTO `teams` (`id`, `name`, `leader`, `members`, `ChallangesWin`, `ChallangesLose`, `TeamXP`, `Info`) VALUES (NULL, '$team', '$username', '1', '$ChallangesWin', '$ChallangesLose', '$xp','New Team');");
			$this->db->query("UPDATE `members` SET team='$team' WHERE `name` ='$username'");
			 
			$notifi = "You are now the leader of team " . $team;
			$this->notifiplayer($username,$notifi);
			
			return TRUE;
		
		}
	}
		
	public function del_team($username,$team)
	{
		
	   $query = $this->db->query("SELECT * from `teams` WHERE `name` = '$team'");
       $result = $query->fetch(PDO::FETCH_ASSOC);
	   
	   if($result > 0) 
	   {
		   $team = $result['name'];
		   
		   if($result['leader'] == $username)
		   {
		   
		   	   $query = $this->db->query("SELECT * from `members` WHERE `name` = '$username'");
			   $result = $query->fetch(PDO::FETCH_ASSOC);
			   
			   if($result > 0)
			   {
					if($result['team'] == $team)
					{
					
						$return = array();
						$query = $this->db->query("SELECT * from `members` WHERE `team` = '$team'");
						while ($result = $query->fetch(PDO::FETCH_ASSOC))
						{
							$username = $result['name'];
							$this->db->query("UPDATE `members` SET team='No Team' WHERE `name` ='$username'");
							
													$notifi = "Your team  " . $team . " has been deleted";
													$this->notifiplayer($username,$notifi);
						}
						
									$this->db->query("DELETE from `teams` WHERE `name` = '$team'");
						
						
						return TRUE;
			
					}
			
			    }
			
		}
		
	   }
	   
        return FALSE;
	}
}

