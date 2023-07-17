<?php
namespace App\Model\Parttime;
use App\Database\DbScience;
class Auth extends DbScience {
    public function checkUser($email) {
        $sql = "
            SELECT * 
            FROM tb_students
            WHERE stu_email ='{$email}'  
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        if(count($data)>0){
            $dataU['status']="student";
            $dataU['login']=true;
            return $dataU;
        }else{
            $sql = "
                SELECT * 
                FROM tb_staff
                WHERE st_email ='{$email}'  
            ";
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll();
            if(count($data)>0){
                $dataU['status']="staff";
                $dataU['login']=true;
                return $dataU;
            }
        }
    }

}
