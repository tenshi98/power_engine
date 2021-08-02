<link rel="stylesheet" href="<?php echo DB_SITE_REPO ?>/LIBS_js/avgrund/style.css">
<link rel="stylesheet" href="<?php echo DB_SITE_REPO ?>/LIBS_js/avgrund/avgrund.css">
<script src="<?php echo DB_SITE_REPO ?>/LIBS_js/avgrund/jquery.avgrund.js"></script>
<script>
	
function dialogBox(direccion, mensaje){
	
	$(document).avgrund({
		openOnEvent: false,
		height: 200,
		holderClass: 'custom',
		showClose: true,
		showCloseText: 'Cerrar',
		onBlurContainer: '#wrap',
		template: '<p><i class="fa fa-warning fa-2x faa-flash animated" aria-hidden="true" style="color: #ED5E2F;"></i> '+mensaje+'</p>' +
		'<div class="to_bottom">' +
		'<a href="'+ direccion +'" class="btn_ok">Aceptar</a>' +
		'<a href="#" class="btn_cancel avgrund-cierra">Cancelar</a>' +
		'</div>'
	});
	
}

	

</script>
