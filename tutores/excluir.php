
<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../config/auth.php';
exigirLogin();

$id=(int)($_GET['id']??0);

$s=$pdo->prepare("SELECT COUNT(*) FROM animais WHERE tutor_id=?");
$s->execute([$id]);

if($s->fetchColumn()>0){
    echo "<script>
        alert('Não é possível excluir tutores que possuem animais cadastrados.');
        window.location.href='index.php';
    </script>";
    exit;
}

$s=$pdo->prepare("DELETE FROM tutores WHERE id=?");
$s->execute([$id]);

header('Location: index.php');
exit;
