# CRUD_Test
Simples Rest API que salva o email, localização e username de acordo com cada usuário do github

<h1>Execução</h1>

Para setup, basta usar um Shell ou Prompt e iniciar o Apache do index.php

E para execução, enviar uma request em GET para o domínio com o seu apache ligado, exemplo:

localhost:8080/index.php?nome=NOME_DO_USUARIO&email=EMAIL_DO_USUARIO&localizacao=LOCALIZACAO_DO_USUARIO

Onde tem os campos de request com:

nome
email
localizacao

O campo de nome é obrigatório para a requisição funcionar.
