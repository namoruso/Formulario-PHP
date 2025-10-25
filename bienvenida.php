<?php
session_start();

if (isset($_POST['cerrar_sesion'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$nombre_usuario = $_SESSION['usuario_nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Hallownest</title>
    <link rel="stylesheet" href="css/hollow.css">
</head>
<body>
    <div class="container-hollow">
        <header class="header">
            <div class="user-info">
                <span class="welcome">Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></span>
                <form method="POST" style="margin: 0;">
                    <button type="submit" name="cerrar_sesion" class="logout-btn">Cerrar Sesión</button>
                </form>
            </div>
        </header>

        <div class="content">
            <div class="title-section">
                <h1 class="game-title">HOLLOW KNIGHT</h1>
                <p class="subtitle">Explora las profundidades de Hallownest</p>
            </div>

            <div class="cards-container">
                <div class="card">
                    <div class="card-image">
                        <img src="img/knight.png" alt="El Caballero">
                    </div>
                    <h3>El Caballero</h3>
                    <p>Un pequeño vagabundo desciende a las ruinas olvidadas de Hallownest, un reino antiguo y misterioso.</p>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="img/infection.png" alt="La Infección">
                    </div>
                    <h3>La Infección</h3>
                    <p>Una plaga misteriosa ha consumido el reino subterráneo, corrompiendo a sus habitantes.</p>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="img/pale-king.png" alt="El Rey Pálido">
                    </div>
                    <h3>El Rey Pálido</h3>
                    <p>El antiguo gobernante de Hallownest dejó un legado de secretos y sacrificios.</p>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="img/nail.png" alt="Maestros del Clavo">
                    </div>
                    <h3>Maestros del Clavo</h3>
                    <p>Domina el arte del combate y enfrenta a poderosos jefes en tu camino.</p>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="img/dream.png" alt="Esencia de Ensueño">
                    </div>
                    <h3>Esencia de Ensueño</h3>
                    <p>Explora los sueños de los habitantes y descubre secretos ocultos del pasado.</p>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="img/radiance.png" alt="La Radiancia">
                    </div>
                    <h3>La Radiancia</h3>
                    <p>La fuente primordial de la infección aguarda en lo más profundo de los sueños.</p>
                </div>

                <div class="card">
                    <div class="card-image">
                        <img src="https://fbi.cults3d.com/uploaders/29497180/illustration-file/287f5112-a42a-4b81-a2f6-e82e759f279f/3-days-gentlemen-thats-72-hours-v0-5sv62f7ealmf1.webp" alt="La Radiancia">
                    </div>
                    <h3>Cilantro</h3>
                    <p>El cilantro es una hierba aromática de la familia de las apiáceas, conocida por sus hojas y semillas con sabor y aroma distintivos, que van del cítrico al picante. Se utiliza ampliamente en diversas cocinas, como la mexicana, la india y la latinoamericana, para realzar el sabor de carnes, caldos, salsas y ensaladas. .</p>
                </div>
            </div>

            <div class="quote-section">
                <blockquote>
                    "Sin mente para pensar, sin voluntad que quebrar, sin voz que grite de sufrimiento. Sellarás la luz cegadora que asola sus sueños. Eres el Receptáculo. Eres el Hollow Knight."
                    <footer>— Rey Pálido</footer>
                </blockquote>
            </div>
        </div>
    </div>
</body>
</html>