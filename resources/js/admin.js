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

    function deleteMember(e) {
        let name = $(this).parents('.MemberCard').attr('data-name');
        if(!members.includes(name)) return;
        members.splice(members.indexOf(name), 1);
        let confirmation = confirm(`Voulez vous supprimez de la liste ${name}?`);
        if(confirmation) {
            axios({
                method: 'DELETE',
                url: `/admin/member/${name}`
            })
            .then(r=>{
                if(r.status==200) {
                    $(`.MemberCard[data-name="${name}"`).remove();
                }
            });
        }
    }

    $('.MemberCard-delete').click(deleteMember);
    $('.MemberCard-add').click(function(e) {
        let name = $(this).parents('.MemberCard').find('.MemberCard-name').val();
        name = name.toLowerCase().split(' ');
        for (var i = 0; i < name.length; i++) {
            name[i] = name[i].charAt(0).toUpperCase() + name[i].slice(1); 
        }
        name = name.join(' ');
        if(members.includes(name)) return;
        members.push(name);
        axios({
            method: 'POST',
            url: `/admin/member/${name}`
        })
        .then(r=>{
            $(this).parents('.MemberCard').find('.MemberCard-name').val('');
            if(r.status==200) {
                $('#AdminLayout-membersList').append(`
                <div class="MemberCard col-12 col-md-6" data-name="${name}">
                <div class="MemberCard-header">
                    <h3 class="MemberCard-name">${name}</h3>
                </div>
                <div class="MemberCard-actions">
                    <button class="MemberCard-delete">Supprimer</button>
                </div>
            </div>`);
            $('.MemberCard-delete').click(deleteMember);
            }
        });
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