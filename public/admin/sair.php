<?php
require __DIR__ . '/../../src/bootstrap.php';

$auth->sair();
flash('sucesso', 'Você saiu do painel. Até logo!');
redirecionar('/admin/login.php');
