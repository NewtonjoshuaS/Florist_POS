<?php
// Login page – expects a module query parameter: ?module=general or ?module=florist

session_start();

$allowedModules = ['general', 'florist'];
$module = isset($_GET['module']) && in_array($_GET['module'], $allowedModules, true)
    ? $_GET['module']
    : null;

if ($module === null) {
    // If no module selected, send back to landing page.
    header('Location: index.php');
    exit;
}

$moduleTitle = $module === 'general' ? 'General Shop POS' : 'Florist POS';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | <?= htmlspecialchars($moduleTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e0f2fe, #fdf2f8);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        .login-card {
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
            background: #ffffff;
            padding: 2.25rem 2rem;
            width: 100%;
            max-width: 420px;
        }
    </style>
</head>
<body>
<main class="login-card">
    <div class="mb-3 text-center">
        <p class="text-muted small mb-1 text-uppercase fw-semibold" style="letter-spacing: .08em;">
            <?= htmlspecialchars($module === 'general' ? 'General shop' : 'Florist', ENT_QUOTES, 'UTF-8') ?> module
        </p>
        <h1 class="h4 fw-bold mb-1">Sign in</h1>
        <p class="text-muted small mb-0">
            Enter your credentials to access the <?= htmlspecialchars($moduleTitle, ENT_QUOTES, 'UTF-8') ?>.
        </p>
    </div>

    <?php if (!empty($_SESSION['auth_error'])): ?>
        <div class="alert alert-danger py-2 small">
            <?= htmlspecialchars($_SESSION['auth_error'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <?php unset($_SESSION['auth_error']); ?>
    <?php endif; ?>

    <form method="post" action="../app/handle_login.php">
        <input type="hidden" name="module" value="<?= htmlspecialchars($module, ENT_QUOTES, 'UTF-8') ?>">

        <div class="mb-3">
            <label for="email" class="form-label small fw-semibold">Email or Username</label>
            <input type="text" class="form-control form-control-sm" id="email" name="identifier" required
                   autocomplete="username">
        </div>

        <div class="mb-2">
            <label for="password" class="form-label small fw-semibold d-flex justify-content-between">
                <span>Password</span>
            </label>
            <input type="password" class="form-control form-control-sm" id="password" name="password" required
                   autocomplete="current-password">
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="index.php" class="small text-decoration-none">&larr; Change module</a>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-sm">
                Sign in
            </button>
        </div>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

