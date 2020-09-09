<?php

// подключение базы данных и файл, содержащий объекты
include_once 'config/database.php';
include_once 'models/contacts.php';


// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$contact = new Contact($db);
$phone = html_entity_decode($_GET['phone']);

// запрашиваем контакты
$stmt = $contact->read($phone);
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей
if ($num>0) {

    // массив товаров
    $contacts_arr=array();
    $contacts_arr["contact"]=array();

    // получаем содержимое нашей таблицы
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку
        extract($row);

        $contact_item=array(
            "id" => $id,
            "name" => html_entity_decode($name),
            "phone" => $phone,
            "email" => html_entity_decode($email),
            "source_id" => $source_id,
            "date" => $date
        );

        array_push($contacts_arr["contact"], $contact_item);
    }

    // устанавливаем код ответа - 200 OK
    http_response_code(200);

    // выводим данные о товаре в формате JSON
    echo '<pre><div class="alert alert-success mt-2 ml-2 mr-2 col-md-5">';
    print_r($contacts_arr);
    echo '</pre></div>';

}

else {

    // установим код ответа - 404 Не найдено
    http_response_code(404);

    // сообщаем пользователю, что контакт не найден
    echo '<div class="alert alert-danger mt-2 ml-2 mr-2">
                    Контакт не найден
                </div>';
}