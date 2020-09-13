$(()=>{

    // Blog part
    try {
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#datetimepicker').datetimepicker({
            format: 'yyyy-mm-dd HH:MM',
            footer: true,
            modal: true,
            minDate: today,
            locale: 'fr-fr',
            uiLibrary: 'bootstrap4'
        });
    } catch(e) {};
    

    $('.blog-form').submit(e=>{
        if($('#datetimepicker').val().length <19) $('#datetimepicker').val($('#datetimepicker').val()+":00");
        console.log($('#datetimepicker').val());
    })
    $(".blog-form #name").keyup(function() {
        $(".blog-form #slug").val(window.removeDiacritics($(this).val()));
    });

    $(".forum-form #name").keyup(function() {
        $(".forum-form #slug").val(window.removeDiacritics($(this).val()));
    });



    $('.UserCard-delete').click(function(e) {
        let name = $(this).parents('.UserCard').attr('data-name');
        let uuid = $(this).parents('.UserCard').attr('data-uuid');
        let confirmation = confirm(`Voulez vous supprimez l'utilisateur ${name}?`);
        if(confirmation) {
            axios({
                method: 'DELETE',
                url: `/admin/user/${uuid}`
            })
            .then(r=>location.reload());
        }
    });
    $('.UserCard-changeLevel').change(function(e) {
        let name = $(this).parents('.UserCard').attr('data-name');
        let uuid = $(this).parents('.UserCard').attr('data-uuid');
        let level = $(this).find('option:selected').val();
        let rangs=["d'utilisateur", "de modérateur", "d'administrateur"];
        let confirmation = confirm(`Voulez vous mettre l'utilisateur ${name} au rang ${rangs[level-1]}?`);
        if(confirmation) {
            axios({
                method: 'PUT',
                url: `/admin/user/${uuid}`,
                data: {
                    level
                }
            })
            .then(r=>location.reload());
        }
    });

    $('#blog').on('change', function() {
        // console.log(this.value);
        if($('#title').attr('data-changed') == "false" || $('#title').val()=="") {

            $('#title').val($(this).find(":selected").html());
            $('#title').attr('data-changed', "false");
        }
    });

    $('#title').keypress(function() {
        $(this).attr('data-changed', 'true');
    })

    $('#maxplaces-toggle').click(function() {
        if($(this).is(':checked')) {
            $('#maxplaces').attr('data-before', $('#maxplaces').val());
            $('#maxplaces').val('-1');
            $('#maxplaces').prop("readonly", true);
        } else {
            $('#maxplaces').val($('#maxplaces').attr('data-before'));
            $('#maxplaces').prop("readonly", false);
        }
    })

    if($('#maxplaces').val() == '-1') {
        $('#maxplaces').prop("readonly", true);
        $('#maxplaces-toggle').prop("checked", true);
        $('#maxplaces').attr('data-before', '10');
    }

});