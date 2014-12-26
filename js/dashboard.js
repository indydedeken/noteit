$(function() {
	
	var btnAnnulerExiste = false;
	var btnModifierDisabled;
	
	var height = $( window ).height();
	height = height-180;
	$( '#frameRight' ).css('height', height +'px' );
	
	$( window ).resize( function() {
		height = $( this ).height();
		height = height - 180;
		
		$( '#frameRight' ).css('height', height +'px' );
	});
	
	$('#title').focus();
	
	// création du CKEditor
	$( 'textarea.editor' ).ckeditor();
	$( 'textarea.editor' ).val("<p>Le " + today() + ", j'ai fait </p>");
	
	//enregistrement de la note
	$("#envoi").click(function() {
		
		var id = $( 'input#id_note' ).val();
		var titre = $( 'input#title' ).val();
		var note = $( 'textarea.editor' ).val();
		var btnEnvoi = $( this );
		
		$( btnEnvoi ).attr( 'disabled', 'disabled' );
				
		var requete = $.ajax({
			type: 'POST',
			dataType: 'html',
			url: 'enregistrer-note.php',
			data: {id: id, title : titre, comment : note}
		});
		
		requete.done(function(data) {
			$('.notif').html(data);
			$( 'input#title' ).val('');
			$( 'textarea.editor' ).val('');
			$.ajax({
				url: 'consulter.php',
				dataType: 'html',
				success: function(data) {
					$('#frameRight').html(data);
					callbackModifDone();
					$( btnEnvoi ).removeAttr( 'disabled' );
				}
			});
		});
		
		requete.fail(function(jqXHR, textStatus) {
			alert( "Problème : " + textStatus );
		});
		
		return false;
		
	});
	
	// vider les champs input, textarea
	$('#vider').click(function() {
		$( 'input#title' ).val('');
		$( 'textarea.editor' ).val('');
		$('#title').focus();
		
		return false;
	});
		
	// suppression de la note
	$('#frameRight').delegate('.supprimer', 'click', function() {
		var value = $(this).attr('value');
		
		if(confirm('Supprimer cette note ? L\'effet est irrémédiable.')) {
		
			$( this ).attr( 'disabled', 'disabled' );
			
			var requete = $.ajax({
				url: 'supprimer-note.php',
				type: 'POST',
				data: {id: value}
			});
				
			requete.done(function(data) {
				$('.notif').html(data);
				$.ajax({
					url: 'consulter.php',
					dataType: 'html',
					success: function(data) {
						$('#frameRight').html(data);
					}
				});
			});
				
			requete.fail(function(jqXHR, textStatus) {
				alert( "Problème : " + textStatus );
			});
		}
	});
	
	// modification de la note
	$('#frameRight').delegate('.modifier', 'click', function() {
		var value = $(this).attr('value');
		$( btnModifierDisabled ).removeAttr( 'disabled' );
		btnModifierDisabled = $( this );
		
		$( btnModifierDisabled ).attr( 'disabled', 'disabled' );
		$( 'tr#' + value ).css('opacity', '0.2');
		$( '#id_note' ).attr('value', value);
		
		var requete = $.ajax({
			url: 'modifier-note.php',
			type: 'POST',
			data: {id: value}
		});
		
		requete.done(function(data) {
			var btnAnnuler = '<button class="btn btn-large btn-warning" id="btnAnnuler" value="' + value + '"><i class="icon-remove-sign icon-white"></i> Annuler la modification</button>';
			btnAnnulerExiste = true;
			
			$('.notif').html(data);
			
			/* supprime le precedent bouton */
			if(btnAnnulerExiste) {
				$( '#btnAnnuler' ).remove();
				btnAnnulerExiste = false;
			}
						
			$( '.boutons' ).append( btnAnnuler );
		});
		
		requete.fail(function(jqXHR, textStatus) {
			alert( "Problème : " + textStatus );
		});
		
	});
		
	$('#btnAnnuler').live('click', function() {
		
		var value = $( this ).val();
	
		callbackModifDone( value );
		
		return false;
		
	});
	
	function viderChamps() {
		
		$( 'input#id_note' ).val('');
		$( 'input#title' ).val('');
		$( 'textarea.editor' ).val('');
		$('#title').focus();
		
	};
	
	function callbackModifDone(value) {
		
		$('#btnAnnuler').remove();
		$( '#id_note' ).val('');
		$( btnModifierDisabled ).removeAttr( 'disabled' );
		$( 'tr#' + value ).css('opacity', '1');
		viderChamps();
		
	}
	
	// fonction qui retourne la date du jour
	function today() {
		var d = new Date();
		var date = year = month = day = "";
		
		year = d.getFullYear()
		month = d.getMonth()+1;
		if(month < 10) 
				month = "0" + month;
		day = d.getDate();
		if(day < 10)
				day = "0" + day
		
		return day + '/' + month + '/' + year;
	}
	
});