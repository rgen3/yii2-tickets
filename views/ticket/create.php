<?php

use yii\helpers\Html;

?>

<div class="row stat-row">
    <h2>Новых сообщений: 0</h2>
    <h1 class="page-header">Создать тикет</h1>
    <div class="row">
        <form method="post" action="/partner/message/add">
            <div class="col-lg-12 form-group">
                <label>Тема сообщения</label>
                <input class="form-control" name="title" />
                <label>Текст сообщения</label>
                <textarea class="form-control" rows="5" name="message"></textarea>
            </div>
            <div class="col-lg-12 form-group">
                <button type="submit" class="btn btn-success">Создать</button>
                <label>Статус(СРОЧНО): </label> <input type="checkbox" name="user_status" value="1">
            </div>
        </form>
    </div>
</div>
