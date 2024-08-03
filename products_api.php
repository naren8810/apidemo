<?php

header('Content-Type: application/json');

$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/config/config.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            echo json_encode($result->fetch_assoc());
        } else {
            $result = $conn->query("SELECT * FROM products");
            $products = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($products);
        }
        break;
    case 'POST':
        $name = $input['name'];
        $description = $input['description'];
        $price = $input['price'];

        $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $description, $price);

        if ($stmt->execute()) {
            echo json_encode(['id' => $conn->insert_id]);
        } else {
            echo json_encode(['error' => $stmt->error]);
        }
        break;
    case 'PUT':
        $id = $input['id'];
        $name = $input['name'];
        $description = $input['description'];
        $price = $input['price'];

        $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $name, $description, $price, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => $stmt->error]);
        }
        break;
    case 'DELETE':
        $id = intval($input['id']);

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => $stmt->error]);
        }
        break;
    default:
        echo json_encode(['error' => 'Invalid request method']);
        break;
}

$conn->close();
