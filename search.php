<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

$texto = trim($_GET['texto'] ?? '');

// Minimum 3 characters required for search
if (strlen($texto) < 3) {
    echo json_encode([
        'error' => 'El parámetro texto debe tener al menos 3 caracteres'
    ]);
    exit;
}

if (!file_exists(__DIR__ . '/dataset.json')) {
    http_response_code(500);
    echo json_encode(['error' => 'dataset.json no encontrado']);
    exit;
}

$data = json_decode(file_get_contents(__DIR__ . '/dataset.json'), true);

if ($data === null) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al leer dataset.json']);
    exit;
}

// Convert text to lowercase for case-insensitive searches
$q          = strtolower($texto);
$books      = [];
$authorsSet = [];

foreach ($data as $book) {
    $titleMatch  = str_contains(strtolower($book['titulo'] ?? ''), $q);
    $authorMatch = str_contains(strtolower($book['autor'] ?? ''), $q);

    if ($titleMatch) {
        $books[] = $book;
    }

    if ($authorMatch && !isset($authorsSet[$book['autor']])) {
        $authorsSet[$book['autor']] = $book['autor'];
    }
}

$authors = [];
foreach ($authorsSet as $authorName) {

    $authorBooks = array_values(array_filter($data, fn($b) => $b['autor'] === $authorName));

    usort($authorBooks, fn($a, $b) =>
        strcmp($b['fecha_nov'] ?? '', $a['fecha_nov'] ?? '')
    );

    $authors[] = [
        'autor'      => $authorName,
        'last_books' => array_slice($authorBooks, 0, 2),
    ];
}

echo json_encode([
    'books'   => $books,
    'authors' => $authors,
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
