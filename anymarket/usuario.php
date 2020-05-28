<?php
require_once 'header.php';
require 'configApp.php';
?>
    <div class="container" style="padding-top: 20px;">
        <div class="row">
            <div class="col">

            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted col-5"></h6>
                        <ul class="list-group list-group-flush">
                      
                            <li class="list-group-item"><?php echo "<b>Token:</b> {$gumgaToken}" ?></li>
                        </ul>
                       
                    </div>
                </div>
            </div>
  
    </div>
<?php
require_once 'js.php';
require_once 'footer.php';
?>
