<?php

session_start();

require_once __DIR__ . '/db.php';

$allowedModules = ['general', 'florist'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/index.php');
    exit;
}

$module = $_POST['module'] ?? null;
$identifier = trim($_POST['identifier'] ?? '');
$password = $_POST['password'] ?? '';

if (!in_array($module, $allowedModules, true)) {
    $_SESSION['auth_error'] = 'Invalid module selected.';
    header('Location: ../public/index.php');
    exit;
}

if ($identifier === '' || $password === '') {
    $_SESSION['auth_error'] = 'Please provide both identifier and password.';
    header('Location: ../public/login.php?module=' . urlencode($module));
    exit;
}

$pdo = db();

// Users table and schema will be defined in database/schema.sql.
// For now we assume columns: id, email, username, password_hash, role_general, role_florist, is_active.
$stmt = $pdo->prepare(
    'SELECT id, email, username, password_hash, role_general, role_florist, is_active
     FROM users
     WHERE (email = :identifier OR username = :identifier)
     LIMIT 1'
);
$stmt->execute(['identifier' => $identifier]);
$user = $stmt->fetch();

if (!$user || !(bool)$user['is_active']) {
    $_SESSION['auth_error'] = 'Invalid credentials.';
    header('Location: ../public/login.php?module=' . urlencode($module));
    exit;
}

if (!password_verify($password, $user['password_hash'])) {
    $_SESSION['auth_error'] = 'Invalid credentials.';
    header('Location: ../public/login.php?module=' . urlencode($module));
    exit;
}

// Determine role for this module.
$roleColumn = $module === 'general' ? 'role_general' : 'role_florist';
$role = $user[$roleColumn] ?? null; // expected values: 'admin', 'keeper', or null

if ($role === null) {
    $_SESSION['auth_error'] = 'You do not have access to this module.';
    header('Location: ../public/login.php?module=' . urlencode($module));
    exit;
}

// Store minimal user info in session.
$_SESSION['user'] = [
    'id' => (int)$user['id'],
    'email' => $user['email'],
    'username' => $user['username'],
    'module' => $module,
    'role' => $role,
];

// Redirect to the correct dashboard based on module + role.
if ($module === 'general') {
    $target = $role === 'admin' ? 'general_admin_dashboard.php' : 'general_keeper_dashboard.php';
} else {
    $target = $role === 'admin' ? 'florist_admin_dashboard.php' : 'florist_keeper_dashboard.php';
}

header('Location: ../public/' . $target);
exit;

