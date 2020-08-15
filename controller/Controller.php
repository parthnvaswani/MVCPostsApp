<?php
    require 'model/postsModel.php';
    require 'model/post.php';
    require 'model/user.php';
    require 'model/userModel.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class Controller 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->post =  new postsModel($this->objconfig);
			$this->user =  new userModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{
            $act = isset($_GET['act']) ? $_GET['act'] : NULL; 
			switch ($act) 
			{
                case 'feed' :                    
					$this->feed();
					break;					
				case 'login' :					
					$this -> login();
					break;								
				case 'logout' :					
					$this -> logout();
					break;								
				case 'register' :					
					$this -> register();
					break;								
				case 'addPost' :					
					$this -> addPost();
					break;								
				case 'deletePost' :					
					$this -> deletePost();
					break;								
				case 'getPosts' :					
					$this -> getPosts();
					break;								
				default:
                    $this->landing();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}
        
        public function logout(){
            session_start();
            $_SESSION["userDetails"] = "";
            session_destroy();
            $this->pageRedirect('index.php?act=landing');                                   
        }
        public function login(){
            if (isset($_POST['login'])){
                try{
                    $obj=new user();
                    $obj->username=$_POST["username"];
                    $obj->password=md5($_POST["password"]);
                    $result=$this->user->find($obj);
                    $res=$result->fetch_assoc()['username'];
                    if($res){
                        $_SESSION["userDetails"]=$res;
                        $this->feed();
                    }else{
                        $_SESSION["errorMessage"]="credentials do not match";
                        $this->pageRedirect('view/login.php');
                    }
                    
                }
                catch(Exception $e){
                    throw $e;
                }
            }else{
                $this->pageRedirect('view/login.php'); 
            }                                    
        }
        public function feed()
        {
            $this->pageRedirect('view/feed.php');
        }
        public function landing()
        {
            $this->pageRedirect('view/landing.php');
        }
        public function register()
        {
            if (isset($_POST['register'])){
                try{
                    $obj=new user();
                    $obj->username=$_POST["username"];
                    $obj->password=md5($_POST["password"]);
                    $res=$this->user->insert($obj);
                    if($res){
                        $this->login();
                    }else{
                        $_SESSION["errorMessage"]="username already exists";
                        $this->pageRedirect('view/register.php');
                    }
                    
                }
                catch(Exception $e){
                    throw $e;
                }
            }else{
                $this->pageRedirect('view/register.php'); 
            }  
        }
        public function addPost()
        {
            try{
            $obj=new post();
            $obj->username=$_SESSION["userDetails"];
            $obj->content=$_POST["content"];
            $this->post->insert($obj);
            echo "success";
            }catch(Exception $e){
                echo $e;
            }
        }
        public function deletePost()
        {
            try{
            $obj=new post();
            $obj->username=$_SESSION["userDetails"];
            $obj->id=$_GET["id"];
            $res=$this->post->delete($obj);
            if($res){
                echo "success";
            }else{
                echo "Somthing is wrong..., try again.";
            }
            }catch(Exception $e){
                echo $e;
            }
        }
        public function getPosts()
        {
            try{
            $res=$this->post->select(0);
            $rows = array();
            while($r = mysqli_fetch_assoc($res)) {
                $rows[] = $r;
            }
            echo json_encode($rows);
            }catch(Exception $e){
                echo $e;
            }
        }
    }
		
	
?>