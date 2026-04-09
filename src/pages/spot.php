<?php

    include("../config/connect.php");

    $spot = $_REQUEST['spot'];
    

    $sql_query = "SELECT t.id_spot, t.name, t.city, t.state, t.country, MIN(p.picture) as picture FROM tourist_spot t LEFT JOIN picture_spot p ON t.id_spot = p.id_spot WHERE t.id_spot = $spot GROUP BY t.id_spot, t.name, t.city, t.state, t.country";
    $query = mysqli_query($connect, $sql_query);

    if(!$query){
        die("Bugou porra: ". mysqli_error($connect));
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produto</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f1f1f1;
    margin: 0;
}

/* CONTAINER PRINCIPAL */
.container {
    max-width: 1100px;
    margin: 40px auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
}

/* LAYOUT */
.product {
    display: flex;
    gap: 30px;
}

/* IMAGEM */
.image-section {
    flex: 1;
}

.image-section img {
    width: 100%;
    height: 400px;
    object-fit: contain; /* evita corte */
    border-radius: 10px;
}

/* INFO */
.info-section {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    font-size: 22px;
    margin-bottom: 10px;
}

.product-price {
    font-size: 26px;
    color: #00a650;
    margin-bottom: 15px;
}

.installments {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

.description {
    font-size: 14px;
    color: #444;
    margin-bottom: 20px;
}

/* BOTÕES */
.buy-box {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
}

button {
    width: 100%;
    padding: 12px;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.buy-btn {
    background: #3483fa;
    color: white;
}

.cart-btn {
    background: #fff;
    border: 1px solid #3483fa;
    color: #3483fa;
}

button:hover {
    opacity: 0.9;
}

/* RESPONSIVO */
@media (max-width: 768px) {
    .product {
        flex-direction: column;
    }

    .image-section img {
        height: 300px;
    }
}
</style>
</head>

<body>

<div class="container">

    <?php while($row = mysqli_fetch_assoc($query))
        {
    ?>
        <div class="product">

            <!-- ESQUERDA - IMAGEM -->
            <div class="image-section">
                <img src= <?php echo' '.$row['picture'].' '; ?> alt="Produto">
            </div>
            <!-- DIREITA - INFORMAÇÕES -->
            <div class="info-section">

                <div class="product-title">
                    <?php echo $row['name']; ?>
                </div>

                <div class="product-price">
                    R$ 1.299,90
                </div>

                <div class="installments">
                    em até 10x de R$ 129,99 sem juros
                </div>

                <div class="description">
                    Aqui vai uma descrição mais completa do produto. Você pode incluir
                    características, especificações, benefícios, etc.
                </div>

                <div class="buy-box">
                    <button class="buy-btn">Comprar agora</button>
                    <button class="cart-btn">Adicionar ao carrinho</button>
                </div>

            </div>

        </div>
    <?php } ?>
</div>

</body>
</html>