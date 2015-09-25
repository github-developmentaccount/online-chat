<?php
error_reporting(E_ALL);
class DB{
    private static $instance = NULL;
    private function __construct(){}
    private function __clone(){}
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new PDO("mysql:host=localhost;dbname=chat", 'root', 'root');
            self::$instance-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}

class Chat 
{
	private $_db;
	public function __construct() 
	{
		$this->_db = DB::getInstance();
		
	}

	public function MatchLogin($login, $password)
	{
                        if($login == "" && $password == "") {
                                return false;
                        }
                                //validation
                                $password = trim($password);
                                $login = strip_tags(trim($login));
                                $password = hash('sha256', $password);
                                if(!preg_match('/^[1-9a-zA-Z]{4,9}$/', $login)) {
                                return false;
                        }

                        //SQL query forming
                        $sql = 'SELECT password, login, id 
                        FROM users
                        WHERE login = ?
                        LIMIT 1';

                        $q = $this->_db->prepare($sql);
                        $q->execute(array($login));
                        $q->setFetchMode(PDO::FETCH_ASSOC);

                //matching and setting session
                if($row = $q->fetch()) {
                         if($row['password'] === $password && $row['login'] === $login) 
                                {
                                        $_SESSION['user']['login'] = $row['login'];
                                        $_SESSION['user']['id'] = $row['id'];
                                        $_SESSION['user']['ip'] = getenv("REMOTE_ADDR");

                                }
                }
                else 
                {
                        return 0;
                }
                unset($sql);
                unset($q);
                unset($row);
                return true;
      

	}

	public function LogOut()
	{
		session_destroy();
	}
	//Pull login from id
	public function LoginToId($id)
	{
		$id = intval($id);
		$sql = 'SELECT login FROM users
				 WHERE id = ?';
		$q = $this->_db->prepare($sql);
		$q->execute(array($id));
		$q->setFetchMode(PDO::FETCH_ASSOC);

		return ($r = $q->fetch()) ? $r['login'] : NULL;

	}
	//Pull id from login
	public function IdToLogin($login)
	{
		$query = 'SELECT id FROM users
				WHERE login = ?';

		$res = $this->_db->prepare($query);
		$res->execute(array($login));
		$res->setFetchMode(PDO::FETCH_ASSOC);

		return ($row = $res->fetch()) ? $row['id'] : NULL;

	}
	public function newMessage($message)
	{
		if(isset($sql)) unset($sql);
		$time = date("Y-m-d H:i:s");
		$uid = !empty($_SESSION['user']['id']) ? $_SESSION['user']['id'] 
										: self::IdToLogin($this->_db, $_SESSION['user']['login']);

		$sql = 'INSERT INTO messages (time, text, uid) VALUES (?,?,?)';
		$stmt = $this->_db->prepare($sql);
		 if($stmt->execute(array($time, $message, $uid)))
		 {
		 	return true;
		 } else {
		 	return false;
		 }


	}
	public function showMessage($table_name = 'messages')
	{
		$_sql =  'SELECT id, time, text, uid FROM '.$table_name.' 
							ORDER by id DESC
                                                        LIMIT 10';
		$result = $this->_db->query($_sql, PDO::FETCH_ASSOC);
		foreach($result as $row)
				{
					$Login = self::LoginToId($row['uid']);
					$output[] = array('login'=> $Login,
							  'time' => $row['time'],
							  'text' => $row['text'],
							  'id' => $row['uid']);
				}
				return json_encode($output);

				

	}
        
        public function CreateRoom($title) {
            if($title == '' || !preg_match('/^[a-zA-Z1-9]{6,10}$/', $title)) throw new Exception("Unvalid data entered");
            $sql = 'CREATE TABLE ? (
                    "id" INT(11) NOT NULL AUTO INCREMENT,
                    "text" TEXT NOT NULL,
                    "uid" INT(11) NOT NULL,
                    PRIMARY KEY ("id")
                    );';
            
            if(isset($_SESSION['user']['login']) && !empty($_SESSION['user']['login'])) 
                {
                    $login = $_SESSION['user']['login'];
                
                } else {
                    throw new Exception("Error occured. Session not found!");
                }
                
                $name = '';
                $name = 'rm_'.$login.'_'.$title;
                $stmt = $this->_db->prepare($sql);
                return ($stmt->execute());
                
            
        }
        
        public function DropRoom($title) 
        {
            if($title == '' || !preg_match('/^[a-zA-Z1-9]{6,10}$/', $title))
            {
            throw new Exception("Unable to delete room. Unvalid data sent.");
            
            }
            
            if(!isset($_SESSION['user']['login']) && empty($_SESSION['user']['login']))
            {
                throw new Exception("Permission denied. Your session seems to be broken.");
            }
            $sql = 'DROP TABLE ?';
            $table_name = '';
            $table_name = 'rm_'.$_SESSION['user']['login'].'_'.$title;
            $stmt = $this->_db->prepare($sql);
            return $stmt->execute();
                        
        }
        
        public function ShowAvailableRooms() 
        {
            
            
            
        }
        
        
        
        
}

