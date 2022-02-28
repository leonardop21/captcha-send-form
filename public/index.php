<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrado Captcha v3</title>
    <script src="https://www.google.com/recaptcha/api.js?render=your_site_key"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("your_site_key", {action: 'submit'}).then(function(token) {
                document.getElementById("g-recaptcha").value = token;
            });
        });
    </script>
<body>
    
    <h1>Exemplo de formulário com o Captcha</h1>
		
    <form id="contact-form" action="Submit.php" method="post">
      <input type="text" name="name" placeholder="name"><br><br>
      <input id="phone" type="text" name="phone" placeholder="fone"><br><br>
      <input type="text" name="email" placeholder="email"><br><br>
      <input id="g-recaptcha" name="g_recaptcha_response" value="" />
      <input type="submit" value="Submit" name="formulario">
    </form>
    
</body>
</html>