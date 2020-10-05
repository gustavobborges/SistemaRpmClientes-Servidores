</div>

<?php 
if(isset($_GET['ok'])) {
?>
<script>
$(document).ready(function() {
    // show when page load
    toastr.success('Registrado!');
});
</script>
<?php
}
?>
<?php 
if(isset($_GET['error'])) {
?>
<script>
$(document).ready(function() {
    // show when page load
    toastr.error('Erro ao registrar!');
});
</script>
<?php
}
?>
        <?php 
if(isset($_GET['del'])) {
?>
<script>
$(document).ready(function() {
    // show when page load
    toastr.success('Excluído com sucesso!');
});
</script>
<?php
}
?>
<?php 
if(isset($_GET['errordel'])) {
?>
<script>
$(document).ready(function() {
    // show when page load
    toastr.error('Erro ao excluir!');

});
</script>
<?php
}
?>

<?php 
if(isset($_GET['fc'])) {
?>
<script>
$(document).ready(function() {
    // show when page load
    toastr.error('O campo Nome é obrigatório!');

});
</script>
<?php
}
?>

<?php 
if(isset($_GET['fcontatot'])) {
?>
<script>
$(document).ready(function() {
    // show when page load
    toastr.error('Os campos Nome e Clientes são obrigatórios!');

});
</script>
<?php
}
?>

<?php 
if(isset($_GET['fservidort'])) {
?>
<script>
$(document).ready(function() {
    // show when page load
    toastr.error('Todos os campos são obrigatórios!');

});
</script>
<?php
}
?>