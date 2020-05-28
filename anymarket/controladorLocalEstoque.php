
<?php
require_once 'lib/Anymarket/anymarket.php';
require_once 'configApp.php';

$acao = "";

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    parse_str(file_get_contents("php://input"), $post_vars);
    $acao = $post_vars['acao'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'];
} else
    $acao = $_REQUEST['acao'];

    $anymarket = new Anymarket($gumgaToken);

switch ($acao) {

    case 'I':
    case 'U':

        $id = "";

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

            parse_str(file_get_contents("php://input"), $post_vars);

            $id = $post_vars["id"];
            $nome = $post_vars["nome"];
            $zipCode = $post_vars["zipCode"];
            $virtual = $post_vars["virtual"];
            $defaultLocal = $post_vars["defaultLocal"];
        } else {

            $nome = $_REQUEST["nome"];
            $zipCode = $_REQUEST["zipCode"];
            $virtual = $_REQUEST["virtual"];
            $defaultLocal = $_REQUEST["defaultLocal"];
        }

        $localEstoque = [

            "id" => $id,
            "name" => $nome,
            "virtual" => $virtual,
            "defaultLocal" => $defaultLocal,
            "zipCode" => $zipCode
        ];

        if ($acao == 'I') {

            try {

                $response = $anymarket->post('/stocks/locals', $localEstoque);

                print_r(json_encode($response));
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        } else {

            try {

                $response = $anymarket->put('/stocks/locals/' . $localEstoque['id'], $localEstoque);

                print_r(json_encode($response));
            } catch (Exception $e) {
                print_r(json_encode($e->getMessage()));
            }
        }
        break;
    case 'D':
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

            parse_str(file_get_contents("php://input"), $post_vars);
            $id = $post_vars["id"];
        } else     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST["id"];
        }else{
            $id = $_REQUEST["id"];
        }

        $response = $anymarket->delete('/stocks/locals/' . $id);
        //echo $response;
        echo json_encode($response);
        break;
}

?>

