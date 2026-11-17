<?php
session_start();
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
$success = isset($_GET['success']);
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Sweet Dreams Bakery | Custom Orders</title><link rel="stylesheet" href="style.css"></head>
<body><header><div class="brand">🧁 My Sweet Dreams Bakery</div><p>Handmade desserts for your sweetest celebrations</p></header>
<main><section class="intro"><h1>Request a Custom Dessert</h1><p>Tell us what you're dreaming of. We'll contact you to confirm availability and pricing.</p></section>
<?php if ($success): ?><div class="notice" role="status">Your request was saved! We'll be in touch soon.</div><?php endif; ?>
<form action="submit_order.php" method="post"><input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8') ?>">
<label>Full name<input name="customer_name" maxlength="100" required></label>
<label>Email<input name="email" type="email" maxlength="255" required></label>
<label>Phone<input name="phone" type="tel" maxlength="25" required></label>
<label>Dessert<select name="dessert_type" required><option value="">Choose a dessert</option><option>Cake</option><option>Flan</option><option>Chocoflan</option><option>Tres Leches</option><option>Cupcakes</option><option>Cookies</option></select></label>
<label>Serving size<select name="serving_size" required><option value="">Choose a size</option><option>1–6 people</option><option>7–12 people</option><option>13–24 people</option><option>25+ people</option></select></label>
<label>Preferred pickup date<input name="pickup_date" type="date" min="<?= date('Y-m-d') ?>" required></label>
<label class="wide">Design ideas or allergy notes<textarea name="notes" maxlength="2000" rows="4" placeholder="Colors, flavors, theme, allergies..."></textarea></label>
<button type="submit">Send My Request</button></form><p class="fine">Submitting a request does not confirm an order. Please avoid including payment information.</p></main>
<footer>© <?= date('Y') ?> My Sweet Dreams Bakery</footer></body></html>
