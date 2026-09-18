<?php /** @var string $title */ ?>
<?php $this->layout('layout', ['title' => $title]) ?>

<h2>home</h2>
<?=  flash('status'); ?>

<form action="/user" method="post">
    <?= csrf() ?>
    <?= method('DELETE') ?>

    <input type="text" placeholder="user id" name="user">
    <?=  flash('user'); ?>
    
    <button type="submit">deletar</button>
</form>