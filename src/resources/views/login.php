<?php /** @var string $title */ ?>
<?php $this->layout('layout', ['title' => $title]) ?>

<h2>Login</h2>

<form action="/login" method="post">
    <input type="text" placeholder="your email" name="email">
    <input type="text" placeholder="your password" name="password">
    <button type="submit">Login</button>
</form>