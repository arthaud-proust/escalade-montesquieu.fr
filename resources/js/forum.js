const { default: Axios } = require("axios");
const Pusher = require('pusher-js');
const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'ed1f3b3d1b44b6ee47b7',
    cluster: 'eu',
    encrypted: true
});

function getDate(datetime, withMinutes=true, withYear=false) {
    let date = datetime===undefined?'': new Date(datetime);
    const twoDigits = (n)=>n==0?'':(n.toString().length==1?"0"+n:n);
    return `${date.getDate()} ${months[date.getMonth()]} ${withYear?`<small>${date.getFullYear()}</small>`:''} ${withMinutes?`à ${twoDigits(date.getHours())}h${twoDigits(date.getMinutes())}`:''}`
}

function getMessage(message) {
    return `
    <div class="MessageCard ${message.author == window._user?'myMessage':'theirMessage'}" id="message-${message.id}">
        <a class="MessageCard-author" href="/profil/${message.author_uuid}" target="blank">
                <img class="MessageCard-author-img" src="/profil/${message.author_uuid}/img">
                <h5 class="MessageCard-author-name">
                    ${message.author}
                </h5>
            </a>
        <p class="MessageCard-text ">
            ${message.content}
        </p>
        <span class="MessageCard-datetime">${getDate(message.created_at)}</span>
    </div>
    `
}

function updateMessages(newMessages) {
    const ids = window._messages.map(msg=>msg.id);
    const rendMessages = newMessages.filter(msg => !ids.includes(msg.id));
    rendMessages.forEach(msg => {
        $('#MessagesList').append(getMessage(msg));
    });
}

function addMessage(msg) {
    $('#MessagesList').append(getMessage(msg));
}

function rendMessages(messages) {
    $('#MessagesList').html(
        messages.map(msg=>getMessage(msg))
    )
}

function sendMessage() {
    Axios({method: 'post', url: `/message/send`, data: {
        forum: window._forum,
        content: $('#MessageForm-input').val()
    }}).then(r=>{
        $('#MessageForm-input').val('');
    });
}

$(()=>{
    $(".forum-form #name").keyup(function() {
        $(".forum-form #slug").val(removeDiacritics($(this).val()));
    });

    $('#MessageForm-send').click(sendMessage);

    rendMessages(window._messages);


    window.Echo.private('forum.'+window._forum)
    .listen('MessageSent', (e) => {
        addMessage(e.message);        
        window._messages.push(e.message);
    });
});