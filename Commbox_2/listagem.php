<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

// Instancia classe de conexao
$con = new conexao();
// Abre conexao com o banco
$con->connect();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Listagem</title>
    </head>
    <body>

        <!-- <?php
        /*
        // Testa a conexao
        if($con->connect() == true) {
            echo 'Conectou';
        } else {
            echo 'Não conectou';
        }
        */
        ?> -->
        
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Query que busca todos os dados da tabela PESSOA
                $consulta = mysql_query("SELECT * FROM pessoa");
                // Laço de repetiçao que vai trazer todos os resultados da consulta
                while($campo = mysql_fetch_array($consulta)) {
                ?>

                <tr>
                    <td>
                        <!-- Mostrando o campo NOME da tabela -->
                        <?php echo $campo['nome']; ?>
                    </td>
                    <td>
                        <!-- Mostrando o campo CPF da tabela -->
                        <?php echo $campo['cpf']; ?>
                    </td>
                    <td>
                        <!-- Pega o campo ID para a ediçao -->
                        <a href="formulario.php?id=<?php echo $campo['id']; ?>">Editar</a>
                    </td>
                    <td>
                        <!-- Pega o campo ID para a exclusao -->
                        <a href="excluir.php?id=<?php echo $campo['id']; ?>">Excluir</a>
                    </td>
                </tr>

                <?php } ?>

            </tbody>
        </table>
    </body>
</html>

<?php $con->disconnect(); // Fecha conexao com o banco ?> 