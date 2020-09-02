<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Briografia</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
</head>

<body>
    <?php
    include_once('read.php');
    $buscaBio = new Read();
    $buscaBio->fullRead("SELECT id, nome, estado, biografia, created FROM usuario ORDER BY id DESC");
    $ResultabuscaBio = $buscaBio->getResultado();
    ?>

    <div class="mdl-grid">

        <div class="mdl-cell mdl-cell--12-col" style="text-align:center;">
            <h3>Cadastro de biografia</h3><br>
            <form action="inserirbio.php" method="POST">
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="nome" class="mdl-textfield__input" type="text" maxlength="100" required>
                    <label class="mdl-textfield__label" for="sample1">Seu nome</label>
                </div><br>
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="estado" class="mdl-textfield__input" type="text" maxlength="3" required>
                    <label class="mdl-textfield__label" for="sample1">Estado onde mora</label>
                </div><br>
                <div class="mdl-textfield mdl-js-textfield">
                    <input name="biografia" class="mdl-textfield__input" type="text" maxlength="300" required>
                    <label class="mdl-textfield__label" for="sample1">Sua briografia</label>
                </div><br>
                <input type="submit" value="Cadastrar Bio" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            </form><br>
        </div>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <div class="mdl-cell mdl-cell--12-col" style="text-align:center;">
            <h3>Biografias</h3>
        </div>

        <?php if ($ResultabuscaBio) {

        ?>
            <div class="mdl-cell mdl-cell--12-col">
                <table class="mdl-data-table mdl-js-data-table">
                    <thead>
                        <tr>
                        <th class="mdl-data-table__cell--non-numeric">Criado em</th>
                            <th class="mdl-data-table__cell--non-numeric">ID</th>
                            <th class="mdl-data-table__cell--non-numeric">Nome</th>
                            <th>Estado</th>
                            <th class="mdl-data-table__cell--non-numeric">Biografia</th>
                            <th class="mdl-data-table__cell--non-numeric">Deletar</th>
                            <th class="mdl-data-table__cell--non-numeric">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($ResultabuscaBio as $bio) {
                                extract($bio);
                            ?>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo date('d/m/Y', strtotime($created)); ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $id;  ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $nome;  ?></td>
                                <td><?php echo $estado;  ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $biografia;  ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><a href="<?php echo 'deletarbio.php?id=' . $id ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">X</a></td>
                                <td class="mdl-data-table__cell--non-numeric"><a href="<?php echo 'editarbio.php?id=' . $id ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">Editar</a></td>
                        </tr>
                    <?php
                            } ?>
                    </tbody>
                </table>

            <?php

        } else {
            echo "<div style='background-color:white; height: 200px;' class='container'>";
            echo "<div style='margin-bottom: 0;' class='alert alert-warning text-center'>OBS: Ainda não existe nenhuma biografia cadastrada!</div>";
            echo "</div>";
        }
            ?>
            </div>



            <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>

</html>