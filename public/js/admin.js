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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin.js":
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
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
  } catch (e) {}

  ;
  $('.blog-form').submit(function (e) {
    if ($('#datetimepicker').val().length < 19) $('#datetimepicker').val($('#datetimepicker').val() + ":00");
    console.log($('#datetimepicker').val());
  });
  $(".blog-form #name").keyup(function () {
    $(".blog-form #slug").val(window.removeDiacritics($(this).val()));
  });
  $(".forum-form #name").keyup(function () {
    $(".forum-form #slug").val(window.removeDiacritics($(this).val()));
  });
  $('.UserCard-delete').click(function (e) {
    var name = $(this).parents('.UserCard').attr('data-name');
    var uuid = $(this).parents('.UserCard').attr('data-uuid');
    var confirmation = confirm("Voulez vous supprimez l'utilisateur ".concat(name, "?"));

    if (confirmation) {
      axios({
        method: 'DELETE',
        url: "/admin/user/".concat(uuid)
      }).then(function (r) {
        return location.reload();
      });
    }
  });
  $('.UserCard-changeLevel').change(function (e) {
    var name = $(this).parents('.UserCard').attr('data-name');
    var uuid = $(this).parents('.UserCard').attr('data-uuid');
    var level = $(this).find('option:selected').val();
    var rangs = ["d'utilisateur", "de modérateur", "d'administrateur"];
    var confirmation = confirm("Voulez vous mettre l'utilisateur ".concat(name, " au rang ").concat(rangs[level - 1], "?"));

    if (confirmation) {
      axios({
        method: 'PUT',
        url: "/admin/user/".concat(uuid),
        data: {
          level: level
        }
      }).then(function (r) {
        return location.reload();
      });
    }
  });
  $('#blog').on('change', function () {
    // console.log(this.value);
    if ($('#title').attr('data-changed') == "false" || $('#title').val() == "") {
      $('#title').val($(this).find(":selected").html());
      $('#title').attr('data-changed', "false");
    }
  });
  $('#title').keypress(function () {
    $(this).attr('data-changed', 'true');
  });
  $('#maxplaces-toggle').click(function () {
    if ($(this).is(':checked')) {
      $('#maxplaces').attr('data-before', $('#maxplaces').val());
      $('#maxplaces').val('-1');
      $('#maxplaces').prop("readonly", true);
    } else {
      $('#maxplaces').val($('#maxplaces').attr('data-before'));
      $('#maxplaces').prop("readonly", false);
    }
  });

  if ($('#maxplaces').val() == '-1') {
    $('#maxplaces').prop("readonly", true);
    $('#maxplaces-toggle').prop("checked", true);
    $('#maxplaces').attr('data-before', '10');
  }
});

/***/ }),

/***/ 2:
/*!*************************************!*\
  !*** multi ./resources/js/admin.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\projects\Web\As Escalade montesquieu\master\resources\js\admin.js */"./resources/js/admin.js");


/***/ })

/******/ });