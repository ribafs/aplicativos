<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Encomendas
{
    // ================================================================
    public function guardar_encomenda($dados_encomenda, $dados_produtos)
    {

        $bd = new Database();

        // -----------------------------------------------------
        // guardar os dados da encomenda
        $parametros = [
            ':id_cliente' => $_SESSION['cliente'],
            ':morada' => $dados_encomenda['morada'],
            ':cidade' => $dados_encomenda['cidade'],
            ':email' => $dados_encomenda['email'],
            ':telefone' => $dados_encomenda['telefone'],
            ':codigo_encomenda' => $dados_encomenda['codigo_encomenda'],
            ':status' => $dados_encomenda['status'],
            ':mensagem' => $dados_encomenda['mensagem']
        ];
        $bd->insert("
            INSERT INTO encomendas VALUES(
                0,
                :id_cliente,
                NOW(),
                :morada,
                :cidade,
                :email,
                :telefone,
                :codigo_encomenda,
                :status,
                :mensagem,
                NOW(),
                NOW()
            )
        ", $parametros);

        // buscar o id_encomenda
        $id_encomenda = $bd->select("
            SELECT MAX(id_encomenda) id_encomenda 
            FROM encomendas
        ")[0]->id_encomenda;

        // -----------------------------------------------
        // guardar os dados dos produtos
        foreach ($dados_produtos as $produto) {
            $parametros = [
                ':id_encomenda' => $id_encomenda,
                ':designacao_produto' => $produto['designacao_produto'],
                ':preco_unidade' => $produto['preco_unidade'],
                ':quantidade' => $produto['quantidade'],
            ];

            $bd->insert("
            INSERT INTO encomenda_produto VALUES(
                0,
                :id_encomenda,
                :designacao_produto,
                :preco_unidade,
                :quantidade,
                NOW()
            )", $parametros);
        }
    }

    // ================================================================
    public function buscar_historico_encomendas($id_cliente)
    {
        // buscar o histório de encomendas do cliente = id_cliente
        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $bd = new Database();
        $resultados = $bd->select("
            SELECT id_encomenda, data_encomenda, codigo_encomenda, status
            FROM encomendas
            WHERE id_cliente = :id_cliente
            ORDER BY data_encomenda DESC
        ", $parametros);

        return $resultados;
    }
}