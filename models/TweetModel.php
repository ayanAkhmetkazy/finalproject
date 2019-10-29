<?php
	namespace models;
   use models\Tweet;
   use core\DBManager;
   use PDO;
    class TweetModel{
      private $dbManager;
      public function __construct(){
         $this->dbManager = new DBManager("localhost", "bitlab", "root", "");
      }
      public function getAllTweets(){
         $result = array();
         try{
            $query = $this->dbManager->getConnection()->prepare("
            	SELECT * FROM tweets
            	WHERE user_id = :u_id
            	");
            $query->execute(array('u_id'=>$_SESSION['id']));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\Tweet");
         }catch(Exception $e){
            echo $e->getMessage();
         }
         return $result;
      }
      public function tweetCreate(Tweet $tweet){
         try{
            $query = $this->dbManager->getConnection()->prepare("
            	INSERT INTO tweets (user_id, tweet, active, like_count)
        		VALUES (:u_id,:u_tweet,:u_active,:u_likes)
            	");
            $query->execute(array('u_id'=>$_SESSION['id'], 'u_tweet'=>$tweet->tweet, 'u_active'=>1, 'u_likes'=>0));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\Tweet");
         }catch(Exception $e){
            echo $e->getMessage();
         }
      }
      public function getTweet($id){
         try{
            $query = $this->dbManager->getConnection()->prepare("
            	SELECT tweet
            	FROM tweets WHERE id=:t_id
            	");
            $query->execute(array('t_id'=>$id));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\Tweet")[0];
         }catch(Exception $e){
            echo $e->getMessage();
         }
         return $result;
      }
      public function updateTweet(Tweet $tweet){
         try{
            $query = $this->dbManager->getConnection()->prepare("
            	UPDATE tweets SET tweet = :t_tweet
           		WHERE id = :t_id
            	");
            $query->execute(array('t_tweet' => $tweet->tweet, 't_id' => $tweet->id));
         }catch(Exception $e){
            echo $e->getMessage();
         }
      }
      public function deleteTweet($id){
         try{
            $query = $this->dbManager->getConnection()->prepare("
            	UPDATE tweets SET active = :t_active             
               	WHERE id = :t_id
            	");
            $query->execute(array('t_id' => $id, 't_active' => 0));
         }catch(Exception $e){
            echo $e->getMessage();
         }
      }
    }
?>