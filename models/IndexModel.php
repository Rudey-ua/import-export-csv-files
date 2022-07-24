<?php

class IndexModel extends Model {

    public function getAllUsers() {
        $result = array();
        $sql = "SELECT * FROM `users`";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['UID']] = $row;
        }
        return $result;
    }

    public function delete()
    {
        $sql = "TRUNCATE TABLE `users`";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        header("Location: /");
    }
    
    public function addFromCSV($data) {

        $connect = db::connToDB();

        $sth = $connect->query("SELECT * FROM `users` WHERE `UID` = $data[0]");
        $result = $sth->fetchColumn();

        if(!isset($data[1], $data[2], $data[3], $data[4], $data[5]))
        {
            echo "WRONG DATA" . "<br>";
            echo "<a href='/'>Back</a>";
            die();
        }

        if(!empty($result))
        {
            $sql = "UPDATE `users` SET `name` = :name, `age` = :age, `email` = :email, `phone` = :phone, `gender` = :gender WHERE `UID` = :UID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":name", $data[1]);
            $stmt->bindValue(":age", $data[2]);
            $stmt->bindValue(":email", $data[3]);
            $stmt->bindValue(":phone", $data[4]);
            $stmt->bindValue(":gender", $data[5]);
            $stmt->bindValue(":UID", $data[0]);
            $stmt->execute();
        } else
        {
            $sql = "INSERT INTO users(name, age, email, phone, gender) VALUES(:name, :age, :email, :phone, :gender)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":name", $data[1]);
            $stmt->bindValue(":age", $data[2]);
            $stmt->bindValue(":email", $data[3]);
            $stmt->bindValue(":phone", $data[4]);
            $stmt->bindValue(":gender", $data[5]);
            $stmt->execute();
        }
    }
}
