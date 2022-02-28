
# Captcha and submit form landing page

Integrando formulário com o captcha invísivel (v3) - e enviando e-mails, utilizado em Landing pages

- Verifica se a mensagem é spam através do captcha (v3)
- Envia e-mail através do PHPMailer

Livre para ser utilzado, baixado e alterado.


Cadastre o site no Captcha: https://www.google.com/recaptcha/admin/


## Rodando localmente

Clone o projeto
```bash

  git clone https://github.com/leonardop21/captcha-send-form
```

Entre no diretório do projeto

```bash
  cd captcha-send-form
```

Instale as dependências
```bash
  composer install
```

```bash
No arquivo /Captcha/Captcha.php preencha $privateKey
```

```bash
No arquivo /form/Submit.php preencha: Host, Username, Password, setFrom, addAddress (Altere os campos como desejar)
```


```bash
No arquivo /public/index.php preencha:  your_site_key com a chave gerada no captcha
```


aponte o nginx/apache para ler a partir do diretório /public, inicie seu servidor PHP


Pronto, divirta-se!

