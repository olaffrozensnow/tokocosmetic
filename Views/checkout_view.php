<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-xxx"></script>
</head>

<body>
    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
    var snapToken = "<?= $snapToken; ?>";

    document.getElementById('pay-button').onclick = function() {
        snap.pay(snapToken);
    };
    </script>
</body>

</html>