<?php
require_once 'header.php';
?>

<div class="container" style="padding-top: 20px;">
<div class="jumbotron">
  <h1 class="display-4"> Teste integração anymarket</h1>
  <p class="lead">Esse site foi desenvolvido para realizar testes utilizando o php.</p>
  <hr class="my-4">
  <p>Para começar cadastrando um lugar de estoque clique no botão abaixo.</p>
  <p class="lead">
    <a class="btn btn-success btn-lg" href="add-local-estoque.php" role="button">Cadastrar local de estoque</a>
    <a class="btn btn-primary btn-lg" href="list-local-estoque.php" role="button">Lista local de estoque</a>
  </p>
</div>
</div>
<?php
require_once 'js.php';
?>
<script>
    $(document).ready(function() {

      
    });
</script>
<?php
require_once 'footer.php';
?>