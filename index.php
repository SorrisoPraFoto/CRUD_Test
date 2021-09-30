<?php

function callAPI($url){
    $ch = curl_init();
    $header = array(
        "Accept: application/vnd.github.v3+json",
        "User-Agent: API_CRUD/1.0"
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $result=curl_exec($ch);
    $arr = json_decode($result, true);

    return $arr;
}

function inserirDB($username, $email, $localizacao){
    $db = new PDO("mysql:host=$nomeHost;dbname=NOME_DA_DB", $user, $pwd);
    $query = "INSERT INTO users (email, localizacao) VALUES ({$email}, {$localizacao} WHERE user = {$username})";
    if ($db->query($query)) {
        header("HTTP/1.1 201 Created");
        echo json_encode("Usuario inserido no banco de dados");
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode("Erro na insercao do banco de dados");
    }
}

if (isset($_GET['nome'])){
    $response = callAPI("https://api.github.com/users/{$_GET['nome']}");
    if (isset($response['login'])){
        if ($response['email'] == null){
            $email = $_GET['email'];
        } else {
            $email = $response['email'];
        }

        if ($response['location'] == null){
            $localizacao = $_GET['localizacao'];
        } else {
            $localizacao = $response['location'];
        }

        // inserirDB($response['login'], $email, $localizacao) para inserir no banco de dados

        // Função a seguir para verificar retorno
        if (TRUE) // Caso a inserção no banco de dados dê certo
        {
            header("HTTP/1.1 201 Created");
            echo json_encode("Usuario {$response['login']} com email: {$email} e localizacao: {$localizacao} foi inserido no banco de dados");
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode("Erro na insercao do banco de dados");
        }
    } else {
        header("HTTP/1.1 404 Not found");
        echo json_encode("Usuario nao encontrado no github");
    }
} else {
    header("HTTP/1.1 404 Not found");
    echo json_encode("Especifique um usuario");
}

?>