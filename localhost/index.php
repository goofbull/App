<?php

/*
 * Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)
 */

global $connect;
require_once 'config/connect.php';

/*
 * Получаем ID продукта из адресной строки - /product.php?id=1
 */

$customers_id = $_GET['id'];

/*
 * Делаем выборку строки с полученным ID выше
 */

$customers_id = mysqli_query($connect, "SELECT * FROM `Customers` WHERE `id` = '$customers_id'");

/*
 * Преобразовывем полученные данные в нормальный массив
 * Используя функцию mysqli_fetch_assoc массив будет иметь ключи равные названиям столбцов в таблице
 */

$customers_id = mysqli_fetch_assoc($customers_id);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers</title>
</head>
<style>
    th, td {
        padding: 10px;
    }

    th {
        background: #606060;
        color: #fff;
    }

    td {
        background: #b5b5b5;
    }
</style>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>customerName</th>
            <th>position</th>
            <th>birthDate</th>
            <th>gender</th>
            <th>emailAddress</th>
        </tr>

        <?php

            /*
             * Делаем выборку всех строк из таблицы "customers"
             */

            $customers = mysqli_query($connect, "SELECT * FROM `customers`");
            $email = mysqli_query($connect, "SELECT * FROM `email`");
            $emailsender = mysqli_query($connect, "SELECT * FROM `emailsender`");
            /*
             * Преобразовываем полученные данные в нормальный массив
             */

        $customers = mysqli_fetch_all($customers);
        $email = mysqli_fetch_all($email);
        $emailsender = mysqli_fetch_all($emailsender);


            /*
             * Перебираем массив и рендерим HTML с данными из массива
             * Ключ 0 - id
             * Ключ 1 - customerName
             * Ключ 2 - position
             * Ключ 3 - birthDate
             * Ключ 4 - gender
             * Ключ 5 - emailAddress
             */

            foreach ($customers as $customers) {
                ?>
                    <tr>
                        <td><?= $customers[0] ?></td>
                        <td><?= $customers[1] ?></td>
                        <td><?= $customers[2] ?></td>
                        <td><?= $customers[3] ?>$</td>
                        <td><?= $customers[4] ?>$</td>
                        <td><?= $customers[5] ?>$</td>
                <?php
            }
            ?>

        <tr>
            <th>emailID</th>
            <th>title</th>
            <th>message</th>
        </tr>
        <?php
        foreach ($email as $email) {
        ?>
        <tr>
            <td><?= $email[0] ?></td>
            <td><?= $email[1] ?></td>
            <td><?= $email[2] ?></td>
            <?php
            }
            ?>

        <tr>
            <th>EmailSenderID</th>
            <th>emailID</th>
            <th>customerID</th>
            <th>emailAddress</th>
            <th>status</th>
            <th>message</th>
        </tr>
        <?php
        foreach ($emailsender as $emailsender) {
        ?>
        <tr>
            <td><?= $emailsender[0] ?></td>
            <td><?= $emailsender[1] ?></td>
            <td><?= $emailsender[2] ?></td>
            <td><?= $emailsender[3] ?></td>
            <td><?= $emailsender[4] ?></td>
            <td><?= $emailsender[5] ?></td>
            <?php
            }
            ?>
</body>
</html>