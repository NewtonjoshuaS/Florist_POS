<?php

session_start();

/**
 * Require a logged-in user, optionally with a specific role and module.
 *
 * @param string|null $role Required role (e.g. 'admin' or 'keeper') or null for any.
 * @param string[]|null $modules Allowed modules (e.g. ['general'] or ['florist']) or null for any.
 */
function require_auth(?string $role = null, ?array $modules = null): void
{
    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }

    $user = $_SESSION['user'];

    if ($role !== null && ($user['role'] ?? null) !== $role) {
        http_response_code(403);
        echo 'Access denied.';
        exit;
    }

    if ($modules !== null && !in_array($user['module'] ?? null, $modules, true)) {
        http_response_code(403);
        echo 'Access denied.';
        exit;
    }
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

