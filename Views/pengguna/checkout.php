<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .checkout-container {
        max-width: 1200px;
        margin: 50px auto;
    }

    .checkout-box {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-weight: 600;
        margin-bottom: 15px;
    }

    .delivery-option {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 12px;
        cursor: pointer;
        transition: 0.3s;
    }

    .delivery-option.active,
    .delivery-option:hover {
        border-color: #4a6cf7;
        background: #f1f4ff;
    }

    .order-summary {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .order-summary h5 {
        font-weight: 600;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .btn-pay {
        background: #4a6cf7;
        color: #fff;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        text-align: center;
        display: block;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-pay:hover {
        background: #334dc0;
        color: #fff;
    }
    </style>
</head>

<body>

    <div class="container checkout-container">
        <div class="row g-4">
            <!-- LEFT FORM -->
            <div class="col-lg-8">
                <div class="checkout-box">
                    <h4 class="mb-4">Checkout</h4>

                    <!-- 1. Contact Information -->
                    <div class="mb-4">
                        <div class="section-title">1. Contact Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="address-select">Select Shipping Address</label>
                                <select id="address-select" name="address" class="form-select" required>
                                    <option value="" disabled selected>-- Choose your address --</option>
                                    <?php if (!empty($alamatList)): ?>
                                    <?php foreach ($alamatList as $alamat): ?>
                                    <option value="<?= esc($alamat['AlamatID']) ?>">
                                        <?= esc($alamat['Jalan']) ?>, <?= esc($alamat['Kota']) ?>
                                        <?= esc($alamat['KodePos']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <option disabled>No address found. Please add one.</option>
                                    <?php endif; ?>
                                </select>

                                <div class="add-address" tabindex="0" role="button" aria-label="Add new address"
                                    onclick="handleAddAddress()"
                                    onkeypress="if(event.key==='Enter' || event.key===' ') handleAddAddress()">
                                    <a href="<?= base_url('alamat/create') ?>">
                                        + Add Address
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">User Name</label>
                                    <input type="text" class="form-control" id="firstName"
                                        value="<?= esc($user['UserName'] ?? '') ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone"
                                        value="<?= esc($user['noHP'] ?? '') ?>" readonly>
                                </div>

                            </div>
                        </div>

                        <!-- 2. Delivery Method -->
                        <div class="mb-4">
                            <div class="section-title">2. Delivery Method</div>
                            <div class="d-flex gap-3">
                                <div class="delivery-option active">Same-day</div>
                                <div class="delivery-option">Express</div>
                                <div class="delivery-option">Normal</div>
                            </div>

                        </div>

                        <!-- 3. Payment Method -->
                        <div>
                            <div class="section-title">3. Payment Method</div>
                            <div class="d-flex gap-3">
                                <button class="btn btn-outline-dark">QRIS</button>
                                <!-- <button class="btn btn-outline-primary">Apple Pay</button>
            <button class="btn btn-outline-danger">Google Pay</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT ORDER SUMMARY -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <h5 class="mb-4">Order Summary</h5>

                    <hr>
                    <?php $items = $items ?? []; ?>
                    <?php $total = 0; ?>
                    <?php foreach ($items as $item): 
    $lineTotal = $item['Harga'] * $item['Quantity'];
    $total += $lineTotal;
?>
                    <p><?= esc($item['ProductName']); ?> (x<?= $item['Quantity']; ?>) -
                        $<?= number_format($lineTotal, 2); ?></p>
                    <?php endforeach; ?>


                    <hr>
                    <p><strong>Total: $<?= number_format($total, 2); ?></strong></p>

                    <a href="#" class="btn-pay mt-3">Pay →</a>
                </div>
            </div>

        </div>