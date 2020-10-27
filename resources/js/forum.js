// const anchorme = require("anchorme").default;
const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
try {
    window._last_message_id = window._messages[window._messages.length-1].id;
    localStorage.setItem(`${window._forum}.last_message`, (new Date(window._messages[window._messages.length-1].created_at)).getTime());
} catch(e) {
    window._last_message_id = 0;
}

const contextMenuItems = [
    ['Mentionner', 'mention'],
    ['Voir le profil', 'profile']
];
const contextMenuContent = contextMenuItems.map(item=>`<span onclick="${item[1]}()">${item[0]}</span>`).join('');
const formUrlEncoded = x => Object.keys(x).reduce((p, c) => p + `&${c}=${encodeURIComponent(x[c])}`, '');

function profile() {
    let profileUrl = $('#'+$('#contextMenu').attr('data-message')).find('.MessageCard-author').attr('href');
    window.open(profileUrl);
    contextMenuOff();
}

function mention() {
    let inputVal = $('#MessageForm-input').val();
    let mentionText = '@'+$('#'+$('#contextMenu').attr('data-message')).find('.MessageCard-author-name').text().replace(/\s{2,}/g, '').replace(/\s/g, '_').toLowerCase();
    console.log(mentionText);
    if(!inputVal.includes(mentionText)) {
        $('#MessageForm-input').val(mentionText+' '+inputVal).focus();
    }
    contextMenuOff();
}

function contextMenu(e) {
    e.preventDefault();
    if(!$('#contextMenu').length) {
        $('body').append(`
        <div id="contextMenu" data-message="${$(e.target).parents('.MessageCard')[0].id}">
            ${contextMenuContent}
        </div>
        `)
    } else {
        $('#contextMenu').attr('data-message', $(e.target).parents('.MessageCard')[0].id)
    }
    clickCoords = getPosition(e);
    
    menuWidth = $('#contextMenu').offsetWidth + 4;
    menuHeight = $('#contextMenu').offsetHeight + 4;
    
    windowWidth = $('#contextMenu').innerWidth();
    windowHeight = $('#contextMenu').innerHeight();
    
    if ( (windowWidth - clickCoords.x) < menuWidth ) {
        $('#contextMenu').css('left', windowWidth - menuWidth + "px");
    } else {
        $('#contextMenu').css('left', clickCoords.x + "px");
    }
    
    if ( (windowHeight - clickCoords.y) < menuHeight ) {
        $('#contextMenu').css('top', windowHeight - menuHeight + "px");
    } else {
        $('#contextMenu').css('top', clickCoords.y + "px");
    }
    $('#contextMenu').fadeIn('fast');
}

function getPosition(e) {
    var posx = 0, posy = 0;
  
    if (!e) var e = window.event;
  
    if (e.pageX || e.pageY) {
      posx = e.pageX;
      posy = e.pageY;
    } else if (e.clientX || e.clientY) {
      posx = e.clientX + document.body.scrollLeft + 
                         document.documentElement.scrollLeft;
      posy = e.clientY + document.body.scrollTop + 
                         document.documentElement.scrollTop;
    }
  
    return {
      x: posx,
      y: posy
    }
}

function contextMenuOff() {
    $('#contextMenu').fadeOut('fast');
}


function getDate(datetime, withMinutes=true, withYear=false) {
    let date = datetime===undefined?'': new Date(datetime.replace(/-/g, "/"));
    const twoDigits = (n)=>n==0?'':(n.toString().length==1?"0"+n:n);
    return `${date.getDate()} ${months[date.getMonth()]} ${withYear?`<small>${date.getFullYear()}</small>`:''} ${withMinutes?`à ${twoDigits(date.getHours())}h${twoDigits(date.getMinutes())}`:''}`
}

function getMessage(message) {
    const content = anchorme({
        input:message.content,
        extensions: [
            // an extension for mentions
            {
                test: /@(\w|_)+/gi,
                transform: (string) =>
                    `<a href="http://escalade-montesquieu.fr/profil/${string.substr(1).replace(/(_)+/gi," ")}">${string}</a>`,
            }
        ],
    })
    return `
    <div class="MessageCard ${message.author == window._user?'myMessage':'theirMessage'}" id="message-${message.id}">
        <a class="MessageCard-author" href="/profil/${message.author_uuid}" target="blank">
                <img class="MessageCard-author-img" src="/profil/${message.author_uuid}/img">
                <h5 class="MessageCard-author-name">
                    ${message.author}
                </h5>
            </a>
        <p class="MessageCard-text ">
            ${content}
        </p>
        <span class="MessageCard-datetime">${getDate(message.created_at)}</span>
    </div>
    `
}

function addMessage(msg) {
    $('#MessagesList').append(getMessage(msg));
    $(".ForumLayout-messagesList").animate({ scrollTop: $('.ForumLayout-messagesList').prop("scrollHeight") }, 500);
    $('.MessageCard-author').on('click', contextMenu);
    $('.MessageCard-author').on('contextmenu', contextMenu);
}

function rendMessages(messages) {
    $('#MessagesList').html(
        messages.map(msg=>getMessage(msg))
    )
    setTimeout(()=>{
        $(".ForumLayout-messagesList").animate({ scrollTop: $('.ForumLayout-messagesList').prop("scrollHeight") }, 250);
    },500)
    $('.MessageCard-author').on('click', contextMenu);
    $('.MessageCard-author').on('contextmenu', contextMenu);

}

function sendMessage() {
    if (!$('#MessageForm-input').val().match(/\S/gm)) return
    let content = $('#MessageForm-input').val();
    $('#MessageForm-input').val('');

    $('.MessageForm').addClass('inProgress');

    axios({method: 'post', url: `/message/send`, data: {
        forum: window._forum,
        content
    }}).then(r=>{
        $('.MessageForm').removeClass('inProgress');
        window._last_message_id = r.data.message.id;
    });
}

function fetchMessages() {
    return new Promise(resolve => {
        console.log(`Fetching messages... (last: ${window._last_message_id})`)
        axios({
            method: 'post',
            url: 'https://escalade-montesquieu-pusher.herokuapp.com/fetch',
            // url: 'http://localhost:8001/fetch',
            timeout: 30 * 1000, // 10 minutes
            data: formUrlEncoded({last_message_id: window._last_message_id, forum: window._forum})
        }).then(r=>{  
            r.data.forEach(message=>{
                if(message.id > window._last_message_id) {
                    window._last_message_id = message.id
                    localStorage.setItem(`${window._forum}.last_message`, JSON.stringify((new Date(message.created_at)).getTime()));
                }
                addMessage(message);        
                window._messages.push(message);
            })

            fetchMessages().then(()=>resolve(r));
        }).catch(e=>{
            fetchMessages();
        });
    });
}

$(()=>{
    $('#MessageForm-send').click(sendMessage);
    $('#MessageForm-input').keyup(function(e) {
        if(e.which == 13) {
            sendMessage()
        }
    });
    rendMessages(window._messages);
    fetchMessages();

    window.onresize = contextMenuOff;
    window.onkeyup = function(e) {
        if ( e.keyCode === 27 ) {
            contextMenuOff();
        }
    }
    document.addEventListener('click', function(e) {
        if(!$(e.target).attr('class') || $(e.target).attr('class').includes('MessageCard-author')) return
        var button = e.which || e.button;
        if ( button === 1 ) {
            contextMenuOff();
        }
    });
});