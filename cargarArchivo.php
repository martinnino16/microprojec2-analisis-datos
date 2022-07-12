<div id="wrapper">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">MicroProject2</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php
                    $j = 0;
                    foreach ($tabs as $tab) {
                        echo '<li class="nav-item"><a class="nav-link" href="#">' . $tab . '</a></li>';
                        $j++;
                    }
                    ?>
                    <li class="nav-item"><a class="nav-link" href="#">Cargar Archivo</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container my-5">
        <div class="col-12">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <div class="flex-center">Cargar Archivo de Configuración</div>
                    <div class="flex-center">
                        <input type="file" name="file_upload" accept=".csv" />
                    </div>
                </div>
                <div class="div-btn-upl">
                    <button class="button">Cargar</button>
                </div>
            </form>
        </div>
    </div>