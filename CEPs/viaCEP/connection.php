<?php

    //definindo minha constantes do BD//
    $servername = "localhost";
    $user =  "root";
    $password = "";
    $database = "salvaCEP";

    //Faço conexão com o Banco de dados//
    $conexao = new  mysqli($servername, $user, $password, $database);

    //VERIFICO SE HOUVE ALGUM PROBLEMA COM A CONEXAO//
    if($conexao->connect_error){
        die("Conexão com o Site falhou, tente Novamente mais tarde" . $conexao->connect_error);
    };

