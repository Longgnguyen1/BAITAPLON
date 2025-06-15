<?php
class Database
{
    private $conn;
    function __construct()
    {
        $this->conn = SqlConnection::getConnection();
    }
    public function query($sql)
    {
        //var_dump($this->conn);
        $statement = $this->conn->prepare($sql);
        //echo $sql;
        $statement->execute();
        return $statement;
    }

    public function select($colArr =[], $table, $condition)
    {
        if (empty($colArr)) $colStr='*';

        else
        {
            $colStr = implode(', ', $colArr);
        }
        $sql = "select $colStr from $table $condition";
        // echo $sql;
        $ret = $this->query($sql);
        return $ret->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($table, $condition)
    {
        if (!empty($condition))
            $sql = "delete from $table $condition";
        else $sql = "delete from $table";
        $statement = $this->query($sql);
        if ($statement) return true;
        return false;
    }

    public function insert($table, $insertData)
    {
        foreach ($insertData as $key => $value) {
            $insertData[$key] = "'$value'";
        }
        $keys = array_keys($insertData);
        $values = array_values($insertData);
        $cols = implode(",", $keys);
        $values = implode(',', $values);
        //echo $values;
        $sql = "insert into $table ($cols) values ($values)";
        $ret = $this->query($sql);
        return $ret;
    }

    public function update($table, $editData, $condition)
    {
        $editStr = '';
        foreach ($editData as $key => $value) {
            $editStr .= "$key = '$value', ";
        }
        $editStr = rtrim($editStr, ', ');
        $sql = "update $table set $editStr $condition";
        //echo $sql;
        $ret = $this->query($sql);
        return $ret;
    }

    public function isDuplicate($table, $col, $value)
    {
        $value = "'$value'";
        $sql = "SELECT * FROM $table WHERE $col = $value";
        //echo $sql;
        $ret = $this->query($sql);
        return $ret->rowCount() > 0;
    }

    public function checkLogin($username, $password)
    {
        $condition = "WHERE tentk = '$username' AND matkhau = '$password'";
        $result = $this->select(['tentk','matkhau'], 'taikhoan', $condition);

        if (!empty($result)) {
            return $result[0];
        }
        return false;
    }

    public function getNhanSuByTaiKhoan($username, $password) {
        $sql = "SELECT 
                    hsnhansu.Manv, 
                    hsnhansu.Tennv, 
                    hsnhansu.Sodt, 
                    hsnhansu.Email, 
                    hsnhansu.Diachi, 
                    hsnhansu.Chucvu, 
                    hsnhansu.Hocvi 
                FROM 
                    hsnhansu 
                JOIN 
                    taikhoan 
                ON 
                    hsnhansu.Manv = taikhoan.Manv 
                WHERE 
                    taikhoan.tentk = :username AND taikhoan.matkhau = :password";
                    
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getLichsuByTaikhoan($username, $password) {
        $sql = "SELECT 
                    lichsucongtac.Manv, 
                    lichsucongtac.Noilamviec, 
                    lichsucongtac.Vitricongtac, 
                    lichsucongtac.Ngaybatdaulam, 
                    lichsucongtac.Hopdonglaodong, 
                    lichsucongtac.Hocvi, 
                    lichsucongtac.Ngayketthuclam 
                FROM 
                    lichsucongtac 
                JOIN 
                    taikhoan 
                ON 
                    lichsucongtac.Manv = taikhoan.Manv 
                WHERE 
                    taikhoan.tentk = :username AND taikhoan.matkhau = :password";
                    
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    
}
