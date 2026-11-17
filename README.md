# My Sweet Dreams Bakery — PHP & MySQL Order Request Platform

A PHP bakery website where customers request custom desserts. The form validates submissions and saves them in a MySQL database using PDO prepared statements.

## Requirements
- PHP 8.1+ with PDO MySQL and mbstring extensions
- MySQL or MariaDB
- XAMPP (recommended for Windows)

## Setup (Windows / XAMPP)
1. Install XAMPP. Start **Apache** and **MySQL** in its control panel.
2. Copy this project folder into `C:\xampp\htdocs\Sweet-Dreams-Bakery-Orders`.
3. Open `http://localhost/phpmyadmin` and select **Import**. Choose `schema.sql`, then click **Import**. Alternatively, run the SQL script in MySQL Workbench.
4. Database defaults in `db.php`: host `127.0.0.1`, name `sweet_dreams_bakery`, username `root`, password blank (common XAMPP local default). If yours differ, set environment variables `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`. Never commit real credentials.
5. Visit `http://localhost/Sweet-Dreams-Bakery-Orders/`.
6. Fill in the form and submit. You should see a confirmation.
7. In phpMyAdmin open `sweet_dreams_bakery` → `orders` → **Browse** to verify the row. Or run `SELECT * FROM sweet_dreams_bakery.orders ORDER BY id DESC;` in MySQL Workbench.

## How it works
- `index.php` displays the form and generates a session CSRF token.
- `submit_order.php` checks the POST method and CSRF token, validates fields and allowed options, and inserts a record with a PDO prepared statement.
- `db.php` connects to MySQL and logs technical errors server-side without exposing credentials.
- `schema.sql` creates the database and `orders` table.
- `style.css` provides a responsive pink-and-lavender design.

## Form fields
Full name, email, phone, dessert type, serving size, preferred pickup date, and optional design/allergy notes. Every field is stored in the `orders` table (notes may be empty). The database also automatically records submission time.

## Features
- Responsive custom bakery styling
- Dropdowns for dessert and serving sizes
- Server-side validation and prepared SQL statements
- CSRF protection and friendly submission confirmation
- Pickup date cannot be in the past

## Security and limitations
This is a local classroom demonstration, not a production checkout. For public hosting use HTTPS, a dedicated least-privilege database account, spam/rate limiting, appropriate data retention/privacy notices, and secure session-cookie settings. Do not publicly expose customer data. There is no payment collection or public order-list page.

## Testing checklist
- [ ] Apache and MySQL start successfully
- [ ] Database/table import succeeds
- [ ] Form loads in browser
- [ ] Valid submission shows confirmation
- [ ] New row appears in MySQL `orders` table
- [ ] Invalid email or missing required fields are rejected
- [ ] A past pickup date is rejected

## GitHub submission
Create a repository and upload these files (do not upload credentials or customer data). Add screenshots of the form, successful submission, and the database table **with private customer information hidden**. Submit the repository URL to your instructor.
