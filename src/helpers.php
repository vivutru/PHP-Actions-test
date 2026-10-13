<?php
declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function jmd(int $amount): string
{
    return 'J$' . number_format($amount);
}

function tours(): array
{
    return require __DIR__ . '/data.php';
}

function find_tour(string $slug): ?array
{
    foreach (tours() as $tour) {
        if ($tour['slug'] === $slug) {
            return $tour;
        }
    }
    return null;
}

function booking_total(array $tour, int $guests): int
{
    return $tour['price'] * $guests;
}
