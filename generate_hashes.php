<?php
// Generación de Hashes de Contraseña para Usuarios

$password_admin = 'nueva_contraseña_admin';
$password_special = 'nueva_contraseña_special';
$password_user = 'nueva_contraseña_user';

$hash_admin = password_hash($password_admin, PASSWORD_DEFAULT);
$hash_special = password_hash($password_special, PASSWORD_DEFAULT);
$hash_user = password_hash($password_user, PASSWORD_DEFAULT);

echo "Hash Admin: $hash_admin\n";
echo "Hash Special: $hash_special\n";
echo "Hash User: $hash_user\n";
?>
