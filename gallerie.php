<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Mèmes | Gallerie</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="cont">
      <div class="nav">
        <div class="brand">
          <h1>Générateur de Mèmes</h1>
        </div>
        <div class="menu">
          <a href="index.php">Acceuil</a>
          <a class="active" href="gallerie.php">Gallerie</a>
        </div>
      </div>
    </div>
    <div class="ingallerie">
        <div class="gallerie-row">
            <?php
                require_once('./database.php');
                $sql = 'SELECT * FROM images';
                $query = $db->prepare($sql);
                $query->execute();

                if ($query->rowCount() > 0) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="gallerie-item">
                <img id="img" src="<?php echo $row["lien"]; ?>" alt="" width="100%" height="100%">
                <div class="partage">
                    <button class="download-button" onclick="downloadImage('<?php echo $row["lien"]; ?>')">Télécharger</button>
                    <a class="social-share1" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($row["lien"]); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a class="social-share2" href="whatsapp://send?text=<?php echo urlencode($row["lien"]); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "No company found.";
                }
            ?>
        </div>
    </div>
    <footer>
      <h3>Réaliser par Maqsoud TAWALIOU | maqsoudt9@gmail.com</h3>
    </footer>
    <script>
        function downloadImage(imageUrl) {
            var link = document.createElement('a');
            link.href = imageUrl;
            link.download = 'image.jpg';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>