<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User
{
    public $name = '';
    public $user_id = '';
    public $team = '';
    public $level = 0;
    public $ChallangesWin = 0;
    public $ChallangesLose = 0;
    public $achievementsn = 0;
    public $CurrXP = 0;
    public $NextXP = 0;
    public $Info = 0;
	public $pic = '';
	public $notifications_n = 0;
	public $notifications = array();
	public $IsChid = '';

	public $NoJoinError = TRUE;
	public $NoInviteError = TRUE;
	
	public $ChallangeOfWeek = '';
	public $Updates = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('user_model');
		$this->CI->load->library('session');
		
    $this->name = $this->CI->session->userdata('username');
    $this->user_id = $this->CI->session->userdata('user_id');
  
    $use_info =$this->CI->user_model->get_info($this->name);
	$use_info_2 =$this->CI->user_model->get_settings();
	
	$this->name = $use_info['name'];
    $this->team = $use_info['team'];
    $this->level = $use_info['level'];
    $this->ChallangesWin = $use_info['ChallangesWin'];
    $this->ChallangesLose = $use_info['ChallangesLose'];
    $this->achievementsn = $use_info['achievementsn'];
    $this->CurrXP = $use_info['CurrXP'];
    $this->NextXP = $use_info['NextXP'];
    $this->Info = $use_info['info'];
	$this->pic = $use_info['pic'];
	$this->notifications_n = $use_info['notifications'];
	$this->notifications   = $this->CI->user_model->get_notifications($this->name);
	$this->IsChid = $use_info['IsChid'];
	
	$this->ChallangeOfWeek = $use_info_2['ChallangeOfWeek'];
	$this->Updates         = $this->CI->user_model->GetUpdates();
    
    
	}
	
	public function GetChallangeInfo($chid,$challangetype)
	{
		return $this->CI->user_model->GetChallangeInfo($chid,$challangetype);
	}
	
	public function LoseChallange($chid,$chalangetype)
	{
		return $this->CI->user_model->LoseChallange($this->name,$this->team,$chid,$chalangetype);
	}
	
	public function RegChallange($username,$chid,$challangetype)
	{
		return $this->CI->user_model->RegChallange($username,$chid,$challangetype);
	}
	
	public function GetChallangesArray($challangestype,$username)
	{
		return $this->CI->user_model->GetChallangesArray($challangestype,$username);
	}
	
	public function GetLeaderboardPlayers()
	{
		return $this->CI->user_model->GetLeaderboardPlayers();
	}
	
	public function GetLeaderboardTeams()
	{
		return $this->CI->user_model->GetLeaderboardTeams();
	}
	
	public function LimitEnd($chid,$challangetype)
	{
		return $this->CI->user_model->LimitEnd($this->name,$this->team,$chid,$challangetype);
	}
	
	public function WinChallange($chid,$challangetype,$answer)
	{
		return $this->CI->user_model->WinChallange($this->name,$this->team,$chid,$challangetype,$answer);
	}
	
	public function CheckChallangeWin($chid,$challangetype)
	{
		return $this->CI->user_model->CheckChallangeWin($this->name,$chid,$challangetype);
	}
	
	public function update_info($username,$info)
    {
		return $this->CI->user_model->update_info($username,$info);
    }
	
	public function getprofile($playername)
	{
		$ret = $this->CI->user_model->getprofile($this->name,$playername);
		$ret['Updates'] = $this->data['Updates'] = $this->Updates;
		
		return $ret;
	}
	
	public function getteamprofile($teamname)
	{
		$ret = $this->CI->user_model->getteamprofile($this->name,$teamname);
		$ret['Updates'] = $this->data['Updates'] = $this->Updates;
		
		return $ret;
	}
	
	public function update_info_team($team,$leader,$info)
    {
		return $this->CI->user_model->update_info_team($team,$leader,$info);
    }
	
	public function get_achvs($username)
	{
       return $this->CI->user_model->get_achvs($username);
	}
	
    public function get_team_info($teamname)
    {
		return $this->CI->user_model->get_team_info($teamname);
    }
	
	public function clear_notifications($username)
	{
		$this->CI->user_model->clear_notifications($username);
	}
	
	public function get_invites($username)
	{
		return $this->CI->user_model->get_invites($username);
	}
	
		
	public function get_invites_leader($team)
	{
		return $this->CI->user_model->get_invites_leader($team);
	}
	
	public function get_team_mems($teamname)
	{
		return $this->CI->user_model->get_team_mems($teamname);
	}
	
	public function Accept($username,$team,$invite)
	{
		$this->CI->user_model->Accept($username,$team,$invite);
	}
	
	public function Leaveteam($username,$team)
	{
		return $this->CI->user_model->Leaveteam($username,$team);
	}
	
	public function Cancle($username,$invite)
	{
		$this->CI->user_model->Cancle($username,$invite);
	}
	
	public function join($username,$team)
	{
		$this->NoJoinError = $this->CI->user_model->join($username,$team);
	}
	
	
	public function invite($username,$team,$leader)
	{
		$this->NoInviteError = $this->CI->user_model->invite($username,$team,$leader);
	}
	
	public function del_team($username,$team)
	{
		$this->CI->user_model->del_team($username,$team);
	}
	
    public function kick($username,$team,$leader)
	{
		return $this->CI->user_model->kick($username,$team,$leader);
	}
	
	public function notifiplayer($username,$subject)
	{
		$this->CI->user_model->notifiplayer($username,$subject);
	}
	
	public function createteam($username,$teamname,$xp,$ChallangesWin,$ChallangesLose)
	{
		return $this->CI->user_model->createteam($username,$teamname,$xp,$ChallangesWin,$ChallangesLose);
	}
	
    public function logout()
    {
    $this->CI->session->sess_destroy();
    }
	
    public function check_login()
    {
    if ($this->CI->session->userdata('logged_in'))
    {
    return TRUE;
    }else{
    return FALSE;
    }
    
    }
}

