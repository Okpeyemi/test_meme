<?php
  require_once("./database.php");

if(isset($_POST['addimage'])){
  if(isset($_FILES['image'])){

    $dataImage = [
      'img_link' => 'images/' . $_FILES['image']['name'],
      'img_file' => $_FILES['image']['tmp_name'],
  ];

    $data = [
        'img_link' => $dataImage['img_link'],
    ];

    move_uploaded_file($dataImage['img_file'], $dataImage['img_link']);

    $sql = "INSERT INTO images (lien) VALUES ('" . $dataImage['img_link'] . "')";
        if ($db->query($sql) === TRUE) {
            echo "L'image a été téléchargée avec succès.";
        } else {
            echo "Erreur: " . $sql . "<br>";
        }
    
  } else {
    echo "Aucun fichier n'a été téléchargé.";
  }
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Générateur de Mèmes | Acceuil</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="cont">
      <div class="nav">
        <div class="brand">
          <h1>Générateur de Mèmes</h1>
        </div>
        <div class="menu">
          <a class="active" href="index.php">Acceuil</a>
          <a href="gallerie.php">Gallerie</a>
        </div>
      </div>
    </div>
    <div class="meme-generator">
      <form action="" method="post" enctype="multipart/form-data">
        <div>
        <label>Select an Image</label>
        <input type="file" id="imageFileInput" accept="image/png, image/jpeg" name="image" />
        </div>
        <div class="in">
          <div class="input">
            <label>Top Text</label>
            <input type="text" id="topTextInput" />
          </div>
          <div class="input">
            <label>Bottom Text</label>
            <input type="text" id="bottomTextInput" />
          </div>
        </div>
        <div class="col">
          <div class="color">
            <label>Text Color</label>
            <input type="color" id="textColorInput" value="#000000" />
          </div>
          <div class="borderColor">
            <label>Text Border Color</label>
            <input type="color" id="textBorderColorInput" value="#ffffff" />
          </div>
        </div>

        <canvas id="meme" style="display: none;"></canvas>

        <div class="but" style="display: none;">
          <button id="downloadButton">Download Meme</button>
          <button type="submit" name="addimage">Enregistrer dans la base de données</button>
        </div>
      </form>
    </div>
    <footer>
      <h3>Réaliser par Maqsoud TAWALIOU | maqsoudt9@gmail.com</h3>
    </footer>
    <script src="meme.js"></script>
    <script src="emoji.js"></script>
    <script>
      new EmojiPicker({
        trigger: [
          {
            selector: ".btn1",
            insertInto: ["#topTextInput"],
          },
          {
            selector: ".btn2",
            insertInto: ["#bottomTextInput"],
          },
        ],
        closeButton: true,
        dragButton: true,
      });
    </script>
  </body>
</html>
