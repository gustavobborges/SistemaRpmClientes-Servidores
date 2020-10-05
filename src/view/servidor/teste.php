<?php
include_once '../../model/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="../../../js/jquery.js"></script>

</head>

<body>




    <div>
        <label for="clientlist">Selecione o Cliente: </label>
        <select name="clientlist" id="clientlist">
            <option>-- Selecione --</option>
            <?php
                $sql = "SELECT * FROM CLIENTE ";
                $resultado = mysqli_query($connect, $sql);
                while ($posicao=mysqli_fetch_row($resultado)) {
                    $vnome=$posicao[2];
                    $vid=$posicao[0];
                    echo "<option value=$vid>$vnome</option>";
                }
            ?>
        </select>
    </div>
    <div>
        <label for="servicos">Selecione o Serviço: </label>
        <select id="servicos" name="servicos" style="display: none">
            <option>-- Selecione --</option>

        </select>

        <script>
        $(function() {
            $("#clientlist").on("change", function() {
                $.ajax({
                    url: 'pegarservicos.php',
                    type: 'POST',
                    data: {
                        id: $("#clientlist").val()
                    },
                    beforeSend: function() {
                        $("#servicos").css({
                            'display': 'block'
                        });
                        $("#servicos").html("Carregando...");
                    },
                    success: function(data) {
                        $("#servicos").css({
                            'display': 'block'
                        });
                        $("#servicos").html(data);
                    },
                    error: function(data) {
                        $("#servicos").css({
                            'display': 'block'
                        });
                        $("#servicos").html("Houve um erro ao carregar");
                    }
                });
            });
        });
        </script>


</body>

</html>


<script type="text/javascript" src="../../../js/jquery.js">
</script>