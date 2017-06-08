jQuery(document).ready(function($) {
	$('.validate-input').on('blur', function(event) {
		emptyMsg($(this));
	});
	$('select.validate-input').on('change', function(event) {
		emptyMsg($(this));
	});
	$('.btn-send-form').on('click', function(event) {
		var proceed;
		proceed = validate();
		if (proceed == 1) {
			$('form').submit();
		};
	});
	$('.btn-change-pass').on('click', function(event) {
		$('.send-change-pass').val($(this).val());
	});
	$('.slide').on('change',function(event){
		imgPreview(event, 'img-responsive', $(".outpost"));
	});
	$(document).on('change', '.publication-image', function(event) {
		imgPreview(event, 'publication-image center-block', $($(this).next('.outpost')));
	});
	$('.btn-show-msg').on('click', function(event) {
		if ($(this).val() != "") {
			$('.modal-msg-content').html($(this).val())
		}else
		{
			$('.modal-msg-content').html('Sin mensaje')
		}
	});
	$('.show-question-info').on('click', function(event) {
		$('.modal-body.description').html($(this).val());
	});
	/***************************/
	/***                     ***/
	/***        Ajax         ***/
	/***                     ***/
	/***************************/
	$('.btn-clone').on('click', function(event) {
		var btn    		= $(this);
		var target 		= btn.data('target');
		var input   	= btn.data('input');
		var name		= btn.data('name');
		clonar(target, name, '.'+input);
	});
	$(document).on('click','.dimiss-cloned', function(event) {
		removeCloned($(this));
	});
	$('.preview').on('click', function(event) {
		$('.map').html($('.map-input').val());
	});
	$('.send-change-pass').on('click', function(event) {
		$('.listErrors').remove();
		var btn = $(this);
		var proceed;
		proceed = validate();
		if ($('.password_confirmation').val() != $('.password').val()) {
			activeteStatus($('.password_confirmation'),'.control-label','.label-control-danger','has-success','has-error');
			addHtml($('.password_confirmation'),'.label-control-danger','Las contraseñas no coinciden.');
			proceed = 0;
		};
		
		if (proceed == 1) {
			var dataPost = {
				user_id : btn.val(),
				password: $('.password').val(),
				password_confirmation: $('.password_confirmation').val(),
			}
			doAjax(btn.data('url'), 'POST', 'json', dataPost, btn, startAjax, changePassSuccess, ajaxError);
		};
	});
	$('.show-pub-info').on('click', function(event) {
		removeResponseAjax();
		$('.partial-container').html('');
		var btn = $(this);
		var dataPost = {
			id : $(this).val()
		}
		$('#showItemInfo').modal('show');
		doAjax(getRootUrl()+'/administracion/publicaciones/cargar-detalles', 'GET', 'html', dataPost, btn, startAjax, loadContent, ajaxError);
	});
	/***************************/
	/***                     ***/
	/***      Ajax Elim      ***/
	/***                     ***/
	/***************************/
	$('.btn-elim-user').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Usuario');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-cat').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Categoría');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-misc').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Caracteristica');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-image').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar imagen');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-publication').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar publicación');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-elim-slide').on('click', function(event) {
		$('#elimThing .modal-title').html('Eliminar Slide');
		addValToElim('.btn-elim-thing-modal', $(this));
	});
	$('.btn-reject-modal').on('click', function(event) {
		var btn = $(this);
		var url = btn.data('url');
		var dataPost = {
			store_id : btn.val(),
			motivo   : $('.motivo').val()
		};
		doAjax(url, 'POST', 'json', dataPost, btn, startAjax, elimSuccess, ajaxError);
	});
	$('.btn-elim-thing-modal').on('click', function(event) {
		var btn = $(this);
		var url = btn.data('url');
		var dataPost = {};
		dataPost[btn.data('tosend')] = btn.val();
		doAjax(url, 'POST', 'json', dataPost, btn, startAjax, elimSuccess, ajaxError);
	});
	$('#elimThing').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim-thing-modal');
	});
	$('.modal').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim-thing-modal');
	});
});