// @ts-nocheck
$('#add-advertisementFiles').click(function(){
    // récupération du numéro des futurs champs
    // const index = $('#advertisement_advertisementFiles div.div-group').length;
    const index = +$('#widgets-counter').val();

    //console.log(index);

    // récupération du prototype des entrées
    const tmpl = $('#advertisement_advertisementFiles').data('prototype').replace(/__name__/g, index);

    // Injection du code au sein de la div
    $('#advertisement_advertisementFiles').append(tmpl);
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
    const count = +$('#advertisement_advertisementFiles div.div-group').length;

    $('#widgets-counter').val(count);
}

updateCounter();
handleDeleteButtons();