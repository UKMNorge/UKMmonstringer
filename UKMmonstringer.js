jQuery(document).on('click', '.details_show', function(){
	show = jQuery(this);
	monstring = jQuery(this).parents('li'); 
	monstring.find('.details_hide').show();
	show.hide();
	monstring.find('.details').slideDown()
});
jQuery(document).on('click', '.details_hide', function(){
	hide = jQuery(this);
	monstring = jQuery(this).parents('li'); 
	monstring.find('.details_show').show();
	hide.hide();
	monstring.find('.details').slideUp()
});

jQuery(document).on('click', '.wpadmin', function(){
	window.open(jQuery(this).attr('data-url'),'_blank');
});

jQuery(document).on('click','#smstoall', function(){
	var recipients = new Array();
	jQuery('.UKMSMS').each(function(){
		recipients.push( jQuery(this).find('a').html() );
	});
	jQuery('#UKMSMS_to').val( recipients.join(',') );
	jQuery('#UKMSMS_form').submit();
});