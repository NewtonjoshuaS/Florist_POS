<?php
// Landing page: choose which module to enter (General Shop or Florist).
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Florist & General Shop POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top left, #f8bbd0, #ffffff 40%, #bbdefb);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        .app-card {
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
            background: #ffffff;
            padding: 2.5rem 2rem;
            max-width: 900px;
            width: 100%;
        }
        .module-card {
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
            cursor: pointer;
            background: linear-gradient(135deg, #ffffff, #f9fafb);
        }
        .module-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.12);
            border-color: #3b82f6;
        }
        .module-badge {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: .08em;
        }
    </style>
</head>
<body>
<main class="app-card">
    <div class="text-center mb-4">
        <h1 class="h3 fw-bold mb-1">Florist & General Shop POS</h1>
        <p class="text-muted mb-0">
            Choose which module you want to work in before signing in.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="login.php?module=general" class="text-decoration-none text-reset">
                <div class="module-card h-100 p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary-subtle text-primary-emphasis module-badge">
                            General shop
                        </span>
                        <span class="text-muted small">Retail / mini shop</span>
                    </div>
                    <h2 class="h5 fw-semibold mb-2">General Shop POS</h2>
                    <p class="text-muted small mb-0">
                        Manage daily sales and inventory for standard retail items like groceries and household goods.
                        Separate dashboards for Admin and Keeper roles.
                    </p>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="login.php?module=florist" class="text-decoration-none text-reset">
                <div class="module-card h-100 p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-success-subtle text-success-emphasis module-badge">
                            Florist
                        </span>
                        <span class="text-muted small">Flowers & vessels</span>
                    </div>
                    <h2 class="h5 fw-semibold mb-2">Florist POS</h2>
                    <p class="text-muted small mb-0">
                        Specialised for flowers, bouquets, and vases. Track stock, wastage, and bundled arrangements
                        with role-based dashboards for Admin and Keeper.
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted small mb-0">
            After choosing a module you will be asked to log in with your role.
        </p>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

