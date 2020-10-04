// const anchorme = require("anchorme").default;
function loadTimePicker() {
    if($('#datetimepicker').length == 0) return
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    try {
        $('#datetimepicker').datetimepicker({
            format: 'yyyy-mm-dd HH:MM',
            footer: true,
            modal: true,
            minDate: today,
            locale: 'fr-fr',
            uiLibrary: 'bootstrap4',
            change: function (e) {
                if($('#datetimepicker').val().length <19) $('#datetimepicker').val($('#datetimepicker').val()+":00");
            }
        });
    } catch(e) {
        console.error(e);
        setTimeout(loadTimePicker, 500);
    };
}

$(()=>{
    // Blog part
    loadTimePicker();
    
    $(".blog-form #name").on('keyup', function() {
        $(".blog-form #slug").val(window.removeDiacritics($(this).val()));
    });

    $(".gallery-form #name").on('keyup', function() {
        $(".gallery-form #slug").val(window.removeDiacritics($(this).val()));
    });

    $(".photo-form #name").on('keyup', function() {
        $(".photo-form #slug").val(window.removeDiacritics($(this).val()));
    });

    $(".forum-form #name").on('keyup', function() {
        $(".forum-form #slug").val(window.removeDiacritics($(this).val()));
    });

    // $('.InfoCard-content').html(function(i, text) {
    //     console.log('e');
    //     return anchorme({
    //         input:text,
    //         extensions: [
    //             // an extension for mentions
    //             {
    //                 test: /@(\w|_)+/gi,
    //                 transform: (string) =>
    //                     `<a href="http://escalade-montesquieu.fr/profil/${string.substr(1).replace(/(_)+/gi," ")}">${string}</a>`,
    //             },
    //             // an extension for nameds links
    //             {
    //                 test: /\w+\[.+\]/gi,
    //                 transform: (string) =>
    //                     `<a href="${string.replace(/\w+\[|\]/gi,'')}">${string.replace(/\[.+/gi,'')}</a>`,
    //             },
    //         ],
    //     })
    // })

    $('.InfoCard-delete').click(function(e) {
        let id = $(this).parents('.InfoCard').attr('data-id');
        let confirmation = confirm(`Voulez vous supprimez cette information?`);
        if(confirmation) {
            axios({
                method: 'DELETE',
                url: `/admin/info/${id}`
            })
            .then(r=>location.reload());
        }
    });
    $('.InfoCard-add').click(function(e) {
        $('#modalEdit').attr('data-id', '0');
        $('#modalEdit').attr('data-method', 'POST');
        $('#modalEdit .modal-title').text('Ajouter une information');
        $('#modalEdit').find('.InfoCard-title').val('');
        $('#modalEdit').find('textarea.InfoCard-content').val('');
        $('#modalEdit').modal('show'); 
    });
    $('.InfoCard-edit').click(function(e) {
        $('#modalEdit').attr('data-id', $(this).parents('.InfoCard').attr('data-id'));
        $('#modalEdit').attr('data-method', 'PUT');
        $('#modalEdit .modal-title').text('Editer l\'information');
        $('#modalEdit').find('.InfoCard-title').val($(this).parents('.InfoCard').find('.InfoCard-title').text());
        $('#modalEdit').find('textarea.InfoCard-content').val($(this).parents('.InfoCard').find('.InfoCard-content').text());
        $('#modalEdit').modal('show');        
    });

    $('#editInfo').on('click',function(e) {
        let method = $('#modalEdit').attr('data-method');
        let title = $('#modalEdit').find('.InfoCard-title').val();
        let content = $('#modalEdit').find('textarea.InfoCard-content').val();
        axios({
            method,
            url: `/admin/info${method=='PUT'?`/${$('#modalEdit').attr('data-id')}`:``}`,
            data: {
                title, content
            }
        })
        .then(r=>location.reload());
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
        if(members.filter(member=>member.name==name).length == 0) return;
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
    function addMember(e) {
        let name = $(e.target).parents('.MemberCard').find('.MemberCard-name').val();
        let classroom = $(e.target).parents('.MemberCard').find('.MemberCard-class').val();
        name = name.toLowerCase().split(' ');
        for (var i = 0; i < name.length; i++) {
            name[i] = name[i].charAt(0).toUpperCase() + name[i].slice(1); 
        }
        name = name.join(' ');
        if(members.filter(member=>member.name==name).length >0) return;
        if(name=='' || classroom=='') return;
        members.push({name, classroom});
        axios({
            method: 'POST',
            url: `/admin/member`,
            data: {
                name,
                classroom
            }
        })
        .then(r=>{
            $(e.target).parents('.MemberCard').find('.MemberCard-name').val('');
            $(e.target).parents('.MemberCard').find('.MemberCard-class').val('');
            if(r.status==200) {
                $('#AdminLayout-membersList').append(`
                    <div class="MemberCard col-12 col-md-6" data-name="${name}">
                        <div class="MemberCard-header">
                            <h3 class="MemberCard-name">${name} <small>${classroom}</small></h3>
                        </div>
                        <div class="MemberCard-actions">
                            <button class="MemberCard-delete">Supprimer</button>
                        </div>
                    </div>
                `);
                $('.MemberCard-delete').on('click', deleteMember);
            }
        });
    }
    $('.MemberCard-delete').click(deleteMember);
    $('.MemberCard-add').click(addMember);
    $('input.MemberCard-class').on('keyup', function(e) {
        if(e.which == 13) {
            addMember(e)
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