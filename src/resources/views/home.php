<?php /** @var string $title */ ?>
<?php /** @var object $users */ ?>
<?php $this->layout('layout', ['title' => $title]) ?>

<h2>home</h2>
<ul>
    <?php foreach($users->items as $user): ?>
        <li><?= $user->firstName; ?></li>
    <?php endforeach; ?>
</ul>

<?= $users->paginate->simpleLinks(); ?>

<?=  flash('status'); ?>

<form action="/user" method="post">
    <?= csrf() ?>
    <?= method('DELETE') ?>

    <input type="text" placeholder="user id" name="user">
    <?=  flash('user'); ?>
    
    <button type="submit">deletar</button>
</form>