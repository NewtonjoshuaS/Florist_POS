<?php
require_once __DIR__ . '/../app/auth.php';
require_auth('keeper', ['general']);
$user = current_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>General Shop Keeper Dashboard</title>
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
                    Keeper dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-3 py-2 px-3" href="#">
                    New sale (POS)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-3 py-2 px-3" href="#">
                    My recent sales
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-3 py-2 px-3" href="#">
                    Suggest / add product
                </a>
            </li>
        </ul>
        <div class="small text-muted">
            Module: General shop<br>
            Role: Keeper
        </div>
    </nav>

    <main class="flex-grow-1">
        <header class="border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h5 mb-0">Keeper dashboard</h2>
                <p class="text-muted small mb-0">Quick access to POS and your recent activity.</p>
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
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Your sales today</p>
                            <h3 class="h4 mb-0">0.00</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Receipts today</p>
                            <h3 class="h4 mb-0">0</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted small mb-1">Pending product suggestions</p>
                            <h3 class="h4 mb-0">0</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">Start a new sale</h5>
                        <p class="text-muted small mb-0">
                            Open the POS screen to scan items and complete a transaction.
                        </p>
                    </div>
                    <a href="#" class="btn btn-primary btn-sm">Open POS</a>
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

