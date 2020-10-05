<?php
// Sessão
if(isset($_SESSION['mensagem'])): ?>	

<script>
	$(document).ready(function() {
		// show when page load
		toastr.info('Hey - it works!');
	});
  </script>

<?php
endif;
?>

