<?php
namespace App\Model\Parttime;
use App\Database\DbScience;
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
                date_add
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
                :date_add
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
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
            SELECT j.*,p.pay_name as pay, dr.h_email 
            FROM tb_job as j
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            LEFT JOIN tb_department_route as dr ON (dr.ro_num = j.js_id AND dr.m_email = j.m_email)
            WHERE j.j_id = {$j_id}
            ORDER BY j.date_add
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data[0];
    }
    public function getJobByEmail($m_email){
        $sql ="
            SELECT j.*,p.pay_name as pay, dr.h_email 
            FROM tb_job as j
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            LEFT JOIN tb_department_route as dr ON dr.ro_num = j.js_id
            WHERE j.m_email = '{$m_email}' AND dr.m_email = '{$m_email}'
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
            WHERE djs.sta_name = 'accept'
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
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        if($action=="count"){
            return count($data);
        }else{
            return $data;
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
}
?>