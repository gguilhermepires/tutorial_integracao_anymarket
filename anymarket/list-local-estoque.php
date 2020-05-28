<?php
require_once 'header.php';
require_once 'lib/Anymarket/anymarket.php';
require 'configApp.php';
?>

<?php

$anymarket = new Anymarket($gumgaToken);
$response = $anymarket->get('/stocks/locals', array('gumgaToken' => $gumgaToken));

$list = array();

foreach ($response['body'] as $value) {

    if ($value->id) {

        $zipCode = "";

        if (isset($value->zipCode))
            $zipCode = $value->zipCode;

        $local = [
            "id" => $value->id,
            "name" => $value->name,
            "zipCode" => $zipCode,
            "virtual" => $value->virtual,
            "defaultLocal" => $value->defaultLocal
        ];

        if (!empty($local)) $list[] = $local;
    }
}

?>
<div class="container" style="padding-top: 20px;">
    <div class="row">
        <?php if (!empty($list)) : ?>
            <?php foreach ($list as $local) : ?>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                    <div class="card" style="text-align: center; margin-top: 10px;">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $local['name'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $local['id'] ?></a>
                            </h6>

                            <p class="card-text">ZipCode: <?php if (isset($local['zipCode'])) echo $local['zipCode'] ?></p>

                            <div style="padding: 10px;">
                                <a href="edit-local-estoque.php?<?php
                                                                echo "id=" . $local['id'];
                                                                echo "&nome=" . $local['name'];
                                                                echo "&zipCode=" . $local['zipCode'];
                                                                echo "&virtual=" . $local['virtual'];
                                                                echo "&defaultLocal=" . $local['defaultLocal'];
                                                                ?>" class="card-link">Mais
                                    detalhes</a>
                            </div>

                            <div style="padding: 50px;">
                                <form id="myForm" action="controladorLocalEstoque.php" method="POST">
                                    <input type="hidden" id="id" name="id" value="<?php echo $local['id'] ?>">
                                    <input type="hidden" id="acao" name="acao" value="D">
                                    <button class="btn btn-danger " id="btExcluir" type="submit">
                                        Excluir
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else : ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nenhum local de estoque por enquanto!</h5>
                    <div style="padding: 10px;">
                        <a href="add-product.php" target="_blank" class="card-link">Clique aqui para criar um
                            anúncio rápido</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'js.php'; ?>

<script>
    $(document).on("submit", "form", function(event) {
        event.preventDefault();

        var url = $(this).attr("action");
        console.log(url);

        var url = "controladorLocalEstoque.php";
        $.ajax({
            method: "POST",
            url: url,
            async: false,
            cache: false,
            data: {
                "acao": "D",
                "id":  this.elements[0].value

            },
            success: function(data) {
                console.log(data);
                var respose = JSON.parse(data);
                if (respose.httpCode == 200) {
                    alert("Excluido com sucesso");
                    document.location.reload(true);
                } else {
                    alert(`Erro ${respose.body.code} : ${respose.body.message}`)
                }
            },
            error: function(data) {
                alert("Erro, verifique os detalhes do erro no console do navegador em modo desenvolvedor(F12)");
                console.log(data);
                return false;
            }
        });

    });
</script>

<?php require_once 'footer.php'; ?>