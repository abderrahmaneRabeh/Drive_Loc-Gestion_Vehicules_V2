<?php
session_start();
require_once '../../middleware/Check_user_connexion.php';
AjouterFormCheck();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIVE-LOC -- Ajouter Theme</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/ajouterVoiture.css">

    <link href="../../assets/img/vendor-7.png" rel="icon">
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>
    <div class="container">
        <div class="top-buttons">
            <a href="../../dashboard/admin/Theme.php" class="btn"><i class="fas fa-tachometer-alt"></i>
                Dashboard</a>
            <a href="../../index.php" class="btn"><i class="fas fa-home"></i> Home</a>
        </div>
        <h2>Ajouter une Theme</h2>

        <form action="../../Controllers/Ajouter_Theme.php" method="POST" id="carForm">
            <div id="carGroupContainer">
                <div class="car-card">
                    <h3>Theme 1</h3>
                    <div class="form-group">
                        <label for="theme_name">Nom du theme</label>
                        <input type="text" name="theme_name[]" placeholder="Enter theme name" required>
                    </div>
                </div>

            </div>
            <button type="button" class="add-car-btn" id="addCarBtn">Ajouter un autre</button>
            <button type="submit" class="form-btn">Ajouter Themes</button>
        </form>
    </div>

    <script>
        document.getElementById('addCarBtn').addEventListener('click', function () {
            const carGroupContainer = document.getElementById('carGroupContainer');
            const carCards = document.querySelectorAll('.car-card');
            console.log("cards", carCards);
            const newCard = carCards[0].cloneNode(true);
            console.log("New card", newCard);

            newCard.querySelector('h3').textContent = `Theme ${carCards.length + 1}`;

            newCard.querySelectorAll('input').forEach(input => input.value = '');

            carGroupContainer.appendChild(newCard);
        });
    </script>
</body>

</html>