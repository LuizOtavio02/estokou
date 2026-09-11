<?php /** @var string $title */ ?>
<?php $this->layout('layout', ['title' => $title]) ?>

<h2>Login</h2>

<?=  flash('status'); ?>

<form action="/login" method="post">
    <?= csrf() ?>
    <input type="text" placeholder="your email" name="email">
    <?=  flash('email'); ?>
    <input type="text" placeholder="your password" name="password">
    <?=  flash('password'); ?>
    <button type="submit">Login</button>
</form>