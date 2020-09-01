const { default: Axios } = require("axios");
const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

function countShoes(availables) {
    let shoes = {};
    Object.values(availables).forEach(user => {
        shoes[user[1]] = user[1] in shoes?shoes[user[1]]+1:1;
    });
    return Object.entries(shoes).filter(s=>s[0]!='no-need').map(s => s.reverse().join(` paire${s[0]>1?'s':''} de `)).join(', ');
}

function getDate(datetime, withMinutes=true) {
    let date = datetime===undefined?'': new Date(datetime);
    const twoDigits = (n)=>n==0?'':(n.toString().length==1?"0"+n:n);
    return `${days[date.getDay()]} ${date.getDate()} ${months[date.getMonth()]} <small>${date.getFullYear()}<small> ${withMinutes?`à ${twoDigits(date.getHours())}H${twoDigits(date.getMinutes())}`:''}`
}

function getPost(post) {
    let availables = JSON.parse(post.availables);
    let unavailables = JSON.parse(post.unavailables);
    let harness = Object.values(availables).filter(user => user[0] === 1).length;
    let participants = Object.keys(availables).length;
    let places = post.maxplaces==-1?99999:post.maxplaces-participants;
    return `
        <div class="PostCard-content">
            <h3>${post.title}</h3>
            <div class="particip">
                <span class="nb-availables">${participants} participant${participants>2?'s':''}</span>
                ${user?((user.name in availables)?`<button class="btn unavailable-post" data-post-id="${post.id}">Se retirer</button>
                `:`<button class="btn join-post ${places<=0?'disabled':''}" data-post-id="${post.id}">Participer</button>`):`<button class="btn login-user" data-post-id="${post.id}">Participer</button>`}
            </div>
        </div>
            <div class="PostCard-more">
            ${user && user.level>1?`<div class="PostCard-adminInfo">
                <span class="availables">Participants: ${Object.keys(availables).join(', ') || 'aucun'}</span>
                <span class="unavailables">Indisponibles: ${unavailables.join(', ') || 'aucun'}</span>
                <span>Baudrier${harness>1 ? 's' : ''} à prendre: ${harness}</span>
                <span>Chaussures à prendre: ${countShoes(availables) || 'aucune'}</span>
            </div>
            <div class="PostCard-adminActions">
                <a href="/post/${post.id}/edit" class="btn edit-post" title="Éditer"><img src="/assets/svg/edit-2.svg"></a>
            </div>
            `:''}
            <div class="PostCard-info">
                ${$('#post-'+post.id).attr('data-show-datetime')=="true"?`<h5>${getDate(post.datetime)}</h5>`:''}
                <a class="location" target="blank" href="https://www.google.fr/maps/search/${post.location}+france">${post.location===null?'':post.location}</a>
                <span class="maxplaces">${post.maxplaces==-1?'Places illimitées':places+` ${places>1?'places restantes':'place restante'}`}</span>
                <p class="desc">${post.content===null?'':post.content}</p>
            </div>
        </div>
    `;
}

function rendPost(post) {
    $('#post-'+post.id).html(getPost(post));
    $('#post-'+post.id+' .PostCard-content').click(function(e) {
        if(e.target.nodeName == 'BUTTON') return;
        let close = $(this).parent().attr('class')=='PostCard';
        $('.PostCard-content').parent().attr('class','PostCard');
        if(close) {
            $(this).parent().attr('class','PostCard open');
        }
    })
}

function rendPosts(posts, firstRending=false) {
    posts.forEach((post, index)=>{
        try {
            if(firstRending && posts[index-1].datetime.split(' ')[0] !== post.datetime.split(' ')[0]) $(`<h3 class="date-group">${getDate(post.datetime, false)}</h3>`).insertBefore('#post-'+post.id)
        } catch(e) {
            if(firstRending) $(`<h3 class="date-group">${getDate(post.datetime, false)}</h3>`).insertBefore('#post-'+post.id)
        }
        rendPost(post)
    });
}

function participate(e) {
    e.preventDefault();
    let id = $(this).attr('data-post-id');
    Axios({method: 'post', url: `/post/${id}/participate`}).then(r=>{
        rendPost(r.data, id);
        $('.join-post').click(participate);
        $('.unavailable-post').click(unavailable);
    });
}

function unavailable(e) {
    e.preventDefault();
    let id = $(this).attr('data-post-id');
    Axios({method: 'delete', url: `/post/${id}/participate`}).then(r=>{
        rendPost(r.data, id);
        $('.join-post').click(participate);
        $('.unavailable-post').click(unavailable);
    });
}

$(()=>{
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
    } catch(e) {console.warn('Cant\'t load datetime picker: files were not called')};
    

    $('.blog-form').submit(e=>{
        if($('#datetimepicker').val().length <19) $('#datetimepicker').val($('#datetimepicker').val()+":00");
        console.log($('#datetimepicker').val());
    })
    $(".blog-form #name").keyup(function() {
        $(".blog-form #slug").val(removeDiacritics($(this).val()));
    });


    rendPosts(posts, true);

    $('.join-post:not(.disabled)').click(participate);
    $('.unavailable-post').click(unavailable);
    $('.login-user').click(()=>location.replace('/login'));
});