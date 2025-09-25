<?php
require_once __DIR__ . '/../src/User.php';
require_once __DIR__ . '/../src/UserManager.php';

$manager = new UserManager();

echo "<h2>Casos de Uso</h2>";

function mostrarResultado($caso, $esperado, $obtido) {
    echo "<h3>$caso</h3>";
    echo "Esperado → $esperado <br>";
    echo "Obtido → $obtido <br><br>";
}

$result = $manager->register("Maria Oliveira", "maria@email.com", "Senha123");
mostrarResultado("Caso 1 — Cadastro válido", "Usuário cadastrado com sucesso", $result === true ? "Usuário cadastrado com sucesso" : $result);

$result = $manager->register("Pedro", "pedro@email", "Senha123");
mostrarResultado("Caso 2 — Cadastro com e-mail inválido", "E-mail inválido", $result);

$login = $manager->login("joao@email.com", "SenhaErrada123");
mostrarResultado("Caso 3 — Tentativa de login com senha errada", "Credenciais inválidas", $login);

$reset = $manager->resetPassword(1, "NovaSenha123");
mostrarResultado("Caso 4 — Reset de senha válido", "Senha alterada com sucesso", $reset === true ? "Senha alterada com sucesso" : $reset);

$manager->register("Maria Oliveira", "duplicado@email.com", "Senha123");
$result = $manager->register("Outro Usuário", "duplicado@email.com", "Senha123");
mostrarResultado("Caso 5 — Cadastro com e-mail duplicado", "E-mail já está em uso", $result);
