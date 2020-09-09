<?php


class Contact {

    // подключение к базе данных и таблице 'contacts'
    private $conn;
    private $table_name = "contacts";

    // свойства объекта
    public $id;
    public $name;
    public $phone;
    public $email;
    public $source_id;
    public $date;

    // конструктор для соединения с базой данных
    public function __construct($db){
        $this->conn = $db;
    }

    // метод read() - получение контактов
    function read($phone,$where = ''){

        // выбираем запись
        $query = "SELECT
                *
                FROM
                    " . $this->table_name . " 
                   WHERE phone = ".$phone.' '.$where;

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }
    // метод create - создание контактов
    function create($temp){

        if($this->conn->inTransaction()) {
            echo "Транзакция уже начата";
            return false;
        }
        $this->conn->beginTransaction();//Начинаем транзакцию

        foreach ($temp as $key=>$val){

            // запрос для вставки (создания) записей
            $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, phone=:phone, email=:email, source_id=:source_id, date=:date";

            // подготовка запроса
            $stmt = $this->conn->prepare($query);
            // очистка
            $this->name=htmlspecialchars(strip_tags($val['name']));
            $this->phone=htmlspecialchars(strip_tags($val['phone']));
            $this->email=htmlspecialchars(strip_tags($val['email']));
            $this->source_id=htmlspecialchars(strip_tags($val['source_id']));
            $this->date=htmlspecialchars(strip_tags($val['date']));

            // привязка значений
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":source_id", $this->source_id);
            $stmt->bindParam(":date", $this->date);
            $stmt->execute();
        }
        $check = $this->conn->commit();
        if($check)
            return true;
        else
            return false;
    }

}
?>