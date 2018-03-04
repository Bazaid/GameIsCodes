<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

    public function check_user($username,$password)
    {
        $epassword = sha1(md5($password.'666'));
        $query = $this->db->query("SELECT count(*) FROM `members` WHERE `name` ='$username' AND `password` = '$epassword'");
		$result = $query->fetch(PDO::FETCH_NUM);
		return $result[0];
    }
	
    public function get_id($username)
    {
        $query = $this->db->query("SELECT id FROM `members` WHERE `name` ='$username'");
		$result = $query->fetch(PDO::FETCH_NUM);
		return $result[0];
    }
	
    public function register($username,$password,$email)
    {
		$epassword = sha1(md5($password.'666'));
        $query = $this->db->query("SELECT * from `members` WHERE `name` ='$username'");
		$result = $query->fetch(PDO::FETCH_NUM);
		
		if($result > 0)
		{
			return FALSE;
		} else {
		
			$this->db->query("INSERT INTO `members` (`id`, `name`, `password`, `email`, `team`, `level`, `ChallangesWin`, `ChallangesLose`, `achievementsn`, `CurrXP`, `NextXP`, `info`, `pic`, `notifications`, `IsChid`) VALUES (NULL, '$username', '$epassword', '$email', 'No Team', '1', '0', '0', '0', '0', '500', 'New Member', 'default.png', '0', 'NO')");
			return TRUE;
		
		}
		
		return FALSE;
		
		
    }


}

