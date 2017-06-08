function menu(btn) {
    btn.removeClass('faded');
	if (btn.hasClass('open')) {
        btn.removeClass('open');
        $('.navigation').removeClass('active');
        $('.overly').fadeOut('fast');
    }else
    {
        btn.addClass('open');
        $('.navigation').addClass('active');
        $('.overly').fadeIn('fast');
    }
}
function startMaterialAjax (btn) {
	$('.miniLoader').addClass('active');
	btn.attr('disabled', true).addClass('disabled');
}
function ajaxMaterialSuccess (response, btn) {
	// Materialize.toast(message, displayLength, className, completeCallback);
	var $toastContent = $('<div class="alert alert-'+response.type+' z-depth-3 waves waves-effect responseAjax"><p></p></div>');
	Materialize.toast($toastContent, 6000); // 4000 is the duration of the toast
	responseMsg(response);
	endMaterialAjax(btn);
	if (response.type == "success") {
		$('.validate-input').val('');
	};
}
function endMaterialAjax (btn) {
	$('.miniLoader').removeClass('active');
	btn.attr('disabled',false).removeClass('disabled')
}
function errorMaterialAjax (btn) {
	endMaterialAjax (btn) 
	var $toastContent = $('<div class="alert alert-danger z-depth-3 waves waves-effect"><p>Ups. Ha habido un error, porfavor intente nuevamente.</p></div>');
	Materialize.toast($toastContent, 6000) // 4000 is the duration of the toast
}
function validateFilter (target) {
	proceed = 0;
	$('.filter-input').each(function(index, el) {
		if ($(el).attr('type') != "radio") {
			if ($(el).val()!= "") {
				proceed = 1;
				$(target).append('<input type="hidden" name="'+$(el).attr('name')+'" value="'+$(el).val()+'">');
			};
		}else
		{
			if ($(el).is(':checked')) {
				proceed = 1;
				$(target).append('<input type="hidden" name="'+$(el).attr('name')+'" value="'+$(el).val()+'">');	
			};
		}
	});
	return proceed;
}
jQuery(document).ready(function($) {
	$('.contLoading').fadeOut('fast',function(){
		$(this).remove();
	});
	$('.arrow-left').on('click', function(event) {
		menu($(this));
    });
    $('.overly').on('click', function(event) {
    	menu($('.arrow-left'));
    });
    $('.postfix').on('click', function(event) {
    	$(this).next('.filter-input').focus();
    });
    $(window).on('scroll', function(event) {
    	if ($(window).scrollTop() > 10) {
    		$('.header').addClass('scrolled');
    		$('body').addClass('scrolled');
    	}else
    	{
    		$('.header.scrolled').removeClass('scrolled');
    		$('body').removeClass('scrolled');
    	}
    });
    $('.btn-search-filter').on('click', function(event) {
    	var btn = $(this);
		$(this).addClass('disabled').attr('disabled',true);
		$('.filter-form').html('');
    	var proceed = 0;
    	proceed = validateFilter('.filter-form')
    	if (proceed) {
    		$('.filter-form').submit();
    	};
    });
    $('.btn-filtralo').on('click', function(event) {
		var btn = $(this);
		$(this).addClass('disabled').attr('disabled',true);
		$('.form-filter').html('');
		var proceed = 0;
		proceed = validateFilter('.form-filter');
		if (proceed == 1) {
			$('.form-filter').submit();
			
		}else
		{
			btn.removeClass('disabled').attr('disabled',false);
			var $toastContent = $('<div class="alert alert-danger z-depth-3 waves waves-effect"><p>Al menos un campo es necesario.</p></div>');
			Materialize.toast($toastContent, 6000) // 4000 is the duration of the toast
		}
	});
	$('.sort-radio').on('click', function(event) {
		$('.sort-filter').html('');
		var proceed = 0;
    	proceed = validateFilter('.sort-filter')
		if (proceed) {
			$('.sort-filter').submit();
		};
	});
	if ($(window).width() < 768) {
		$('.fa-open-filters').on('click', function(event) {
			$(this).addClass('active');
			$('.bottom-header').addClass('active');
			$('.header-bottom').addClass('active');
		});
		$('.close-filter').on('click', function(event) {
			$('.fa-open-filters').removeClass('active');
			$('.bottom-header').removeClass('active');
			$('.header-bottom').removeClass('active');
		});
	};
    //ajax
    $('.btn-send-contact').on('click', function(event) {
    	dataPost = {
    		id 	  : $(this).data('id'),
    		name  : $('.contact-name').val(),
    		email : $('.contact-email').val(),
    		msg   : $('.contact-msg').val()
    	}
    	if (validate()) {
	    	var btn = $('#contactModal a.more');
			doAjax($(this).data('url'), 'POST', 'json', dataPost, btn, startMaterialAjax, ajaxMaterialSuccess, errorMaterialAjax);
    	}else
    	{
			var $toastContent = $('<div class="alert alert-danger z-depth-3 waves waves-effect"><p>Todos los campos son obligatorios.</p></div>');
			Materialize.toast($toastContent, 4000) // 4000 is the duration of the toast
    	}
    });
    $('.btn-contact').on('click', function(event) {
    	var btn = $(this);
    	dataPost = {
    		name    : $('.contact-name').val(),
    		subject : $('.contact-subject').val(),
    		email   : $('.contact-email').val(),
    		msg     : $('.contact-msg').val()
    	}
    	if (validate()) {
			doAjax($(this).data('url'), 'GET', 'json', dataPost, btn, startMaterialAjax, ajaxMaterialSuccess, errorMaterialAjax);
    	}else
    	{
			var $toastContent = $('<div class="alert alert-danger z-depth-3 waves waves-effect"><p>Todos los campos son obligatorios.</p></div>');
			Materialize.toast($toastContent, 4000) // 4000 is the duration of the toast
    	}
    });
});