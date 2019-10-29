<?php
   namespace controllers;
   use core\Controller;
   use models\UserModel;
   use models\User;
   use models\TweetModel;
   use models\Tweet;
   class MainController extends Controller{
      private $userModel;
      private $tweetModel;
      public function __construct(){
         $this->userModel = new UserModel();
         $this->tweetModel = new TweetModel();
      }
      public function index(){
         return "index";
      }
      public function login(){
         $user = new User();
         if(isset($_POST['email'])&&isset($_POST['password'])){
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            $_SESSION['id']=$this->userModel->loginUser($user)->id;   
            $check='false';
            if(isset($_SESSION['id'])){
               $check='true';
               header('Location:profile');
            }
            if($check=='false'){
               return "index";
            } 
         }
      }
      function register(){
         $user = new User();
         $user->email = $_POST['email'];
         $user->password = $_POST['password'];
         $user->name = $_POST['name'];
         $user->surname = $_POST['surname'];
         $user->gender = $_POST['gender'];
         $user->country = $_POST['country'];
         $user->city = $_POST['city'];
         $this->userModel->registerUser($user);
         header("Location:index");
      }
      public function getuser(){
         $user = $this->userModel->getUser($_SESSION['id']);
         $_REQUEST['USER_PROFILE'] = $user;
         return 'profile';
      }
      public function search(){
         $lookup = $_GET['search'];
         $_REQUEST['SEARCH_LIST'] = $this->userModel->searchUser($lookup);
         return 'profile';
      }
      public function getguest(){
         $guest = $this->userModel->getGuest($_GET['id']);
         $_REQUEST['GUEST_PROFILE'] = $guest;
         $follow = $this->userModel->getFollow();
         $_REQUEST['FOLLOW_STATUS'] = $follow;
         return 'profile';
      }
      public function updateuser(){
         $user = new User();
         $user->name = $_POST['name'];
         $user->surname = $_POST['surname'];
         $user->gender = $_POST['gender'];
         $user->country = $_POST['country'];
         $user->city = $_POST['city'];
         $this->userModel->updateUser($user);
         header("Location:profile");
      }
      public function deleteuser(){
         $this->userModel->deleteUser();
         header("Location:index");
      }
      public function followuser(){
         $user = new User();
         $user->id = $_POST['follow'];
         $this->userModel->followUser($user);
         header("Location:guest?id=".$user->id);
      }
      public function unfollowuser(){
         $user = new User();
         $user->id = $_POST['unfollow'];
         $this->userModel->unfollowUser($user);
         header("Location:guest?id=".$user->id);
      }
      public function getfollowers(){
         $followers = $this->userModel->getFollowers();
         $_REQUEST['FOLLOWERS_LIST'] = $followers;
         return 'profile';
      }
      public function getfollows(){
         $follows = $this->userModel->getFollows();
         $_REQUEST['FOLLOWS_LIST'] = $follows;
         return 'profile';
      }
      public function gettweets(){
         $tweets = $this->tweetModel->getAllTweets();
         $_REQUEST['TWEET_LIST'] = $tweets;
         return "profile";
      }
      public function tweetcreate(){
         $new_tweet = new Tweet();
         $new_tweet->tweet = $_POST['tweet'];
         $this->tweetModel->tweetCreate($new_tweet);
         header("Location:tweets");
      }
      public function gettweet(){
        $edittweet = $this->tweetModel->getTweet($_GET['id']);
         $_REQUEST['EDIT_TWEET'] = $edittweet;
         return 'profile';
      }
      public function tweetupdate(){
         $tweet = new Tweet();
         $tweet->id = $_POST['tweet_id'];
         $tweet->tweet = $_POST['tweet'];
         $this->tweetModel->updateTweet($tweet);
         header("Location:tweets");
      }
      public function deletetweet(){
         $id = $_POST['tweet_id'];
         $this->tweetModel->deleteTweet($id);
         header("Location:tweets");
      } 
   } 
?>