<!DOCTYPE html>
<html lang="sk">
<head>
  <?php include("shared/head.html"); ?>
</head>

<body>
	<header>
    <?php include("shared/header.html"); ?>
	</header>

  <div class="content">
    <h3>Tomáš Lokša</h3>
    <address>
      <p><b>Tel:</b> <a href="mailto:tomas.loksa@outlook.com">tomas.loksa@outlook.com</a></p>
      <p><b>Mail:</b> <a href="tel:+421950607760">0950 607 760</a></p>
      
      <p><b>Adresa:</b><br>
        Rudina 500, <br>
        023 31 Rudina</p>
      <p><b>IČO:</b> 51948389</p>
    </address>

    <div class="contact-form">
      <h3>Kontaktný formulár</h3>
      <form>
        <label for="name">Meno:</label><br>
        <input type="text" id="name" name="name"><br>

        <label for="contact">Kontakt:</label><br>
        <input type="text" id="contact" name="contact"><br>

        <label for="message">Správa:</label><br>
        <textarea id="message" name="message"></textarea><br>

        <input type="submit" value="Odoslať">
      </form>
    </div>
  </div>

	<footer>
    <?php include("shared/footer.html"); ?>
	</footer>
</body>
</html>