// const anchorme = require("anchorme").default;
const socket = io.connect(window._push_host+'?token='+window._token);
var writeTimeout = null;
const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
try {
    window._last_message_author = window._messages[0].author_uuid;
    window._last_message_id = window._messages[0].id;
    localStorage.setItem(`${window._forum}.last_message`, (new Date(window._messages[0].created_at)).getTime());
} catch(e) {
    window._last_message_id = 0;
}

const contextMenuItems = [
    ['Voir le profil', 'profile'],
    ['Mentionner', 'mention'],
    ['Mentionner tout le monde', 'mentionAll']
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
    if(!inputVal.includes(mentionText)) {
        $('#MessageForm-input').val(mentionText+' '+inputVal).focus();
    }
    contextMenuOff();
}
function mentionAll() {
    let inputVal = $('#MessageForm-input').val();
    let mentionText = '@everyone';
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
    
    menuWidth = $('#contextMenu').outerWidth()+10;
    menuHeight = $('#contextMenu').outerHeight()+10;
    
    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;

    if ( (windowWidth - clickCoords.x) < menuWidth ) {
        console.log('out width');
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
                test: /@everyone/gi,
                transform: (string) =>
                    `<a href="#">${string}</a>`,
            },
            {
                test: /@(?!everyone)(\w|_)+/gi,
                transform: (string) =>
                    `<a href="http://escalade-montesquieu.fr/profil/${string.substr(1).replace(/(_)+/gi," ")}">${string}</a>`,
            }
        ],
    })
    return `
    <div class="MessageCard ${message.author == window._username?'myMessage':'theirMessage'}" id="message-${message.id}">
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
function addInfo(msg) {
    $('#MessagesList').append(msg.content);
    $(".ForumLayout-messagesList").animate({ scrollTop: $('.ForumLayout-messagesList').prop("scrollHeight") }, 500);
}

function prependMessage(msg) {
    const lastScrollHeight = $('#MessagesList')[0].scrollHeight;
    $('#MessagesList').prepend(getMessage(msg));
    var scrollDiff = $('#MessagesList')[0].scrollHeight - lastScrollHeight;
    $('#MessagesList')[0].scrollTop += scrollDiff;
}

function rendMessages(messages) {
    messages.forEach(msg=>{
        $('#MessagesList').prepend(getMessage(msg))
        $('.ForumLayout-messagesList').scrollTop($('.ForumLayout-messagesList').prop("scrollHeight"))
        // prependMessage(msg)
    })
    // $('#MessagesList').html(
    //     messages.map(msg=>getMessage(msg))
    // )
    // setTimeout(()=>{
    //     $(".ForumLayout-messagesList").animate({ scrollTop: $('.ForumLayout-messagesList').prop("scrollHeight") }, 250);
    // },500)
    $('.MessageCard-author').on('click', contextMenu);
    $('.MessageCard-author').on('contextmenu', contextMenu);

}

function sendMessage() {
    if (!$('#MessageForm-input').val().match(/\S/gm)) return
    let input = $('#MessageForm-input');
    socket.emit('message.new', {content: input.val()});
    input.val('');
}
const sendWritingStart = function() {
    socket.emit('writing.start');
}
const sendWritingStop = function() {
    socket.emit('writing.stop');
    writeTimeout = null;
}

const handleWrite = function() {
    if(writeTimeout == null) {
        sendWritingStart()
        clearTimeout(writeTimeout);
        writeTimeout = setTimeout(sendWritingStop, 500);
    } else {
        clearTimeout(writeTimeout);
        writeTimeout = setTimeout(sendWritingStop, 500);
    }
}

$(()=>{
    $('#MessageForm-send').click(sendMessage);
    $('#MessageForm-input').keyup(function(e) {
        if(e.which == 13) {
            sendMessage()
        } else {
            handleWrite()
        }
    });
    rendMessages(window._messages);

    
    socket.on("connect", () => {
        socket.emit('join', {
            room: window._forum, 
            username: window._username
        });
    });


    socket.on("messages.update", (message) => {
        if(message.type == 'message') {
            window._last_message_author = message.author_uuid;
            localStorage.setItem(`${window._forum}.last_message`, (new Date(message.created_at)).getTime());
            addMessage(message);
        } else {
            addInfo(message);
        }
    });

    socket.on("writings.update", (users) => {
        console.log(users);
        const index = users.indexOf(window._username);
        if (index > -1) {
            users.splice(index, 1);
        }

        if(users.length>1) {
            let writers = users.splice(0,2);
            $('#writings').text(`${writers.join()} +${users.length} écrivent...`)
        } else {
            $('#writings').text(users.length==0?'':`${users.join()} écrit...`)
        }
    });

    socket.on("seen.update", (usersUuid) => {
        let index = usersUuid.indexOf(window._uuid);
        if (index > -1) {
            usersUuid.splice(index, 1);
        }
        index = usersUuid.indexOf(window._last_message_author);
        if (index > -1) {
            usersUuid.splice(index, 1);
        }
        if(usersUuid.length>0) {
            let usersTiles = "";
            for (let i=0; (i<usersUuid.length+1)&&(i<3); i++) {
                usersTiles+='<img src="/profil/'+usersUuid.shift()+'/img" class="SeenBox-seenTile">';
            }
            $('#SeenBox').html(`Vu par <div id="SeenBox-seen">${usersTiles}</div> ${usersUuid.length>0?'+'+usersUuid.length:''}`);
        } else {
            $('#SeenBox').html('')
        }
        
    });

    window.onunload = window.onbeforeunload = () => {
        socket.emit('leave');
        socket.close();
    };


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