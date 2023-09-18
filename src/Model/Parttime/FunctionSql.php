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
    public function getJobAll(){
        $sql ="
            SELECT j.*,p.pay_name as pay, dr.h_email 
            FROM tb_job as j
            LEFT JOIN tb_pay as p ON p.pay_id = j.pay_id
            LEFT JOIN tb_department_route as dr ON dr.ro_num = j.js_id
            ORDER BY j.date_add
        ";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();
        return $data;
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
}
?>