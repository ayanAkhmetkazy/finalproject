<?php
   namespace models;
   use models\User;
   use core\DBManager;
   use PDO;
   class UserModel{
      private $dbManager;
      public function __construct(){
         $this->dbManager = new DBManager("localhost", "bitlab", "root", "");
      }
      public function loginUser(User $user){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               SELECT id FROM users WHERE email=:u_email AND password=:u_password 
            ");
            $query->execute(array("u_email"=>$user->email, "u_password"=>$user->password));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User")[0];

         }catch (Exception $e){
            echo $e->getMessage();
         }
         return $result;
      }
      public function getUser($id){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               SELECT name, surname, gender, country, city
               FROM user_data WHERE user_id=:u_id 
            ");
            $query->execute(array("u_id"=>$id));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User")[0];
         }catch (Exception $e){
            echo $e->getMessage();
         }
         return $result;
      }
      public function registerUser(User $user){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               INSERT INTO users (email, password)
               VALUES (:u_email,:u_password)
            ");
            $query->execute(array("u_email"=>$user->email, "u_password"=>$user->password));
         }catch(Exception $e){
            echo $e->getMessage();
         }
         try{
            $query = $this->dbManager->getConnection()->prepare("
               SELECT id FROM users
               WHERE email=:u_email AND password=:u_password
            ");
            $query->execute(array("u_email"=>$user->email, "u_password"=>$user->password));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User")[0];
            $_SESSION['id']=$result->id;
         }catch(Exception $e){
            echo $e->getMessage();
         }
         try{
            $query = $this->dbManager->getConnection()->prepare("
               INSERT INTO user_data (name, surname, gender, country, city, user_id)
               VALUES (:u_name,:u_surname,:u_gender,:u_country,:u_city,:u_id)
            ");
            $query->execute(array('u_name'=>$user->name, 'u_surname'=>$user->surname, 'u_gender'=>$user->gender, 'u_country'=>$user->country, 'u_city'=>$user->city, 'u_id'=>$_SESSION['id']));
         }catch(Exception $e){
            echo $e->getMessage();
         }   
      }
      public function searchUser($lookup){
         try {
           $query = $this->dbManager->getConnection()->prepare("
               SELECT u.email, u.id, d.name as u_name, d.surname as u_surname, d.gender as u_gender, d.country as u_country, d.city as u_city
               FROM users u LEFT OUTER JOIN user_data d ON d.user_id = u.id WHERE u.email LIKE :u_email
            ");
           $query->execute(array('u_email'=>'%'.$lookup.'%'));
           $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User");
           return $result;
         }catch(Exception $e){
            echo $e->getMessage();
         }
      }
      public function getGuest($guest_id){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               SELECT u.email, d.name as u_name, d.surname as u_surname, d.gender as u_gender, d.country as u_country, d.city as u_city 
               FROM users u LEFT OUTER JOIN user_data d ON d.user_id = u.id WHERE u.id = :u_id
            ");
            $query->execute(array("u_id"=>$guest_id));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User")[0];
         }catch (Exception $e){
            echo $e->getMessage();
         }
         return $result;
      }
      public function updateUser(User $user){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               UPDATE user_data SET name = :u_name, surname = :u_surname, gender = :u_gender, country = :u_country, city = :u_city
               WHERE user_id = :u_id
            ");
            $query->execute(array('u_name'=>$user->name, 'u_surname'=>$user->surname, 'u_gender'=>$user->gender, 'u_country'=>$user->country, 'u_city'=>$user->city, 'u_id'=>$_SESSION['id']));
         }catch(Exception $e){
            echo $e->getMessage();
         }   
      }
      public function deleteUser(){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               DELETE FROM user_data
               WHERE user_id = :u_id
            ");
            $query->execute(array('u_id'=>$_SESSION['id']));
         }catch(Exception $e){
            echo $e->getMessage();
         }
         try{
            $query = $this->dbManager->getConnection()->prepare("
               DELETE FROM users
               WHERE id = :u_id
            ");
            $query->execute(array('u_id'=>$_SESSION['id']));
         }catch(Exception $e){
            echo $e->getMessage();
         }   
      }
      public function getFollow(){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               SELECT f.user_id, f.follow_id
               FROM follows f
               WHERE f.user_id = :host_id and f.follow_id = :f_id
            ");
            $query->execute(array('host_id'=>$_SESSION['id'], 'f_id'=>$_GET['id']));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User");
            if(empty($result)){
               return "follow";
            }else{
               return "unfollow";
            }
         }catch (Exception $e){
            echo $e->getMessage();
         }
         return $result;
      }
      public function followUser(User $user){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               INSERT INTO follows (user_id, follow_id)
               VALUES (:u_id, :f_id)
            ");
            $query->execute(array('u_id'=>$_SESSION['id'], 'f_id'=>$user->id));
         }catch (Exception $e){
            echo $e->getMessage();
         }
      }
      public function unfollowUser(User $user){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               DELETE FROM follows
               WHERE user_id = :u_id AND follow_id = :f_id
            ");
            $query->execute(array('u_id'=>$_SESSION['id'], 'f_id'=>$user->id));
         }catch (Exception $e){
            echo $e->getMessage();
         }
      }
      public function getFollowers(){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               SELECT f.follow_id, f.user_id, u.email, u.id, d.name as u_name, d.surname as u_surname, d.gender as u_gender, d.country as u_country, d.city as u_city
              FROM follows f
              LEFT OUTER JOIN users u ON u.id = f.user_id
              LEFT OUTER JOIN user_data d ON d.user_id = u.id 
              WHERE f.follow_id = :f_id
            ");
            $query->execute(array('f_id'=>$_SESSION['id']));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User");
            return $result;
         }catch (Exception $e){
            echo $e->getMessage();
         }
      }
      public function getFollows(){
         try{
            $query = $this->dbManager->getConnection()->prepare("
               SELECT f.follow_id, f.user_id, u.email, u.id, d.name as u_name, d.surname as u_surname, d.gender as u_gender, d.country as u_country, d.city as u_city
              FROM follows f
              LEFT OUTER JOIN users u ON u.id = f.follow_id
              LEFT OUTER JOIN user_data d ON d.user_id = u.id 
              WHERE f.user_id = :f_id
            ");
            $query->execute(array('f_id'=>$_SESSION['id']));
            $result = $query->fetchAll(PDO::FETCH_CLASS, "models\User");
            return $result;
         }catch (Exception $e){
            echo $e->getMessage();
         }
      }
   }
?>