const cotes = ['Non renseigné', '4a','4b','4c','5a','5b','5c','6a','6b','6c','7a','7b','7c','8a','8b','8c'];
const roles = [ ['Grimpeur', 'climber'], ['Modérateur', 'modo'], ['Admin', 'admin'] ];

function getShoesOption(shoe) {
    let content = `<option ${shoe=="no-need"?'selected':''} value="no-need">J'ai mes chaussures</option>`;
    for (let i=36; i<51; i++) {
        content+= `<option ${shoe==i?'selected':''} value="${i}">${i}</option>`;
    }
    return content
}

$(()=>{
    try {
        document.getElementById('img').onchange = function (evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
        
            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    document.getElementById("preview").src = fr.result;
                }
                fr.readAsDataURL(files[0]);
            }
        
            // Not supported
            else {
                // fallback -- perhaps submit the input to an iframe and temporarily store
                // them on the server until the user's session ends.
            }
        }
    } catch(e) {}
    

    cotes.map(cote=>{
        $('#max_voie').append(`<option ${$('#max_voie').attr('data-value')==cote?'selected':''}>${cote}</option>`);
        $('#max_bloc').append(`<option ${$('#max_bloc').attr('data-value')==cote?'selected':''}>${cote}</option>`);
    });

    $('.Field-toggleVisibility').click(function() {
        let input = $(this).prev();
        if(input.attr('type')=='password') {
            $(this).attr('src', '/assets/svg/eye.svg');
            input.attr('type', 'text');
        } else {
            $(this).attr('src', '/assets/svg/eye-off.svg');
            input.attr('type', 'password');
        }
    });


    $('.Field.disabled input').attr('tabindex', -1);
    $('.Field.disabled input').prop( "disabled", true ); //Disable
    $('#shoes').html(getShoesOption($('#shoes').attr('data-value')));
    $('#role').html(roles[$('#role').attr('data-level')-1][0]);
    $('#role').attr('class', 'IdentityBloc-role '+roles[$('#role').attr('data-level')-1][1]);
});