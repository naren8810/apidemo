<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/auth/auth_user.php';
require $documentRoot . '/layout/header.php';
require $documentRoot . '/layout/navbar.php';
?>
<script>
    async function fetchProducts() {
        const response = await fetch('products_api.php');
        const products = await response.json();
        document.getElementById('products').innerHTML = JSON.stringify(products, null, 2);
        return JSON.stringify(products, null, 2);
    }

    async function fetchProductById() {
        const id = document.getElementById('productId').value;
        const response = await fetch('products_api.php?id=' + id);
        const product = await response.json();
        document.getElementById('product').innerHTML = JSON.stringify(product, null, 2);
        return JSON.stringify(products, null, 2);
    }

    async function addProduct() {
        const name = document.getElementById('name').value;
        const description = document.getElementById('description').value;
        const price = document.getElementById('price').value;

        const response = await fetch('products_api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name,
                description,
                price
            })
        });
        const result = await response.json();
        alert(JSON.stringify(result));
        return JSON.stringify(result);
    }

    async function updateProduct() {
        const id = document.getElementById('updateId').value;
        const name = document.getElementById('updateName').value;
        const description = document.getElementById('updateDescription').value;
        const price = document.getElementById('updatePrice').value;

        const response = await fetch('products_api.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id,
                name,
                description,
                price
            })
        });
        const result = await response.json();
        alert(JSON.stringify(result));
        return JSON.stringify(result);
    }

    async function deleteProduct() {
        const id = document.getElementById('deleteId').value;

        const response = await fetch('products_api.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id
            })
        });
        const result = await response.json();
        alert(JSON.stringify(result));
        return JSON.stringify(result);
    }
</script>

<div class="container">
    <h2>Product Management Apis</h2>
    <div class="col-6">
        <button class="btn btn-sm btn-success mt-2" onclick="fetchProducts()">Get All Products</button>
        <pre id="products"></pre>
    </div>

    <hr />

    <div class="col-6">
        <h3>Get Product by ID</h3>
        <input class="form-control" type="text" id="productId" placeholder="Product ID">
        <button class="btn btn-sm btn-primary mt-2" onclick="fetchProductById()">Get Product</button>
        <pre id="product"></pre>
    </div>

    <hr />


    <div class="col-6">
        <h3>Add Product</h3>
        <input class="form-control" type="text" id="name" placeholder="Name"><br>
        <textarea class="form-control" id="description" placeholder="Description"></textarea><br>
        <input class="form-control" type="text" id="price" placeholder="Price"><br>
        <button class="btn btn-sm btn-warning mt-2" onclick="addProduct()">Add Product</button>
    </div>

    <hr />


    <div class="col-6">
        <h3>Update Product</h3>
        <input class="form-control" type="text" id="updateId" placeholder="Product ID"><br>
        <input class="form-control" type="text" id="updateName" placeholder="Name"><br>
        <textarea class="form-control" id="updateDescription" placeholder="Description"></textarea><br>
        <input class="form-control" type="text" id="updatePrice" placeholder="Price"><br>
        <button class="btn btn-sm btn-dark mt-2" onclick="updateProduct()">Update Product</button>
    </div>

    <hr />


    <div class="col-6">
        <h3>Delete Product</h3>
        <input class="form-control" type="text" id="deleteId" placeholder="Product ID">
        <button class="btn btn-sm btn-danger mt-2" onclick="deleteProduct()">Delete Product</button>
    </div>

    <hr />
</div>

<?php require $documentRoot . '/layout/footer.php'; ?>