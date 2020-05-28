<?php
require_once 'header.php';
?>
<div class="container" style="padding-top: 20px;">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de local de stock</h5>
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <form method="post" id="product">
                                        <div class="form-group">
                                            <label class="control-label" for="title">
                                                Nome
                                            </label>
                                            <input class="form-control" id="nome" name="nome" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="title">
                                                ZipCode
                                            </label>
                                            <input class="form-control" id="zipCode" name="zipCode" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" class="" id="ckVirtual">
                                            <label class="" for="defaultUnchecked">Virtual</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="checkbox" class="" id="ckDefaultLocal">
                                            <label class="" for="defaultUnchecked">DefaultLocal</label>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div>
                                                <button class="btn btn-primary " id="addprod" type="button">
                                                    Cadastrar
                                                </button>
                                                <a class="btn btn-dark" href="list-local-estoque.php">
                                                    Voltar
                                                </a>
                                                <br> <br>
                                                <small id="ltypeHelp" class="form-text text-muted">
                                                    <a href=" http://developers.anymarket.com.br/v2/index.html#!/Local_de_Estoque">
                                                        Consulte todos em: http://developers.anymarket.com.br/v2/index.html#!/Local_de_Estoque
                                                    </a>
                                                </small>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'js.php';
?>
<script>
    $(document).ready(function() {

        $("#addprod").on('click', function() {

            var nome = $("#nome").val();
            var zipCode = $("#zipCode").val();
            var ckVirtual = $('#ckVirtual').is(':checked');
            var ckDefaultLocal = $('#ckDefaultLocal').is(':checked');

            console.log(nome, zipCode, ckVirtual, ckDefaultLocal);

                        var url = "controladorLocalEstoque.php";
                        $.ajax({
                            method: "POST",
                            url: url,
                            async: false,
                            cache: false,
                            data: {           
                                "acao": "I",
                                "nome":nome,
                                "zipCode": zipCode,
                                "defaultLocal": ckDefaultLocal,
                                "virtual": ckVirtual
                            },
                            success: function(data) {
                             
                                var respose = JSON.parse(data);
                                if(respose.httpCode == 200){
                                    alert("cadastrado com sucesso");
                                }else{
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
    });
</script>
<?php
require_once 'footer.php';
?>