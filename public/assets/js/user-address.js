// @ts-nocheck
$('#add-addresses').click(function(){
    // récupération du numéro des futurs champs
    // const index = $('#user_addresses div.div-group').length;
    const index = +$('#widgets-counter').val();

    //console.log(index);

    // récupération du prototype des entrées
    const tmpl = $('#user_addresses').data('prototype').replace(/__name__/g, index);

    // Injection du code au sein de la div
    $('#user_addresses').append(tmpl);
    //console.log(tmpl);

    $('#widgets-counter').val(index + 1);
    //Je gère le bouton supprimer
    handleDeleteButtons();
})

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        // console.log(target);

        $(target).remove();
    })
}

function updateCounter() {
    const count = +$('#user_addresses div.div-group').length;

    $('#widgets-counter').val(count);
}

updateCounter();
handleDeleteButtons();