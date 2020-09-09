<?php
// получаем соединение с базой данных
include_once 'config/database.php';

// создание объекта товара
include_once 'models/contacts.php';

$database = new Database();
$db = $database->getConnection();


$contact = new Contact($db);
$temp = array();

// получаем отправленные данные
$data = json_decode(file_get_contents("php://input"));
$date = date('Y-m-d');
$where = " AND date != ".$date;

// убеждаемся, что данные не пусты
if (!empty($data->source_id)) {

    foreach ($data->items as $k => $v) {
        if (
            !empty($v->name) &&
            !empty($v->phone) &&
            !empty($v->email)
        ) {
            $phone = preg_replace('/[+7]|[7]/','',strval($v->phone));;
            $check = $contact->read($phone,$where);
            $num = $check->rowCount();
            if ($num == 1) {
                continue;
            }
                // устанавливаем значения свойств товара
                $temp[$k]['name'] = $v->name;
                $temp[$k]['phone'] = $phone;
                $temp[$k]['email'] = $v->email;
                $temp[$k]['source_id'] = $data->source_id;
                $temp[$k]['date'] = $date;

        }
    }

    // создание товара
    if ($contact->create($temp)) {

        // установим код ответа - 201 создано
        http_response_code(201);

        // сообщим пользователю
        echo '<div class="alert alert-success mt-2 ml-2 mr-2">
                    Данные отправлены!
                </div>';
    } // если не удается создать контакт, сообщим пользователю
    else {
        // установим код ответа - 503 сервис недоступен
        http_response_code(503);
    }
} // сообщим пользователю что данные неполные
else {

    // установим код ответа - 400 неверный запрос
    http_response_code(400);

    // сообщим пользователю
    echo '<div class="alert alert-danger mt-2 ml-2 mr-2">
                    Невозможно создать контакт. Данные неполные
                </div>';
}
?>