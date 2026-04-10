<?php
require_once __DIR__ . '../components/connect.php';


function getDB() {
    require __DIR__ . '../components/connect.php';
    return $conn;
}

function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// function hashPassword($password) {
//     return password_hash($password, PASSWORD_DEFAULT);
// }

function verifyPassword($password, $hash ) {
    return password_verify($password, $hash);
}

// function csrfToken() {
//     if (!isset($_SESSION['csrf_token'])) {
//         $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
//     }
//     return $_SESSION['csrf_token'];
// }

// function verifyCsrf() {
//     return isset($_POST['csrf_token']) &&
//            $_POST['csrf_token'] === $_SESSION['csrf_token'];
// }

//search functions

function searchPosts($query, $limit, $offset) {
  require __DIR__ . '../components/connect.php';

    $stmt = $conn->prepare("
        SELECT p.*, a.name,
        (SELECT COUNT(*) FROM likes WHERE post_id = p.id) AS like_count,
        (SELECT COUNT(*) FROM comments WHERE post_id = p.id) AS comment_count
        FROM posts p
        JOIN admin a ON p.admin_id = a.id
        WHERE p.title LIKE :q OR p.content LIKE :q OR p.category LIKE :q
        ORDER BY p.date DESC
        LIMIT :limit OFFSET :offset
    ");

    $search = "%$query%";

    $stmt->bindValue(':q', $search, PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function countSearchResults($query) {
    global $conn;

    $stmt = $conn->prepare("
        SELECT COUNT(*) FROM posts
        WHERE title LIKE :q OR content LIKE :q OR category LIKE :q
    ");

    $search = "%$query%";
    $stmt->bindValue(':q', $search, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchColumn();
}