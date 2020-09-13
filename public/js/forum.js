/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/forum.js":
/*!*******************************!*\
  !*** ./resources/js/forum.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

try {
  window._last_message_id = window._messages[window._messages.length - 1].id;
} catch (e) {
  window._last_message_id = 0;
} // const Pusher = require('pusher-js');
// import Echo from "laravel-echo"
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'ed1f3b3d1b44b6ee47b7',
//     cluster: 'eu',
//     encrypted: true
// });


var formUrlEncoded = function formUrlEncoded(x) {
  return Object.keys(x).reduce(function (p, c) {
    return p + "&".concat(c, "=").concat(encodeURIComponent(x[c]));
  }, '');
};

function getDate(datetime) {
  var withMinutes = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  var withYear = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  var date = datetime === undefined ? '' : new Date(datetime);

  var twoDigits = function twoDigits(n) {
    return n == 0 ? '' : n.toString().length == 1 ? "0" + n : n;
  };

  return "".concat(date.getDate(), " ").concat(months[date.getMonth()], " ").concat(withYear ? "<small>".concat(date.getFullYear(), "</small>") : '', " ").concat(withMinutes ? "\xE0 ".concat(twoDigits(date.getHours()), "h").concat(twoDigits(date.getMinutes())) : '');
}

function getMessage(message) {
  return "\n    <div class=\"MessageCard ".concat(message.author == window._user ? 'myMessage' : 'theirMessage', "\" id=\"message-").concat(message.id, "\">\n        <a class=\"MessageCard-author\" href=\"/profil/").concat(message.author_uuid, "\" target=\"blank\">\n                <img class=\"MessageCard-author-img\" src=\"/profil/").concat(message.author_uuid, "/img\">\n                <h5 class=\"MessageCard-author-name\">\n                    ").concat(message.author, "\n                </h5>\n            </a>\n        <p class=\"MessageCard-text \">\n            ").concat(message.content, "\n        </p>\n        <span class=\"MessageCard-datetime\">").concat(getDate(message.created_at), "</span>\n    </div>\n    ");
}

function addMessage(msg) {
  $('#MessagesList').append(getMessage(msg));
  $(".ForumLayout-messagesList").animate({
    scrollTop: $('.ForumLayout-messagesList').prop("scrollHeight")
  }, 500);
}

function rendMessages(messages) {
  $('#MessagesList').html(messages.map(function (msg) {
    return getMessage(msg);
  }));
  $(".ForumLayout-messagesList").animate({
    scrollTop: $('.ForumLayout-messagesList').prop("scrollHeight")
  }, 500);
}

function sendMessage() {
  if (!$('#MessageForm-input').val().match(/\S/gm)) return;
  var content = $('#MessageForm-input').val();
  $('#MessageForm-input').val('');
  $('.MessageForm').addClass('inProgress');
  axios({
    method: 'post',
    url: "/message/send",
    data: {
      forum: window._forum,
      content: content
    }
  }).then(function (r) {
    $('.MessageForm').removeClass('inProgress');
    window._last_message_id = r.data.message.id;
  });
}

function fetchMessages() {
  return new Promise(function (resolve) {
    console.log("Fetching messages... (last: ".concat(window._last_message_id, ")"));
    axios({
      method: 'post',
      url: 'https://escalade-montesquieu-pusher.herokuapp.com/fetch',
      timeout: 10 * (60 * 1000),
      // 10 minutes
      data: formUrlEncoded({
        last_message_id: window._last_message_id,
        forum: window._forum
      })
    }).then(function (r) {
      r.data.forEach(function (message) {
        if (message.id > window._last_message_id) {
          window._last_message_id = message.id;
        }

        addMessage(message);

        window._messages.push(message);
      });
      fetchMessages().then(function () {
        return resolve(r);
      });
    })["catch"](function (e) {
      fetchMessages();
    });
  });
}

$(function () {
  $('#MessageForm-send').click(sendMessage);
  $('#MessageForm-input').keyup(function (e) {
    if (e.which == 13) {
      sendMessage();
    }
  });
  rendMessages(window._messages);
  fetchMessages(); // window.Echo.private('forum.'+window._forum)
  // .listen('MessageSent', (e) => {
  //     addMessage(e.message);        
  //     window._messages.push(e.message);
  // });
});

/***/ }),

/***/ 4:
/*!*************************************!*\
  !*** multi ./resources/js/forum.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\projects\Web\As Escalade montesquieu\master\resources\js\forum.js */"./resources/js/forum.js");


/***/ })

/******/ });