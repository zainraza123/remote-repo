<?php

require_once './includes/dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$code)
	{
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare(file_get_contents("sql/insertRegistration"));
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare(file_get_contents("sql/getLoginUser"));
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
					}
					else
					{
						header("Location: login.php?error");
						exit;
					}
				}
				else
				{
					header("Location: login.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: login.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('./includes/mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "tls";
		$mail->Host       = "smtp.ethereal.email";
		$mail->Port       = 587;
		$mail->AddAddress($email);
		$mail->Username="qsber265ry4gkmy3@ethereal.email";
		$mail->Password="fpUqePRYdNVZYQwScz";
		$mail->SetFrom('no-reply@gmail.com','Zain Raza');
		$mail->AddReplyTo("no-reply@gmail.com","Zain Raza");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}

	function isAdmin() {
        $stmt = $this->conn->prepare(file_get_contents("sql/getAdmin"));
        $stmt->execute(array(":userID"=>$_SESSION['userSession']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['isAdmin'] ? true : false;
	}

	function getItemCategory() {
        $stmt = $this->conn->prepare(file_get_contents("sql/getCategory"));
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    function saveItem($data) {
        try
        {
            $stmt = $this->conn->prepare(file_get_contents("sql/insertProducts"));
            $stmt->bindparam(":itemCategoryID", $data['item_category']);
            $stmt->bindparam(":itemName", $data['item_name']);
            $stmt->bindparam(":itemPrice", $data['item_price']);
            $stmt->bindparam(":itemImgName", $data['item_image']);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function getAllItems() {
	    try
        {
            $stmt = $this->conn->prepare(file_get_contents('sql/getProducts'));
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $ex)
        {
	        echo $ex->getMessage();
        }
    }

    function getItem($itemID) {
	    try
        {
            $stmt = $this->conn->prepare(file_get_contents("sql/getProduct"));
            $stmt->execute(array(":itemID" => $itemID));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function editItem($data, $itemID) {
	    try
        {
            $stmt = $this->conn->prepare(file_get_contents("sql/updateProduct"));
            $stmt->bindparam(":itemCategoryID", $data['item_category']);
            $stmt->bindparam(":itemName", $data['item_name']);
            $stmt->bindparam(":itemPrice", $data['item_price']);
            $stmt->bindparam(":itemID", $itemID);
            $stmt->execute();
            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function deleteItem($itemID) {
	    try
        {
            $stmt = $this->conn->prepare(file_get_contents("sql/deleteProduct"));
            $stmt->execute(array(":itemID" => $itemID));
            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function placeOrder($data) {

        try
        {
            $stmt = $this->conn->prepare(file_get_contents("sql/insertOrder"));
            $stmt->bindparam(":orderNum", $data['orderNum']);
            $stmt->bindparam(":orderEmail", $data['orderEmail']);
            $stmt->bindparam(":orderItemID", $data['orderItemID']);
            $stmt->execute();
            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    function getAllUserOrders($email) {
        try
        {
            $stmt = $this->conn->prepare(file_get_contents("sql/getUserOrder"));
            $stmt->execute(array(":orderEmail" => $email));
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }


    function searchProducts($term) {
        $sql = file_get_contents('./sql/searchProduct');
        $statement = $this->conn->prepare($sql);
        $params = array(
            ':pattern' => '%'.$term.'%'
        );

        $statement->execute($params);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
	}
}