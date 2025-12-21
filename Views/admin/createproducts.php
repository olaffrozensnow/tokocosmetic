<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard dengan Form Search</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        background: linear-gradient(135deg, #4a90e2, #357ABD);
        color: white;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .sidebar h2 {
        margin-bottom: 30px;
        font-weight: 700;
        letter-spacing: 2px;
        text-align: center;
    }

    .sidebar nav a {
        color: white;
        text-decoration: none;
        padding: 12px 15px;
        margin-bottom: 10px;
        border-radius: 6px;
        display: block;
        transition: background-color 0.3s ease;
        font-weight: 600;
    }

    .sidebar nav a:hover,
    .sidebar nav a.active {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .main-content {
        margin-left: 250px;
        padding: 30px;
        flex-grow: 1;
        background-color: #fff;
        min-height: 100vh;
    }

    h1 {
        color: #4a90e2;
        margin-bottom: 20px;
    }

    /* Container form dan tombol */
    .search-add-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
        align-items: flex-end;
        justify-content: space-between;
    }

    /* Form pencarian */
    form.search-form {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        flex-grow: 1;
        max-width: 800px;
    }

    form.search-form label {
        display: flex;
        flex-direction: column;
        font-weight: 600;
        font-size: 0.9rem;
        color: #555;
        min-width: 120px;
    }

    form.search-form input,
    form.search-form select {
        padding: 8px 12px;
        border: 2px solid #4a90e2;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        margin-top: 5px;
    }

    form.search-form input:focus,
    form.search-form select:focus {
        outline: none;
        border-color: #357ABD;
        box-shadow: 0 0 5px #357ABD;
    }

    form.search-form button {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        align-self: flex-end;
        transition: background-color 0.3s ease;
        min-width: 100px;
    }

    form.search-form button:hover {
        background-color: #357ABD;
    }

    /* Tombol Add User */
    button.add-btn {
        background-color: #27ae60;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.3s ease;
        white-space: nowrap;
    }

    button.add-btn:hover {
        background-color: #1e8449;
    }

    /* Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    thead {
        background-color: #4a90e2;
        color: white;
    }

    th,
    td {
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tbody tr:hover {
        background-color: #e6f0ff;
    }

    /* Tombol edit dan delete */
    .btn-group button {
        border: none;
        padding: 8px 12px;
        margin-right: 8px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        color: white;
    }

    .btn-edit {
        background-color: #4caf50;
    }

    .btn-edit:hover {
        background-color: #3a8a40;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-delete:hover {
        background-color: #b93a2a;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .search-add-container {
            flex-direction: column;
            align-items: stretch;
        }

        form.search-form {
            max-width: 100%;
        }

        form.search-form label {
            min-width: 100%;
        }

        form.search-form button {
            min-width: 100%;
        }

        button.add-btn {
            width: 100%;
            white-space: normal;
        }
    }
    </style>
</head>

<body>
    <aside class="sidebar">
        <nav>
            <a href="#">Dashboard</a>
            <a href="#" class="active">Products</a>
            <a href="#">Orders</a>
            <a href="#">Logout</a>
        </nav>
    </aside>
    <main class="main-content">
        <h1>User Dashboard</h1>

        <div class="search-add-container">
            <form action="<?= base_url('productboard/save') ?>" method="post" enctype="multipart/form-data"
                class="search-form" id="Form">
                <label for="productName">Nama Produk</label>
                <input type="text" name="productName" required>

                <label for="categoryID">Kategori</label>
                <select name="categoryID" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($category as $c): ?>
                    <option value="<?= $c['categoryID'] ?>">
                        <?= $c['categoryName'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <label for="detailID">Detail</label>
                <select name="detailID" required>
                    <option value="">-- Pilih Detail --</option>
                    <?php foreach ($detailproduct as $d): ?>
                    <option value="<?= $d['detailID'] ?>">
                        <?= $d['Deskripsi'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <label for=Harga>Harga</label>
                <input type="number" name="Harga" required>

                <label for=Stok>Stok</label>
                <input type="number" name="Stok" required>

                <label for=merk>Merk</label>
                <input type="text" name="merk" required>


                <label for="GambarProduct">Foto Produk</label>
                <input type="file" name="GambarProduct" accept="image/*" required>

                <button type="submit">Search</button>

                <button type="submit" class="add-btn">+ Save Product</button>
        </div>
        <table>
            <table id="productTable">
                <thead>
                    <tr>
                        <th>productID</th>
                        <th>productName</th>
                        <th>merk</th>
                        <th>GambarProduct</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>categoryID</th>
                        <th>detailID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($product) && is_array($product)): ?>
                    <?php foreach ($product as $p): ?>
                    <tr>
                        <td><?= esc($p['productID']) ?></td>
                        <td><?= esc($p['productName']) ?></td>
                        <td><?= esc($p['merk']) ?></td>
                        <td>
                            <?php if (!empty($p['GambarProduct'])): ?>
                            <img src="<?= base_url('uploads/products/' . $p['GambarProduct']) ?>"
                                alt="<?= esc($p['productName']) ?>" style="width:80px;height:auto;border-radius:6px">
                            <?php else: ?>
                            -
                            <?php endif; ?>
                        </td>
                        <td><?= number_format($p['Harga'] ?? 0, 0, ',', '.') ?></td>
                        <td><?= esc($p['Stok'] ?? 0) ?></td>
                        <td><?= esc($p['categoryID'] ?? '-') ?></td>
                        <td><?= esc($p['detailID'] ?? '-') ?></td>
                        <td>
                            <a href="<?= base_url('productboard/edit/'.$p['productID']) ?>">Edit</a> |
                            <a href="<?= base_url('productboard/delete/'.$p['productID']) ?>"
                                onclick="return confirm('Yakin hapus?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align:center">Belum ada produk</td>
                    </tr>
                    <?php endif; ?>
                </tbody>

                <script>
                const searchForm = document.getElementById('searchForm');
                const tableBody = document.querySelector('#userTable tbody');

                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const nameFilter = document.getElementById('searchName').value.toLowerCase();
                    const emailFilter = document.getElementById('searchEmail').value.toLowerCase();
                    const roleFilter = document.getElementById('searchRole').value.toLowerCase();

                    const rows = tableBody.getElementsByTagName('tr');

                    for (let i = 0; i < rows.length; i++) {
                        const cells = rows[i].getElementsByTagName('td');
                        const name = cells[0].textContent.toLowerCase();
                        const email = cells[1].textContent.toLowerCase();
                        const role = cells[2].textContent.toLowerCase();

                        const matchName = name.includes(nameFilter);
                        const matchEmail = email.includes(emailFilter);
                        const matchRole = roleFilter === '' || role === roleFilter;

                        if (matchName && matchEmail && matchRole) {
                            rows[i].style.display = '';
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                });
                </script>
    </main>
</body>

</html>