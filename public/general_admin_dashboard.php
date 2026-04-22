<?php
require_once __DIR__ . '/../app/auth.php';
require_auth('admin', ['general']);
$user = current_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>General Shop Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: #020617;
            color: #e5e7eb;
        }
        .sidebar a {
            color: inherit;
            text-decoration: none;
        }
        .sidebar a.active, .sidebar a:hover {
            background: rgba(148, 163, 184, 0.15);
        }
    </style>
</head>
<body>
<div class="d-flex">
    <nav class="sidebar p-3">
        <h1 class="h5 fw-semibold mb-4">General Shop</h1>
        <ul class="nav nav-pills flex-column gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link active rounded-3 py-2 px-3" href="#">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-3 py-2 px-3" href="#">
                    Products &amp; Inventory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-3 py-2 px-3" href="#">
                    Sales / POS
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-3 py-2 px-3" href="#">
                    Reports &amp; Analytics
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-3 py-2 px-3" href="#">
                    Users &amp; Roles
                </a>
            </li>
        </ul>
        <div class="small text-muted">
            Module: General shop<br>
            Role: Admin
        </div>
    </nav>

    <main class="flex-grow-1">
        <header class="border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h5 mb-0">Admin dashboard</h2>
                <p class="text-muted small mb-0">Overview of sales, inventory and activity.</p>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="profileMenu"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <?= htmlspecialchars($user['username'] ?? 'User', ENT_QUOTES, 'UTF-8') ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileMenu">
                    <li><h6 class="dropdown-header">Signed in as</h6></li>
                    <li><span class="dropdown-item-text small">
                        <?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item small" href="index.php">Switch module</a></li>
                    <li><a class="dropdown-item small" href="../app/logout.php">Sign out</a></li>
                </ul>
            </div>
        </header>

        <section class="p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Today’s sales</p>
                            <h3 class="h4 mb-0">0.00</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">This week</p>
                            <h3 class="h4 mb-0">0.00</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Low-stock items</p>
                            <h3 class="h4 mb-0">0</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Active products</p>
                            <h3 class="h4 mb-0">0</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Sales trend (placeholder)</h5>
                    <p class="text-muted small mb-0">
                        This will display weekly, monthly and yearly analytics charts for the General shop module.
                    </p>
                </div>
            </div>
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

