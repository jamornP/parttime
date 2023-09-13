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
}
?>