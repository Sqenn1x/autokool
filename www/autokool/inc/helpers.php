<?php
function cfg(string $key, $default = null)
{
    return $GLOBALS['config'][$key] ?? $default;
}

function e($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function current_language(): string
{
    return $_SESSION['language'] ?? 'et';
}

function t(string $estonian, string $russian): string
{
    return current_language() === 'ru' ? $russian : $estonian;
}

function language_url(string $language): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $query = $_GET;
    $query['lang'] = $language;
    return $path . '?' . http_build_query($query);
}

function base_path(): string
{
    static $base = null;
    if ($base === null) {
        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }
    return $base;
}

function url(string $path = ''): string
{
    return base_path() . '/' . ltrim($path, '/');
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

function render(string $view, array $data = []): void
{
    extract($data);
    require __DIR__ . '/../view/layout/header.php';
    require __DIR__ . '/../view/' . $view . '.php';
    require __DIR__ . '/../view/layout/footer.php';
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_check(): void
{
    $sent = (string)($_POST['csrf'] ?? '');
    $known = (string)($_SESSION['csrf'] ?? '');
    if ($known === '' || !hash_equals($known, $sent)) {
        http_response_code(419);
        exit(t('Seanss aegus. Palun laadige leht uuesti.', 'Сессия истекла. Пожалуйста, обновите страницу.'));
    }
}

function flash(?string $msg = null)
{
    if ($msg !== null) {
        $_SESSION['flash'] = $msg;
        return null;
    }
    $m = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $m;
}

function money($v): string
{
    return number_format((float)$v, 0, ',', ' ') . ' €';
}
