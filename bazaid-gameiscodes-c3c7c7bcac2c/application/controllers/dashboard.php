<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public $data = array();
	public $data_2 = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user');
		$this->load->library('auth');
		$this->load->library('form_validation');
		
		
		if (!$this->user->check_login())
	redirect('main');
	}
	

	
	public function IntalizeData()
	{
			$this->data['PlayerName']    = $this->user->name;
			$this->data['Level']         = $this->user->level;
			$this->data['Team']          = $this->user->team;
			$this->data['Achv']          = $this->user->achievementsn;
			$this->data['ChallangesWin'] = $this->user->ChallangesWin;
			$this->data['ChallangesLose']= $this->user->ChallangesLose;
			$this->data['CurrXP']        =  $this->user->CurrXP;
			$this->data['NextXP']        =  $this->user->NextXP;
			$this->data['Info']          =  $this->user->Info;
			$this->data['pic']           =  $this->user->pic;
			$this->data['notifications_n'] =  $this->user->notifications_n;
			$this->data['notifications'] =  $this->user->notifications;
			$this->data['achvs']         =  $this->user->get_achvs($this->user->name);
			$this->data['IsChid']        = $this->user->IsChid;
			$this->data['ChallangeOfWeek'] = $this->user->ChallangeOfWeek;
			$this->data['Updates']       =   $this->user->Updates;
	}

	public function index()
	{
	
		     // Checking user loged in if true then show the dashboard
		    // intlizing data
			
			$this->IntalizeData();
			$this->data['IsNotEdit']     =  TRUE;
						
			$this->load->view('dashboard',$this->data);	
	}
	
	
	public function Challanges()
	{
	
		     // Checking user loged in if true then show the dashboard
		    // intlizing data
			
			$this->IntalizeData();
			$this->data['MainChallangesArray'] = $this->user->GetChallangesArray("mainchallanges",$this->user->name);

			$this->load->view('challanges',$this->data);
	}
	
	
	public function achievements()
	{
		$this->IntalizeData();
		$this->load->view('achievements',$this->data);
	}
	
	
	public function leaderboard()
	{
		$this->IntalizeData();
		$this->data['Players'] = $this->user->GetLeaderboardPlayers();
		$this->data['Teams'] = $this->user->GetLeaderboardTeams();
		$this->load->view('leaderboard',$this->data);
	}
	
	public function WinChallange($chid,$challangetype,$answer)
	{
	
		     // Checking user loged in if true then show the dashboard
		    // intlizing data
			
			$this->IntalizeData();
			if($answer == "-NULL-")
			{
				$answer = str_replace("%20", " ", $this->input->post('answer'));
			}
	
			if($chid != NULL and $challangetype != NULL)
			{
				
			if($challangetype == "mainchallanges" or $challangetype == "mainchallanges" or $challangetype == "mainchallanges")
			{
			if(!$this->user->CheckChallangeWin($chid,$challangetype))
			{	
				if($this->user->IsChid == $chid)
				{
					// continue checking answer
					$this->user->WinChallange($chid,$challangetype,$answer);
					$this->Challange($chid,$challangetype);
					
				}
				else { redirect('dashboard'); }
				
			}
			} else {
			
			$this->index();
			
			}
			} else { redirect('dashboard');  }
	
	}
	
	public function LoseChallange($chid,$challangetype)
	{
	
		     // Checking user loged in if true then show the dashboard
		    // intlizing data
			
			$this->IntalizeData();
			
			if($chid != NULL and $challangetype != NULL)
			{
				
			if($challangetype == "mainchallanges" or $challangetype == "mainchallanges" or $challangetype == "mainchallanges")
			{
			if(!$this->user->CheckChallangeWin($chid,$challangetype))
			{	
				if($this->user->IsChid == $chid)
				{
					// continue challange
					$this->user->LoseChallange($chid,$challangetype);
					redirect('dashboard');
				}
				else { redirect('dashboard'); }
				
			}
			} else {
			
			$this->index();
			
			}
			} else { redirect('dashboard');  }
	
	}
	
	public function Challange($chid,$challangetype)
	{
	
		     // Checking user loged in if true then show the dashboard
		    // intlizing data
			
			$this->IntalizeData();
			
			if($chid != NULL and $challangetype != NULL)
			{
				
			if($challangetype == "mainchallanges" or $challangetype == "mainchallanges" or $challangetype == "mainchallanges")
			{
			
			// check if challange of week
			if($chid == "1")
			{
				if($this->user->ChallangeOfWeek == "Close")
				{
					redirect('dashboard');
				}
			}
			
			if(!$this->user->CheckChallangeWin($chid,$challangetype))
			{	
				
				if($this->user->IsChid == $chid)
				{
					// continue challange
					$this->data['ChallangeInfo'] = $this->user->GetChallangeInfo($chid,$challangetype);
					
						$limit = $this->user->LimitEnd($chid,$challangetype);
						$this->data['TimeDone'] = $limit;
				
					if($limit != "End")
					{
						$this->load->view('challanges/' . $chid . '/' . $chid,$this->data);
						
					} else {
						redirect('dashboard');
					}
				}
				else {
					if($this->user->IsChid == "NO")
					{
						if($this->user->RegChallange($this->user->name,$chid,$challangetype))
						{
										    $limit = $this->user->LimitEnd($chid,$challangetype);
											$this->data['TimeDone'] = $limit;
				
							$this->data['ChallangeInfo'] = $this->user->GetChallangeInfo($chid,$challangetype);
							$this->load->view('challanges/' . $chid . '/' . $chid,$this->data);
							
						} else { redirect('dashboard'); }
					} else {
						// can't enter this challange cause in another challange
						$this->index();
					}
				}
				
			} else {
			
			$this->index();
			
			}
			} else { redirect('dashboard');  }
			} else { redirect('dashboard');  }
	
	}
	
	
	public function profile($playername)
	{
			if($playername != NULL)
			{
				$this->data_2 = $this->user->getprofile(str_replace("%20", " ", $playername));
				$this->load->view('profile',$this->data_2);	
				
			} else {
			
			redirect('dashboard');
			
			}
	}
	
	public function teamprofile($teamname)
	{
			if($teamname != NULL and $teamname != "No Team")
			{
				$this->data_2 = $this->user->getteamprofile(str_replace("%20", " ", $teamname));
				$this->load->view('teamprofile',$this->data_2);	
				
			} else {
			
			redirect('dashboard');
			
			}
	}
	
	public function clearnotifications()
	{
	
		// Checking user loged in if true then show the dashboard
		
		    // intlizing data	
			$this->user->clear_notifications($this->user->name);
		//	$this->index();
		redirect('dashboard');
	}
	
	public function Accept($team,$invite)
	{
		if ($team != NULL and $invite != NULL)
		{
			$this->user->Accept($this->user->name,str_replace("%20", " ", $team),$invite);
		}
		
		$this->team();
	}
	
		
	public function Acceptleader($user,$team,$invite)
	{
		if ($team != NULL and $invite != NULL)
		{
			$this->user->Accept(str_replace("%20", " ", $user),str_replace("%20", " ", $team),$invite);
		}
		
		$this->teammanage();
	}
	
	public function Leaveteam()
	{

		if($this->user->team != "No Team")
		{
			$this->user->Leaveteam($this->user->name,$this->user->team);
		}
		
		$this->index();
	}
	
	public function Cancle($invite)
	{
		if ($invite != NULL)
		{
			$this->user->Cancle($this->user->name,$invite);
		}
		
		$this->team();
	}
	
	public function Cancleleader($user,$invite)
	{
		if ($invite != NULL)
		{
			$this->user->Cancle(str_replace("%20", " ", $user),$invite);
		}
		
		$this->teammanage();
	}
	
	public function team()
	{
		    // intlizing data
			$this->IntalizeData();
			if($this->data['Team'] != "No Team")
			{
				$this->data['team_mems'] = $this->user->get_team_mems($this->data['Team']);
				$this->data['team_info'] = $this->user->get_team_info($this->data['Team']);
			}
			else
			{
				$this->data['CreateStatus'] = "nothing";
				$this->data['invites'] = $this->user->get_invites($this->data['PlayerName']);
				$this->data['NoJoinError'] = $this->user->NoJoinError;
			}
			
			
			$this->load->view('team',$this->data);	
	}
	
	public function teammanage()
	{
		    // intlizing data
			$this->IntalizeData();
			if($this->data['Team'] != "No Team")
			{
				$this->data['team_mems'] = $this->user->get_team_mems($this->data['Team']);
				$this->data['team_info'] = $this->user->get_team_info($this->data['Team']);
				
				if($this->data['team_info']['leader'] == $this->user->name) 
				{
					$this->data['invites'] = $this->user->get_invites_leader($this->data['Team']);
					$this->data['NoInviteError'] = $this->user->NoInviteError;
					
					$this->load->view('teammanage',$this->data);	
				} else {
					$this->index();	
				}
			}
			else
			{
				$this->index();	
			}
			
	}
	
	
	public function join()
	{
		$this->IntalizeData();
		
			if($this->user->team == "No Team")
			{
				$teamname = str_replace("%20", " ", $this->input->post('teamname'));
				$this->user->join($this->user->name,$teamname);
			
			}
			
			$this->team();
	}
	
    public function invite()
	{
		$this->IntalizeData();
		
			$playername = str_replace("%20", " ", $this->input->post('playername'));
			$this->user->invite($playername,$this->user->team,$this->user->name);
			
			$this->teammanage();
	}
	
	
	public function kickplayer($playername)
	{
		    $this->IntalizeData();
			$this->user->kick(str_replace("%20", " ", $playername),$this->user->team,$this->user->name);
			
			$this->teammanage();
	}
	
	public function edit()
	{
			// intlizing data
			$this->IntalizeData();
			$this->data['IsNotEdit']     =  FALSE;
			
			$this->load->view('dashboard',$this->data);
	}
	
	public function saveedit()
	{
			// intlizing data
			$this->IntalizeData();
			$this->data['IsNotEdit']     =  TRUE;
			
			$NewInfo = str_replace("%20", " ", $this->input->post('editinfo'));
			$this->user->update_info($this->user->name,$NewInfo);
			
			redirect('dashboard/#info');
	}
	
	public function saveeditteam()
	{
			// intlizing data
			$this->IntalizeData();
			
			$NewInfo = str_replace("%20", " ", $this->input->post('editinfo'));
			$this->user->update_info_team($this->user->team,$this->user->name,$NewInfo);
			
			$this->teammanage();
	}
	
	public function delteam()
	{
		// intlizing data
			$this->IntalizeData();
			
			$this->user->del_team($this->user->name,$this->user->team);
			
			$this->index();
	}
	
	public function createteam()
	{
		// intlizing data
			$this->IntalizeData();
			$teamname = str_replace("%20", " ", $this->input->post('teamname'));
			
			if($this->user->level >= 10)
			{
				if($this->user->team == "No Team" and $teamname != NULL)
				{
					if($teamname != "No Team")
					{
						
						if($this->user->createteam($this->user->name,$teamname,$this->user->CurrXP,$this->user->ChallangesWin,$this->user->ChallangesLose))
						{
							$this->data['CreateStatus'] = "success";
							$this->data['CreateInfo'] = "<strong>Done</strong> Your team has been created refresh the page to enter the team page";
							
						} else {
								$this->data['CreateStatus'] = "danger";
								$this->data['CreateInfo'] = "<strong>Error</strong> the name " . $teamname . " is allready used";
						}
						
					} else {
					
								$this->data['CreateStatus'] = "danger";
								$this->data['CreateInfo'] = "<strong>Error</strong> you cant create team with name (No Team)";
							}
				}
			}
			
			// intlizing data
			$this->IntalizeData();
			if($this->data['Team'] != "No Team")
			{
				$this->data['team_mems'] = $this->user->get_team_mems($this->data['Team']);
				$this->data['team_info'] = $this->user->get_team_info($this->data['Team']);
			}
			else
			{
				$this->data['invites'] = $this->user->get_invites($this->data['PlayerName']);
				$this->data['NoJoinError'] = $this->user->NoJoinError;
			}
			
			
			$this->load->view('team',$this->data);	
			
	}
	
    public function logout()
	{
	$this->user->logout();
		redirect('main');
	}
	
}

