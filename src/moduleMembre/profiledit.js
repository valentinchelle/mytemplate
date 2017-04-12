$(function () {
	// A chaque sélection de fichier
    $('#profilemodif').find('input[name="profilePicture"]').on('change', function (e) {
        var files = $(this)[0].files;
 
        if (files.length > 0) {
            // On part du principe qu'il n'y qu'un seul fichier
            // étant donné que l'on a pas renseigné l'attribut "multiple"
            var file = files[0],
            $image_preview = $('#image_preview');
            // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
            $image_preview.css('background', 'url(' + window.URL.createObjectURL(file)+') center no-repeat');
            
        }
    });
	
    $('#formprofiledit').on('submit', function (e) {
        // On empêche le navigateur de soumettre le formulaire
        e.preventDefault();
 
        var $form = $(this);
		var formdata = (window.FormData) ? new FormData($form[0]) : null;
        
        var data = (formdata !== null) ? formdata : $form.serialize();
		$('#profilemodif').modal('hide');
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
			contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
			dataType: 'json', // selon le retour attendu
			data: data,// Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function (response) {
                // La réponse du serveur
				$('.profile-usertitle-name').html(response.username);
				$('.profile-usertitle-job').html(response.email);
				$('.img-responsive').attr('src', response.pdp);
            }
        });
	
    });
});