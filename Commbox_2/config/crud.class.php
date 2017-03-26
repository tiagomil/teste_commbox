<?php

class crud {
  private $sql_ins = "";
  private $tabela = "";
  private $sql_sel = "";

    // Construtor, nome da tabela como parametro           
    public function __construct($tabela) {
      $this->tabela = $tabela;
      return $this->tabela;
    }

    // Funçao de inserçao, campos e seus respectivos valores como parametros        
    public function inserir($campos, $valores) {
      $this->sql_ins = "INSERT INTO " . $this->tabela . " ($campos) VALUES ($valores)";
      if(!$this->ins = mysql_query($this->sql_ins)) {
        die ("<center>Erro na inclusão " . '<br>Linha: ' . __LINE__ . "<br>" . mysql_error() . "<br>
          <a href='index.php'>Voltar ao Menu</a></center>");
      } else {
        echo "<script>location='index.php';</script>";
      }
    }

    // Funçao de ediçao, campos com seus respectivos valores e o campo id que define a linha a ser editada como parametros
    public function atualizar($camposvalores, $where = NULL) {
      if ($where) {
        $this->sql_upd = "UPDATE  " . $this->tabela . " SET $camposvalores WHERE $where";           
      } else {
        $this->sql_upd = "UPDATE  " . $this->tabela . " SET $camposvalores";
      }

      if(!$this->upd = mysql_query($this->sql_upd)) {
        die ("<center>Erro na atualização " . "<br>Linha: " . __LINE__ . "<br>" .mysql_error() . "<br>
          <a href='index.php'>Voltar ao Menu</a></center>");
      } else {
        echo "<center>Registro atualizado com sucesso!<br><a href='index.php'>Voltar ao Menu</a></center>";
      }
    }     

    // Funçao de exclusao, campo que define a linha a ser editada como parametro         
    public function excluir($where = NULL) {
      if ($where) {
        $this->sql_sel = "SELECT * FROM " . $this->tabela . " WHERE $where";
        $this->sql_del = "DELETE FROM " . $this->tabela . " WHERE $where";
      } else {
        $this->sql_sel = "SELECT * FROM " . $this->tabela;
        $this->sql_del = "DELETE FROM " . $this->tabela;
      }
      
      $sel = mysql_query($this->sql_sel);
      $regs = mysql_num_rows($sel);

      if ($regs > 0) {
        if(!$this->del = mysql_query($this->sql_del)) {
          die ("<center>Erro na exclusão " . '<br>Linha: ' . __LINE__ . "<br>" .mysql_error() ."<br>
            <a href='index.php'>Voltar ao Menu</a></center>" );
        } else {
          echo "<center>Registro excluído com sucesso!<br><a href='index.php'>Voltar ao Menu</a></center>";
        }
      } else {
        echo "<center>Registro não encontrado!<br><a href='index.php'>Voltar ao Menu</a></center>";
      }
    }     
  }         

  ?> 