<?php

declare(strict_types=1);

require __DIR__ . '/config.php';

$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo instanceof PDO) {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));

    if ($name === '') {
        $errors[] = 'El nombre es obligatorio.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Ingresa un correo válido.';
    }

    if ($message === '') {
        $errors[] = 'El mensaje no puede estar vacío.';
    }

    if ($errors === []) {
        $statement = $pdo->prepare('INSERT INTO leads (name, email, message) VALUES (?, ?, ?)');
        $statement->execute([$name, $email, $message]);
        $successMessage = 'Gracias por tu mensaje. Te contactaremos pronto.';
    }
}

$systems = [];
if ($pdo instanceof PDO) {
    $systems = $pdo->query('SELECT title, summary, stack, project_url FROM systems ORDER BY id DESC LIMIT 6')->fetchAll();
} else {
    $systems = [
        [
            'title' => 'Demo: Sistema de Ventas',
            'summary' => 'Ejemplo visual mostrado mientras configuras la base de datos.',
            'stack' => 'PHP + MySQL',
            'project_url' => null,
        ],
    ];
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tu Nombre | Sistemas a medida</title>
    <meta name="description" content="Desarrollo de sistemas propios en PHP y MySQL para tu negocio.">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="hero">
    <nav>
        <strong>TuEmprendimiento.dev</strong>
        <a href="#sistemas">Sistemas</a>
        <a href="#servicios">Servicios</a>
        <a href="#contacto">Contacto</a>
    </nav>
    <section class="hero-content">
        <h1>Páginas web y sistemas propios en PHP + MySQL</h1>
        <p>Plantilla moderna inspirada en páginas de portafolio profesionales para vender tus servicios.</p>
        <a class="btn" href="#contacto">Solicitar propuesta</a>
    </section>
</header>

<main>
    <section id="servicios" class="container cards">
        <article>
            <h2>Desarrollo a medida</h2>
            <p>Construcción de paneles de administración, CRM, inventarios y reservas con arquitectura limpia.</p>
        </article>
        <article>
            <h2>Integraciones</h2>
            <p>Conexión con pasarelas de pago, WhatsApp, email marketing y automatizaciones para ventas.</p>
        </article>
        <article>
            <h2>Mantenimiento</h2>
            <p>Soporte técnico, mejoras continuas y seguridad para que tu sistema funcione siempre.</p>
        </article>
    </section>

    <section id="sistemas" class="container systems">
        <h2>Sistemas destacados</h2>
        <?php if ($systems === []): ?>
            <p>Aún no hay sistemas cargados. Inserta registros en la tabla <code>systems</code>.</p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($systems as $system): ?>
                    <article class="system-card">
                        <h3><?= htmlspecialchars($system['title']) ?></h3>
                        <p><?= htmlspecialchars($system['summary']) ?></p>
                        <small><?= htmlspecialchars($system['stack']) ?></small>
                        <?php if ($system['project_url']): ?>
                            <a target="_blank" rel="noreferrer" href="<?= htmlspecialchars($system['project_url']) ?>">Ver proyecto</a>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <section id="contacto" class="container contact">
        <?php if ($dbError !== ''): ?>
            <div class="alert error"><p><?= htmlspecialchars($dbError) ?></p></div>
        <?php endif; ?>
        <h2>Conversemos sobre tu sistema</h2>

        <?php if ($errors !== []): ?>
            <div class="alert error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($successMessage !== ''): ?>
            <div class="alert success">
                <p><?= htmlspecialchars($successMessage) ?></p>
            </div>
        <?php endif; ?>

        <form method="post">
            <label>Nombre
                <input type="text" name="name" required>
            </label>
            <label>Email
                <input type="email" name="email" required>
            </label>
            <label>Cuéntame qué necesitas
                <textarea name="message" rows="5" required></textarea>
            </label>
            <button class="btn" type="submit" <?= $pdo instanceof PDO ? '' : 'disabled' ?>>Enviar</button>
            <?php if (!($pdo instanceof PDO)): ?>
                <small>Activa MySQL para guardar contactos reales.</small>
            <?php endif; ?>
        </form>
    </section>
</main>
</body>
</html>
