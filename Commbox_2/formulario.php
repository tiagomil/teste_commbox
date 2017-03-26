<?php

require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

// Instancia classe de conexao
$con = new conexao();
// Abre conexao com o banco
$con->connect();
// Pega id para ediçao, caso exista
@$getId = $_GET['id'];
// Se existir recupera os dados e tras os campos preenchidos
if(@$getId) {
    $consulta = mysql_query("SELECT * FROM pessoa WHERE id = + $getId");
    $campo = mysql_fetch_array($consulta);
}

// Caso nao seja passado o id via GET, entao cadastra 
if(isset ($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $senha = md5($_POST['senha']);
    $dataNascimento = $_POST['dataNascimento'];
    $cidade = $_POST['cidade'];
    $cpf = $_POST['cpf'];
    $nomeMae = $_POST['nomeMae'];
    $nomePai = $_POST['nomePai'];
    $observacoes = $_POST['observacoes'];
    // Instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud = new crud('pessoa');
    // Utiliza a funçao INSERIR da classe crud
    $crud->inserir("nome, senha, dataNascimento, cidade, cpf, nomeMae, nomePai, observacoes", "'$nome', '$senha', '$dataNascimento', '$cidade', '$cpf', '$nomeMae', '$nomePai', '$observacoes'");

    // Prepara o conteudo para ser gravado em um arquivo txt
    $conteudo = "Nome: $nome\r\nSenha: $senha\r\nData de Nascimento: $dataNascimento\r\nCidade: $cidade\r\nCPF: $cpf\r\nNome da Mãe: $nomeMae\r\nNome do Pai: $nomePai\r\nObservações: $observacoes\r\n\r\n\r\n";
    $arquivo_txt = "registro.txt";

    // Verificaçoo na abertura do arquivo
    if (!$arquivo_txt = fopen($arquivo_txt, "a+")) {
        echo  "Erro abrindo arquivo ($arquivo_txt)";
        exit;
    }

    // Verificaçao no registro de dados do arquivo
    if (!fwrite($arquivo_txt, $conteudo)) {
        echo "Erro escrevendo no arquivo ($arquivo_txt)";
        exit;
    }

    // Fecha o arquivo
    fclose($arquivo_txt);

    header("Location: index.php");
}

// Caso seja passado o id via GET edita 
if(isset ($_POST['editar'])) {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $dataNascimento = $_POST['dataNascimento'];
    $cidade = $_POST['cidade'];
    $cpf = $_POST['cpf'];
    $nomeMae = $_POST['nomeMae'];
    $nomePai = $_POST['nomePai'];
    $observacoes = $_POST['observacoes'];
    // Instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud = new crud('pessoa');
    // Utiliza a funçao ATUALIZAR da classe crud
    $crud->atualizar("nome='$nome', senha='$senha', dataNascimento='$dataNascimento', cidade='$cidade', cpf='$cpf', nomeMae='$nomeMae', nomePai='$nomePai', observacoes='$observacoes'", "id='$getId'");

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Cadastro de Pessoa</title>

        <script>
            // JS para fromataçao dos capos data de nascimento e CPF
            function formatar(mascara, documento){
                var i = documento.value.length;
                var saida = mascara.substring(0,1);
                var texto = mascara.substring(i)

                if (texto.substring(0,1) != saida){
                    documento.value += texto.substring(0,1);
                }
            }
        </script>

    </head>
    <body>
        <form action="" method="post">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo @$campo['nome']; ?>" />
            <br />
            <br />
            <label>Senha:</label>
            <input type="password" name="senha" value="<?php echo @$campo['senha']; ?>" />
            <br />
            <br />
            <label>Data de Nascimento:</label>
            <input type="text" name="dataNascimento" maxlength="10" OnKeyPress="formatar('##/##/####', this)" value="<?php echo @$campo['dataNascimento']; ?>" />
            <br />
            <br />
            <label>Cidade:</label>
            <input type="text" name="cidade" value="<?php echo @$campo['cidade']; ?>" />
            <br />
            <br />
            <label>CPF:</label>
            <input type="text" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" value="<?php echo @$campo['cpf']; ?>" >
            <br />
            <br />
            <label>Nome da Mãe:</label>
            <input type="text" name="nomeMae" value="<?php echo @$campo['nomeMae']; ?>" />
            <br />
            <br />
            <label>Nome do Pai:</label>
            <input type="text" name="nomePai" value="<?php echo @$campo['nomePai']; ?>" />
            <br />
            <br />
            <label>Observações:</label>
            <input type="text" name="observacoes" value="<?php echo @$campo['observacoes']; ?>" />
            <br />
            <br />
            
            <?php if(@!$campo['id']){ ?>
            <input type="submit" name="cadastrar" value="Cadastrar" />
            <?php } else { ?>
            <input type="submit" name="editar" value="Editar" />    
            <?php } ?>

        </form>
    </body>
</html>

<?php $con->disconnect(); ?>