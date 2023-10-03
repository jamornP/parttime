<?php
namespace App\Model\Parttime;
use App\Database\DbScience;
use PDOException;

class FunctionSql extends DbScience {
// tb_pay
    public function getPayAll(){
        $sql ="
            SELECT * FROM tb_pay
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
//  tb_job
    public function addJob($data){
        try {
        $sql = "
            INSERT INTO tb_job (
                j_name,
                j_detail,
                j_s_date,
                j_e_date,
                j_time_work,
                j_location,
                regis_s_date,
                regis_e_date,
                interview_date,
                announcement_date,
                pay_id,
                count_student,
                st_name,
                st_tel,
                st_email,
                st_line,
                m_email,
                js_id,
                date_add,
                status
            ) VALUES (
                :j_name,
                :j_detail,
                :j_s_date,
                :j_e_date,
                :j_time_work,
                :j_location,
                :regis_s_date,
                :regis_e_date,
                :interview_date,
                :announcement_date,
                :pay_id,
                :count_student,
                :st_name,
                :st_tel,
                :st_email,
                :st_line,
                :m_email,
                :js_id,
                :date_add,
                :status
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }
    public function updateJob($data){
        try{
        $sql="
        UPDATE 
            tb_job 
        SET 
            j_name=:j_name,
            j_detail=:j_detail,
            j_s_date=:j_s_date,
            j_e_date=:j_e_date,
            j_time_work=:j_time_work,
            j_location=:j_location,
            regis_s_date=:regis_s_date,
            regis_e_date=:regis_e_date,
            interview_date=:interview_date,
            announcement_date=:announcement_date,
            pay_id=:pay_id,
            count_student=:count_student,
            st_name=:st_name,
            st_tel=:st_tel,
            st_email=:st_email,
            st_line=:st_line,
            m_email=:m_email,
            js_id=:js_id,
            date_add=:date_add,
            status=:status 
        WHERE
            j_id=:j_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
        }catch(PDOException $e) {
            return $e->getMessage();
        }
    }
    public function updateJobStatus($data){
        $sql = "
            UPDATE tb_job 
            SET js_id = :js_id
            WHERE j_id = :j_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
    }
    public function updateStatus($j_id,$data){
        $sql = "
            UPDATE tb_job 
            SET status = '{$data}'
            WHERE j_id = {$j_id}
        ";
        $stmt = $this->pdo->query($sql);
        if($stmt){
            return true;
        }else{
            return false;
        }
        
    }
    public function getJobAll(){
        $sql ="
            SELECT j.*,p.pay_name as pay, dr.h_email 
            FROM tb_job as j
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            LEFT JOIN tb_department_route as dr ON (dr.ro_num = j.js_id AND dr.m_email = j.m_email)
            ORDER BY j.date_add
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getJobById($j_id){
        $sql ="
            SELECT j.*,p.pay_name as pay, dr.h_email,s.name,s.surname 
            FROM tb_job as j
            LEFT JOIN  tb_staff as s ON s.email = j.m_email
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            LEFT JOIN tb_department_route as dr ON (dr.ro_num = j.js_id AND dr.m_email = j.m_email)
            WHERE j.j_id = {$j_id}
            ORDER BY j.date_add
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data[0];
    }
    //LEFT JOIN tb_department_route as dr ON dr.ro_num = j.js_id
    // WHERE j.m_email = '{$m_email}' AND dr.m_email = '{$m_email}'
    public function getJobByEmail($m_email){
        $sql ="
            SELECT j.*,p.pay_name as pay 
            FROM tb_job as j
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            WHERE j.m_email = '{$m_email}' 
            ORDER BY j.date_add
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getJobByHEmail($h_email){
        $sql = "
            SELECT j.*,p.pay_name as pay, dr.h_email 
            FROM tb_department_route as dr
            RIGHT JOIN tb_job as j ON (j.m_email = dr.m_email AND j.js_id = dr.ro_num)
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            WHERE dr.h_email = '{$h_email}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getJobAccept(){
        $sql = "
            SELECT j.*,p.pay_name as pay
            FROM tb_data_job_status as djs
            LEFT join tb_job as j on j.j_id = djs.j_id 
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            WHERE djs.sta_name = 'อนุมัติ'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
// tb_department_route
    public function getRoute() {
        $sql = "
            SELECT dr.*,wu.wu_name ,s.name_EN 
            FROM tb_department_route as dr
            LEFT JOIN tb_work_unit as wu ON wu.wu_id = dr.wu_id
            LEFT JOIN tb_staff as s ON s.email = dr.h_email
            ORDER BY dr.wu_id,dr.ro_num
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function addRoute($data){
        $sql = "
            INSERT INTO tb_department_route(
                m_email,
                ro_num,
                h_email,
                wu_id
            ) VALUES (
                :m_email,
                :ro_num,
                :h_email,
                :wu_id
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
    public function delDeRouteById($id){
        $sql = "
            DELETE FROM tb_department_route
            WHERE dero_id = {$id}
        ";
        $stmt = $this->pdo->query($sql);
        if($stmt){
            return true;
        }else{
            return false;
        }
    }
    public function getRoNumByMHemail($m_email,$h_email){
        $sql="
            SELECT *
            FROM tb_department_route
            WHERE m_email = '{$m_email}' AND h_email = '{$h_email}' 
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        if(count($data)>0){
            return $data[0]['ro_num'];
        }else{
            return 0;
        }
        
    }
    public function getEmailByMEmailRo($m_email,$ro_num){
        $sql ="
            SELECT dr.*,s.name,s.surname 
            FROM tb_department_route as dr
            LEFT JOIN tb_staff as s ON s.email = dr.h_email
            WHERE m_email = '{$m_email}' AND ro_num = {$ro_num}
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data[0];
    }
// tb_work_unit
    public function getWorkUnit(){
        $sql = "
            SELECT *
            FROM tb_work_unit
            ORDER BY wu_name
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getWorkUnitByName($name){
        $sql = "
            SELECT *
            FROM tb_work_unit
            WHERE wu_name = '{$name}'
            ORDER BY wu_name
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
// tb_staff
    public function getStaffAll(){
        $sql = "
            SELECT *
            FROM tb_staff
            ORDER BY title,name,surname
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
//  tb_data_job_status
    public function addDataJobSta($data){
        $sql ="
            INSERT INTO tb_data_job_status(
                num,
                j_id,
                sta_name,
                j_sta_date,
                m_email,
                remark
            ) VALUES (
                :num,
                :j_id,
                :sta_name,
                :j_sta_date,
                :m_email,
                :remark
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
    public function getCountDataJobStaById($action,$j_id){
        $sql ="
            SELECT djs.*,s.title,s.name,s.surname
            FROM tb_data_job_status as djs
            LEFT JOIN tb_staff as s ON s.email = djs.m_email
            WHERE j_id = {$j_id}
            ORDER BY djs.num
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        if($action=="count"){
            return count($data);
        }else{
            return $data;
        }
        
    }
    public function countDataJobStaByIdNum($data){
        $sql ="
            SELECT *
            FROM tb_data_job_status
            WHERE j_id = :j_id AND num = :num
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $data = $stmt->fetchAll();
        if(count($data)>0){
            return true;
        }else{
            return false;
        }
    }
    public function delDJSById($j_id){
        $sql = "
            DELETE 
            FROM tb_data_job_status 
            WHERE j_id = {$j_id} 
        ";
        $stmt = $this->pdo->query($sql);
        if($stmt){
            return true;
        }else{
            return false;
        }
    }
// tb_department
    public function getDepartmentAll(){
        $sql = "
            SELECT *
            FROM tb_department
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
// tb_member
    public function addMember($data){
        $sql = "
            INSERT INTO tb_member(
                m_email,
                role,
                d_id,
                wu_id
            ) VALUES (
                :m_email,
                :role,
                :d_id,
                :wu_id
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
    public function getMemberByRole($role){
        $sql = "
            SELECT m.*,d.d_name,wu.wu_name,s.title,s.name,s.surname
            FROM tb_member as m
            LEFT JOIN tb_department as d ON d.d_id = m.d_id
            LEFT JOIN tb_work_unit as wu ON wu.wu_id = m.wu_id
            LEFT JOIN tb_staff as s ON s.email = m.m_email
            WHERE m.role = '{$role}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getMemberByWu($wu_id){
        $sql = "
            SELECT m.*,d.d_name,wu.wu_name,s.title,s.name,s.surname
            FROM tb_member as m
            LEFT JOIN tb_department as d ON d.d_id = m.d_id
            LEFT JOIN tb_work_unit as wu ON wu.wu_id = m.wu_id
            LEFT JOIN tb_staff as s ON s.email = m.m_email
            WHERE m.wu_id = '{$wu_id}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function delMemberById($id){
        $sql ="
            DELETE FROM tb_member
            WHERE id = {$id}
        ";
        $stmt = $this->pdo->query($sql);
        if($stmt){
            return true;
        }else{
            return false;
        }
    }
// tb_register
    public function addRegister($data){
        $sql = "
            INSERT INTO tb_register(
                j_id,
                stu_email,
                stu_id,
                stu_fullname,
                stu_class,
                stu_sub_department,
                stu_department,
                stu_tel,
                stu_line,
                re_date,
                re_status
            ) VALUES (
                :j_id,
                :stu_email,
                :stu_id,
                :stu_name,
                :stu_class,
                :stu_sub_department,
                :stu_department,
                :stu_tel,
                :stu_line,
                :re_date,
                :re_status
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
    public function updateStatusRegis($data){
        $sql = "
            UPDATE tb_register
            SET re_status = :re_status
            WHERE re_id = :re_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
    }
    public function countStuRegisByJId($j_id){
        $sql = "
            SELECT * 
            FROM tb_register
            WHERE j_id = '{$j_id}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        if($data){
            return count($data);
        }else{
            return 0;
        }
    }
    public function countRegisByJidStu($data){
        $sql = "
            SELECT *
            FROM tb_register
            WHERE j_id = :j_id AND stu_email = :stu_email
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $data = $stmt->fetchAll();
        if($data){
            return count($data);
        }else{
            return 0;
        }
    }
    public function getRegisByJid($j_id){
        $sql = "
            SELECT *
            FROM tb_register
            WHERE j_id = {$j_id}
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getRegisByJidSt($j_id){
        $sql = "
            SELECT *
            FROM tb_register
            WHERE j_id = {$j_id} AND re_status = 'accept'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getRegisByJidStu($j_id,$stu_email){
        $sql = "
            SELECT *
            FROM tb_register as re
            LEFT JOIN tb_job as j ON j.j_id = re.j_id
            WHERE re.stu_email = '{$stu_email}' AND j.j_id = {$j_id}
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getJobByStu($stu_id){
        $sql = "
            SELECT re.*,j.j_s_date,j.j_e_date,j.j_name
            FROM tb_register as re
            LEFT JOIN tb_job as j ON j.j_id = re.j_id
            WHERE re.stu_id = '{$stu_id}' 
            ORDER BY j.j_s_date
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function countStuRe($stu_id){
        $sql = "
            SELECT *
            FROM tb_register
            WHERE stu_id = '{$stu_id}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return count($data);
    }
    public function countStuReAccept($stu_id){
        $sql = "
            SELECT *
            FROM tb_register
            WHERE stu_id = '{$stu_id}' AND re_status = 'accept'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return count($data);
    }
    public function countStuReDate($stu_id){
        $date = date("Y-m-d");
        $sql = "
            SELECT *
            FROM tb_register as re
            LEFT JOIN tb_job as j ON j.j_id = re.j_id
            WHERE re.stu_id = '{$stu_id}' AND j.announcement_date > '{$date}' AND re.re_status = 'register'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return count($data);
    }
// tb_student
    public function getSudentAll(){
        $sql = "
            SELECT *
            FROM tb_students
            ORDER BY stu_fullname
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getStuByEmail($email){
        $sql = "
            SELECT *
            FROM tb_students
            WHERE stu_email = '{$email}'
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data[0];
    }
}
?>