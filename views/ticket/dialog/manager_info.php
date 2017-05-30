<?php

use yii\helpers\Html;

?>
<div class="list-group-item open-request">
    <?php if ($receiver): ?>
    <p><?= Yii::t('app',
            'Name: {username}',
            [
                'username' => $receiver->first_name,
            ]
        );
        ?></p>
    <p><?= Yii::t('app',
            'Email: {email}',
            [
                'email' => $receiver->email,
            ]
        );
        ?>
    </p>
<?php endif; ?>
</div>