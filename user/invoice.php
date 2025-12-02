<?php
session_start();

if (!isset($_SESSION['last_order']) || count($_SESSION['last_order']) == 0) {
    header("Location: cart.php");
    exit();
}

$cart = $_SESSION['last_order'];
$total = $_SESSION['last_order_total'];

$customerName = "Patel Sunil";
$customerEmail = "sunil@gmail.com.com";
$orderDate = date("d-m-Y H:i:s");
$orderNumber = rand(100000, 999999);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice #<?= $orderNumber; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

/* Body & Background */
body {
    font-family: 'Quicksand', sans-serif;
    background: linear-gradient(135deg, #e0f7fa, #ffffff);
    padding: 2rem;
    overflow-x: hidden;
}

/* Invoice Card */
.invoice-container {
    max-width: 850px;
    margin: auto;
    background: #fff;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    animation: fadeIn 1s ease forwards;
    opacity: 0;
}

/* Header */
.invoice-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 2rem;
    animation: slideInLeft 0.8s ease forwards;
}

.invoice-header h1 {
    font-weight: 700;
    color: #007bff;
    font-size: 2rem;
}

.company-info p {
    margin: 0;
    color: #555;
    font-weight: 500;
    text-align: right;
}

/* Sections */
.invoice-section {
    margin-bottom: 2rem;
    animation: fadeInUp 1s ease forwards;
}

.invoice-section h5 {
    font-weight: 700;
    color: #333;
    border-bottom: 2px solid #007bff;
    display: inline-block;
    padding-bottom: 5px;
    margin-bottom: 15px;
}

/* Table Styling */
.table-wrapper {
    overflow-x: auto; /* Make table scrollable on small screens */
}

.table {
    border-radius: 10px;
    overflow: hidden;
    animation: fadeIn 1s ease forwards;
    min-width: 600px;
}

.table th {
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: #fff;
    text-align: center;
    transition: transform 0.3s ease;
}

.table th:hover {
    transform: scale(1.05);
}

.table td {
    text-align: center;
    vertical-align: middle;
    transition: background 0.3s ease, transform 0.3s ease;
}

.table tbody tr:hover {
    background: #f1f8ff;
    transform: scale(1.02);
}

/* Total Row */
.total-row td {
    font-weight: 700;
    font-size: 1.2rem;
    background: #f1f8ff;
}

/* Print Button */
.btn-print {
    background: linear-gradient(90deg, #ff6a00, #ee0979);
    border: none;
    color: #fff;
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    animation: bounceIn 1s ease forwards;
}

.btn-print:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 12px 30px rgba(255,105,135,0.5);
}

@media print {
    .btn-print { display: none; }
}

/* Animations */
@keyframes fadeIn {0% { opacity: 0; transform: translateY(50px);} 100% { opacity: 1; transform: translateY(0);}}
@keyframes fadeInUp {0% { opacity: 0; transform: translateY(30px);} 100% { opacity: 1; transform: translateY(0);}}
@keyframes slideInLeft {0% { opacity: 0; transform: translateX(-50px);} 100% { opacity: 1; transform: translateX(0);}}
@keyframes bounceIn {0% { transform: scale(0.5); } 60% { transform: scale(1.1); } 80% { transform: scale(0.95); } 100% { transform: scale(1); }}

/* Responsive adjustments */
@media (max-width: 768px) {
    .invoice-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .company-info { text-align: left; margin-top: 15px; }
    .invoice-container { padding: 1rem; }
    .table { min-width: 100%; font-size: 0.9rem; }
    .btn-print { width: 100%; padding: 10px; }
}

@media (max-width: 480px) {
    .invoice-header h1 { font-size: 1.5rem; }
    .invoice-section h5 { font-size: 1rem; }
    .total-row td { font-size: 1rem; }
}
</style>
</head>

<body>
<div class="invoice-container">
    <div class="invoice-header">
        <h1>Invoice #<?= $orderNumber; ?></h1>
        <div class="company-info">
            <p><strong>Swift Cart</strong></p>
            <p>123 Market Street</p>
            <p>Surat, Sachin</p>
            <p>sunil123@gmail.com</p>
        </div>
    </div>

    <div class="invoice-section">
        <h5>Customer Information</h5>
        <p><strong>Name:</strong> <?= $customerName; ?></p>
        <p><strong>Email:</strong> <?= $customerEmail; ?></p>
        <p><strong>Order Date:</strong> <?= $orderDate; ?></p>
    </div>

    <div class="invoice-section">
        <h5>Order Details</h5>
        <div class="table-wrapper">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($cart as $item) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($item['productName']); ?></td>
                        <td>₹<?= number_format($item['productPrice'],2); ?></td>
                        <td><?= (int)$item['productQuantity']; ?></td>
                        <td>₹<?= number_format($item['productPrice']*$item['productQuantity'],2); ?></td>
                    </tr>
                    <?php } ?>
                    <tr class="total-row">
                        <td colspan="4" class="text-end">Total Paid:</td>
                        <td>₹<?= number_format($total,2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <button onclick="window.print();" class="btn btn-print">Print Invoice</button>
        </div>
    </div>
</div>
</body>
</html>
