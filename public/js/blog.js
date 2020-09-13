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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/blog.js":
/*!******************************!*\
  !*** ./resources/js/blog.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
var days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

function countShoes(availables) {
  var shoes = {};
  Object.values(availables).forEach(function (user) {
    shoes[user[1]] = user[1] in shoes ? shoes[user[1]] + 1 : 1;
  });
  return Object.entries(shoes).filter(function (s) {
    return s[0] != 'no-need';
  }).map(function (s) {
    return s.reverse().join(" paire".concat(s[0] > 1 ? 's' : '', " de "));
  }).join(', ');
}

function getDate(datetime) {
  var withMinutes = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
  var date = datetime === undefined ? '' : new Date(datetime);

  var twoDigits = function twoDigits(n) {
    return n == 0 ? '' : n.toString().length == 1 ? "0" + n : n;
  };

  return "".concat(days[date.getDay()], " ").concat(date.getDate(), " ").concat(months[date.getMonth()], " <small>").concat(date.getFullYear(), "<small> ").concat(withMinutes ? "\xE0 ".concat(twoDigits(date.getHours()), "H").concat(twoDigits(date.getMinutes())) : '');
}

function getPost(post) {
  var availables = JSON.parse(post.availables);
  var unavailables = JSON.parse(post.unavailables);
  var harness = Object.values(availables).filter(function (user) {
    return user[0] === 1;
  }).length;
  var participants = Object.keys(availables).length;
  var places = post.maxplaces == -1 ? 99999 : post.maxplaces - participants;
  return "\n        <div class=\"PostCard-content\">\n            <h3>".concat(post.title, "</h3>\n            <div class=\"particip\">\n                <span class=\"nb-availables\">").concat(participants, " participant").concat(participants > 2 ? 's' : '', "</span>\n                ").concat(user ? user.name in availables ? "<button class=\"btn unavailable-post\" data-post-id=\"".concat(post.id, "\">Se retirer</button>\n                ") : "<button class=\"btn join-post ".concat(places <= 0 ? 'disabled' : '', "\" data-post-id=\"").concat(post.id, "\">Participer</button>") : "<button class=\"btn login-user\" data-post-id=\"".concat(post.id, "\">Participer</button>"), "\n            </div>\n        </div>\n            <div class=\"PostCard-more\">\n            ").concat(user && user.level > 1 ? "<div class=\"PostCard-adminInfo\">\n                <span class=\"availables\">Participants: ".concat(Object.keys(availables).join(', ') || 'aucun', "</span>\n                <span class=\"unavailables\">Indisponibles: ").concat(unavailables.join(', ') || 'aucun', "</span>\n                <span>Baudrier").concat(harness > 1 ? 's' : '', " \xE0 prendre: ").concat(harness, "</span>\n                <span>Chaussures \xE0 prendre: ").concat(countShoes(availables) || 'aucune', "</span>\n            </div>\n            <div class=\"PostCard-adminActions\">\n                <a href=\"/post/").concat(post.id, "/edit\" class=\"btn edit-post\" title=\"\xC9diter\"><img src=\"/assets/svg/edit-2.svg\"></a>\n            </div>\n            ") : '', "\n            <div class=\"PostCard-info\">\n                ").concat($('#post-' + post.id).attr('data-show-datetime') == "true" ? "<h5>".concat(getDate(post.datetime), "</h5>") : '', "\n                <a class=\"location\" target=\"blank\" href=\"https://www.google.fr/maps/search/").concat(post.location, "+france\">").concat(post.location === null ? '' : post.location, "</a>\n                <span class=\"maxplaces\">").concat(post.maxplaces == -1 ? 'Places illimitées' : places + " ".concat(places > 1 ? 'places restantes' : 'place restante'), "</span>\n                <p class=\"desc\">").concat(post.content === null ? '' : post.content, "</p>\n            </div>\n        </div>\n    ");
}

function rendPost(post) {
  $('#post-' + post.id).html(getPost(post));
  $('#post-' + post.id + ' .PostCard-content').click(function (e) {
    if (e.target.nodeName == 'BUTTON') return;
    var close = $(this).parent().attr('class') == 'PostCard';
    $('.PostCard-content').parent().attr('class', 'PostCard');

    if (close) {
      $(this).parent().attr('class', 'PostCard open');
    }
  });
}

function rendPosts(posts) {
  var firstRending = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  posts.forEach(function (post, index) {
    try {
      if (firstRending && posts[index - 1].datetime.split(' ')[0] !== post.datetime.split(' ')[0]) $("<h3 class=\"date-group\">".concat(getDate(post.datetime, false), "</h3>")).insertBefore('#post-' + post.id);
    } catch (e) {
      if (firstRending) $("<h3 class=\"date-group\">".concat(getDate(post.datetime, false), "</h3>")).insertBefore('#post-' + post.id);
    }

    rendPost(post);
  });
}

function participate(e) {
  e.preventDefault();
  var id = $(this).attr('data-post-id');
  axios({
    method: 'post',
    url: "/post/".concat(id, "/participate")
  }).then(function (r) {
    rendPost(r.data, id);
    $('.join-post').click(participate);
    $('.unavailable-post').click(unavailable);
  });
}

function unavailable(e) {
  e.preventDefault();
  var id = $(this).attr('data-post-id');
  axios({
    method: 'delete',
    url: "/post/".concat(id, "/participate")
  }).then(function (r) {
    rendPost(r.data, id);
    $('.join-post').click(participate);
    $('.unavailable-post').click(unavailable);
  });
}

$(function () {
  try {
    rendPosts(posts, true);
  } catch (e) {
    console.warn('posts is not defined');
  }

  $('.join-post:not(.disabled)').click(participate);
  $('.unavailable-post').click(unavailable);
  $('.login-user').click(function () {
    return location.replace('/login');
  });
});

/***/ }),

/***/ 3:
/*!************************************!*\
  !*** multi ./resources/js/blog.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\projects\Web\As Escalade montesquieu\master\resources\js\blog.js */"./resources/js/blog.js");


/***/ })

/******/ });