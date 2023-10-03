<?php

namespace App\Model\Parttime;
use App\Database\DbScience;
class Auth extends DbScience {
    public function checkUserGoogle($email,$img) {
        $sql = "
            SELECT st.*,m.*,p.p_name as position
            FROM tb_member as m 
            LEFT JOIN tb_staff as st ON st.email = m.m_email
            LEFT JOIN tb_position as p ON p.p_id = st.p_id 
            WHERE m.m_email ='{$email}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        if(count($data)>0){
            
            $_SESSION['login_parttime'] = true;
            $_SESSION['fullname']=$data[0]['title'].$data[0]['name']." ".$data[0]['surname'];
            $_SESSION['s_id']=$data[0]['s_id'];
            $_SESSION['m_email']=$data[0]['m_email'];
            $_SESSION['img']=$img;
            $_SESSION['d_id']=$data[0]['d_id'];
            $_SESSION['role']=$data[0]['role'];
            return true;
        }else{
            return false;
        }
    }
    public function checkUserGoogleStudent($email,$img) {
        $sql = "
            SELECT * 
            FROM tb_students  
            WHERE stu_email ='{$email}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        if(count($data)>0){
            
            $_SESSION['login_parttime'] = true;
            $_SESSION['fullname']=$data[0]['stu_fullname'];
            $_SESSION['stu_id']=$data[0]['stu_id'];
            $_SESSION['stu_email']=$data[0]['stu_email'];
            $_SESSION['img']=$img;
            $_SESSION['role']="student";
            return true;
        }else{
            return false;
        }
    }
    public function ChangePass($user){
        $user['password'] = password_hash($user['password'],PASSWORD_DEFAULT);
        $sql = "
            UPDATE tb_member SET password = :password WHERE m_email = :m_email
        ";
        $stmt = $this->pdo->prepare($sql);
        $ck=$stmt->execute($user);
        if($ck){
            return true;
        }else{
            return false;
        }
    }
    public function ChangePassStudent($user){
        $user['password'] = password_hash($user['password'],PASSWORD_DEFAULT);
        $sql = "
            UPDATE tb_students SET password = :password WHERE stu_email = :stu_email
        ";
        $stmt = $this->pdo->prepare($sql);
        $ck=$stmt->execute($user);
        if($ck){
            return true;
        }else{
            return false;
        }
    }
    public function checkUser($user){
        $sql = "
            SELECT st.*,m.*,p.p_name as position
            FROM tb_member as m 
            LEFT JOIN tb_staff as st ON st.email = m.m_email
            LEFT JOIN tb_position as p ON p.p_id = st.p_id 
            WHERE m.m_email = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user['m_email']]);
        $data = $stmt->fetchAll();
        if(count($data)>0){
            $userDB = $data[0];
            if(password_verify($user['password'],$userDB['password'])) {
                
                $_SESSION['login_parttime'] = true;
                $_SESSION['fullname']=$userDB['title'].$userDB['name']." ".$userDB['surname'];
                $_SESSION['s_id']=$userDB['s_id'];
                $_SESSION['m_email']=$userDB['m_email'];
                $_SESSION['img']="/parttime/backend/images/logo/user.png";
                $_SESSION['d_id']=$userDB['d_id'];
                $_SESSION['role']=$userDB['role'];

                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public function checkUserStudent($user){
        $sql = "
        SELECT
            *
        FROM
            tb_students
        WHERE
            stu_email = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user['stu_email']]);
        $data = $stmt->fetchAll();
        if(count($data)>0){
            $userDB = $data[0];
            if(password_verify($user['password'],$userDB['password'])) {
                
                $_SESSION['login_parttime'] = true;
                $_SESSION['fullname']=$userDB['stu_fullname'];
                $_SESSION['stu_id']=$userDB['stu_id'];
                $_SESSION['stu_email']=$userDB['stu_email'];
                $_SESSION['img']="/parttime/backend/images/logo/user.png";
                $_SESSION['role']="student";
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }

        
    }

}
