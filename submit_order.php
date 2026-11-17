<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed'); }
if (!isset($_POST['csrf'], $_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], (string)$_POST['csrf'])) { http_response_code(403); exit('Invalid form token. Reload the form.'); }
function field(string $key): string { return trim((string)($_POST[$key] ?? '')); }
$name = field('customer_name'); $email = field('email'); $phone = field('phone');
$dessert = field('dessert_type'); $size = field('serving_size'); $pickup = field('pickup_date'); $notes = field('notes');
$desserts = ['Cake','Flan','Chocoflan','Tres Leches','Cupcakes','Cookies'];
$sizes = ['1–6 people','7–12 people','13–24 people','25+ people'];
$date = DateTimeImmutable::createFromFormat('!Y-m-d', $pickup);
if ($name === '' || mb_strlen($name) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255 || !preg_match('/^[0-9+().\- ]{7,25}$/', $phone) || !in_array($dessert, $desserts, true) || !in_array($size, $sizes, true) || !$date || $date->format('Y-m-d') !== $pickup || $pickup < date('Y-m-d') || mb_strlen($notes) > 2000) {
 http_response_code(422); exit('Please go back and enter valid information in all required fields.');
}
require __DIR__ . '/db.php';
$stmt = $pdo->prepare('INSERT INTO orders (customer_name,email,phone,dessert_type,serving_size,pickup_date,notes) VALUES (:name,:email,:phone,:dessert,:size,:pickup,:notes)');
$stmt->execute(['name'=>$name,'email'=>$email,'phone'=>$phone,'dessert'=>$dessert,'size'=>$size,'pickup'=>$pickup,'notes'=>$notes]);
$_SESSION['csrf'] = bin2hex(random_bytes(32));
header('Location: index.php?success=1', true, 303); exit;
