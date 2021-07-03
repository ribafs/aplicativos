<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;
use core\models\Encomendas;

class Main
{

    // ===========================================================
    public function index()
    {

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'inicio',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ===========================================================
    public function loja()
    {

        // apresenta a página da loja

        // buscar a lista de produtos disponíveis
        $produtos = new Produtos();

        // analisa que categoria mostrar
        $c = 'todos';
        if(isset($_GET['c'])){
            $c = $_GET['c'];
        }

        // buscar informação à base de dados
        $lista_produtos = $produtos->lista_produtos_disponiveis($c);
        $lista_categorias = $produtos->lista_categorias();

        $dados = [
            'produtos' => $lista_produtos,
            'categorias' => $lista_categorias
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    // ===========================================================
    public function novo_cliente()
    {

        // verifica se já existe sessão aberta
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // apresenta o layout para criar um novo utilizador
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'criar_cliente',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ===========================================================
    public function criar_cliente()
    {

        // verifica se já existe sessao
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // verifica se houve submissão de um formulário
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // verifica se senha 1 = senha 2
        if ($_POST['text_senha_1'] !== $_POST['text_senha_2']) {

            // as passwords são diferentes
            $_SESSION['erro'] = 'As senhas não estão iguais.';
            $this->novo_cliente();
            return;
        }

        // verifica na base de dados se existe cliente com mesmo email
        $cliente = new Clientes();

        if ($cliente->verificar_email_existe($_POST['text_email'])) {

            $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
            $this->novo_cliente();
            return;
        }

        // inserir novo cliente na base de dados e devolver o purl
        $email_cliente = strtolower(trim($_POST['text_email']));
        $purl = $cliente->registar_cliente();

        // envio do email para o cliente
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_novo_cliente($email_cliente, $purl);

        if ($resultado) {

            // apresenta o layout para informar o envio do email
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {
            echo 'Aconteceu um erro';
        }
    }

    // ===========================================================
    public function confirmar_email()
    {

        // verifica se já existe sessao
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // verificar se existe na query string um purl
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

        // verifica se o purl é válido
        if (strlen($purl) != 12) {
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado = $cliente->validar_email($purl);

        if ($resultado) {

            // apresenta o layout para informar a conta foi confirmada com sucesso
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'conta_confirmada_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {

            // redirecionar para a página inicial
            Store::redirect();
        }
    }

    // ===========================================================
    public function login()
    {

        // verifica se já existe um utilizador logado
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // apresentação do formulário de login
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login_frm',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ===========================================================
    public function login_submit()
    {

        // verifica se já existe um utilizador logado
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // verifica se foi efetuado o post do formulário de login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        // validar se os campos vieram corretamente preenchidos
        if (
            !isset($_POST['text_usuario']) ||
            !isset($_POST['text_senha']) ||
            !filter_var(trim($_POST['text_usuario']), FILTER_VALIDATE_EMAIL)
        ) {
            // erro de preenchimento do formulário
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }

        // prepara os dados para o model
        $usuario = trim(strtolower($_POST['text_usuario']));
        $senha = trim($_POST['text_senha']);

        // carrega o model e verifica se login é válido
        $cliente = new Clientes();
        $resultado = $cliente->validar_login($usuario, $senha);

        // analisa o resultado
        if(is_bool($resultado)){
         
            // login inválido
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;

        } else {

            // login válido. Coloca os dados na sessão
            $_SESSION['cliente'] = $resultado->id_cliente;
            $_SESSION['usuario'] = $resultado->email;
            $_SESSION['nome_cliente'] = $resultado->nome_completo;

            // redirecionar para o local correto
            if(isset($_SESSION['tmp_carrinho'])){
                
                // remove a variável temporária da sessão
                unset($_SESSION['tmp_carrinho']);

                // redireciona para resumo da encomenda
                Store::redirect('finalizar_encomenda_resumo');

            } else {

                // redirectionamento para a loja
                Store::redirect();
            }
        }
    }

    // ===========================================================
    public function logout(){

        // remove as variáveis da sessão
        unset($_SESSION['cliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome_cliente']);

        // redireciona para o início da loja
        Store::redirect();
    }


    // ===========================================================
    // PERFIL DO USUÁRIO
    // ===========================================================
    public function perfil(){

        // verifica se existe um utilizador logado
        if(!Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // buscar informações do client
        $cliente = new Clientes();
        $dtemp = $cliente->buscar_dados_cliente($_SESSION['cliente']);
        
        $dados_cliente = [
            'Email' => $dtemp->email,
            'Nome completo' => $dtemp->nome_completo,
            'Morada' => $dtemp->morada,
            'Cidade' => $dtemp->cidade,
            'Telefone' => $dtemp->telefone
        ];

        $dados = [
            'dados_cliente' => $dados_cliente
        ];

        // apresentação da página de perfil
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'perfil',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);

    }


    // ===========================================================
    public function alterar_dados_pessoais()
    {
        // verifica se existe um utilizador logado
        if(!Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // vai buscar os dados pessoais
        $cliente = new Clientes();
        $dados = [
            'dados_pessoais' => $cliente->buscar_dados_cliente($_SESSION['cliente'])
        ];

        // apresentação da página de perfil
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'alterar_dados_pessoais',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    // ===========================================================
    public function alterar_dados_pessoais_submit()
    {
        // verifica se existe um utilizador logado
        if(!Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // verifica se existiu submissão de formulário
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            Store::redirect();
            return;
        }

        // validar dados
        $email = trim(strtolower($_POST['text_email']));
        $nome_completo = trim($_POST['text_nome_completo']);
        $morada = trim($_POST['text_morada']);
        $cidade = trim($_POST['text_cidade']);
        $telefone = trim($_POST['text_telefone']);

        // validar se é email válido
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['erro'] = "Endereço de email inválido.";
            $this->alterar_dados_pessoais();
            return;
        }

        // validar rapidamente os restantes campos
        if(empty($nome_completo) || empty($morada) || empty($cidade)){
            $_SESSION['erro'] = "Preencha corretamente o formulário.";
            $this->alterar_dados_pessoais();
            return;
        }

        // validar se este email já existe noutra conta de cliente
        $cliente = new Clientes();
        $existe_noutra_conta = $cliente->verificar_se_email_existe_noutra_conta($_SESSION['cliente'], $email);
        if($existe_noutra_conta){
            $_SESSION['erro'] = "O email já pertence a outro cliente.";
            $this->alterar_dados_pessoais();
            return;
        }

        // atualizar os dados do cliente na base de dados
        $cliente->atualizar_dados_cliente($email, $nome_completo, $morada, $cidade, $telefone);

        // atualizar os dados do cliente na sessao
        $_SESSION['usuario'] = $email;
        $_SESSION['nome_cliente'] = $nome_completo; 

        // redirecionar para a página do perfil
        Store::redirect('perfil');
    }

    // ===========================================================
    public function alterar_password()
    {
        // verifica se existe um utilizador logado
        if(!Store::clienteLogado()) {
            Store::redirect();
            return;
        }        

        // apresentação da página de alteração da password
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'alterar_password',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ===========================================================
    public function alterar_password_submit()
    {
        // verifica se existe um utilizador logado
        if(!Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // verifica se existiu submissão de formulário
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            Store::redirect();
            return;
        }

        // validar dados
        $senha_atual = trim($_POST['text_senha_atual']);
        $nova_senha = trim($_POST['text_nova_senha']);
        $repetir_nova_senha = trim($_POST['text_repetir_nova_senha']);

        // validar se a nova senha vem com dados
        if(strlen($nova_senha) < 6){
            $_SESSION['erro'] = "Indique a nova senha e a repetição da nova senha.";
            $this->alterar_password();
            return;
        }

        // verificar se a nova senha a a sua repetição coincidem
        if($nova_senha != $repetir_nova_senha){
            $_SESSION['erro'] = "A nova senha e a sua repetição não são iguais.";
            $this->alterar_password();
            return;
        }

        // verificar se a senha atual está correta
        $cliente = new Clientes();
        if(!$cliente->ver_se_senha_esta_correta($_SESSION['cliente'], $senha_atual)){
            $_SESSION['erro'] = "A senha atual está errada.";
            $this->alterar_password();
            return;
        }

        // verificar se a nova senha é diferente da senha atual
        if($senha_atual == $nova_senha){
            $_SESSION['erro'] = "A nova senha é igual à senha atual.";
            $this->alterar_password();
            return;
        }

        // atualizar a nova senha
        $cliente->atualizar_a_nova_senha($_SESSION['cliente'], $nova_senha);

        // redirecionar para a página do perfil
        Store::redirect('perfil');
    }

    // ===========================================================
    public function historico_encomendas()
    {
        // verifica se existe um utilizador logado
        if(!Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // carrega o histórico das encomendas
        $encomendas = new Encomendas();
        $historico_encomendas = $encomendas->buscar_historico_encomendas($_SESSION['cliente']);

        // Store::printData($historico_encomendas);

        $data = [
            'historico_encomendas' => $historico_encomendas
        ];

        // apresentar a view com o histórico das encomendas
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'historico_encomendas',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    // ===========================================================
    public function historico_encomendas_detalhe(){

        echo 'teste!!!!!!';

    }



}
