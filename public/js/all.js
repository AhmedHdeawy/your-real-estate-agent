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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/custom.js":
/*!************************************!*\
  !*** ./resources/assets/custom.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//	Start Side Menu Settings
var DomElements = {
  navBarBtn: document.querySelector('.navbar-toggler'),
  sideMenuClose: document.querySelector('.side-menu .close-menu button')
};
var URL = window.location.href;
var lang = URL.split('/')[3];
lang = lang[0] + lang[1];

function menuOpen() {
  if (lang == 'ar') {
    $('#sideMenu').css('display', 'block').animate({
      right: '0'
    }, 400);
  } else {
    $('#sideMenu').css('display', 'block').animate({
      left: '0'
    }, 400);
  }

  $('body').css('overflow', 'hidden');
}

function menuClose() {
  if (lang == 'ar') {
    $('.side-menu').animate({
      right: '-100vw'
    }, 400).delay(400).queue(function (next) {
      $('.side-menu').css('display', 'none');
      $('body').css('overflow', 'auto');
      next();
    });
  } else {
    $('.side-menu').animate({
      left: '-100vw'
    }, 400).delay(400).queue(function (next) {
      $('.side-menu').css('display', 'none');
      $('body').css('overflow', 'auto');
      next();
    });
  }
}

DomElements.navBarBtn.addEventListener('click', menuOpen);
DomElements.sideMenuClose.addEventListener('click', menuClose); //	End Side Menu Settings
//	Start Password Input Visible
// $('.input-group-append').on('click', function () {
// 	if ($(this).siblings().attr('type') === 'password') {
// 		$(this).siblings().prop('type', 'text');
// 	} else if ($(this).siblings().attr('type') === 'text') {
// 		$(this).siblings().prop('type', 'password');
// 	}
// 	$(this).find('i')
// 		.toggleClass('fa-eye')
// 		.toggleClass('fa-eye-slash');
// });
//	End Password Input Visible
//	Start Search Toggle Expand

$('span.expand').on('click', function () {
  if ($('.search-form').hasClass('small-search')) {
    showSearch();
  } else {
    hideSearch();
  }
});

var showSearch = function showSearch() {
  $('.search-form').removeClass('small-search').css({
    overflow: 'visible'
  }).animate({
    height: '440px'
  }).children('span').css({
    transform: 'rotateX(180deg)'
  });
};

var hideSearch = function hideSearch() {
  $('.search-form').addClass('small-search').css({
    overflow: 'hidden'
  }).animate({
    height: '174px'
  }).children('span').css({
    transform: 'rotateX(0)'
  });
}; //	End Search Toggle Expand
//	Start profile Data Edit


$('.data-head').on('click', function () {
  $('.data-edit').slideToggle(400);
}); //	End profile Data Edit
//	Start Friends List Hide / Show

$('#listToggle').on('click', function () {
  friendsShow();
});

var friendsShow = function friendsShow() {
  $('.contacts').slideToggle(400);
  $('#listToggle').toggleClass('opened', 400);

  if ($('#listToggle').hasClass('opened')) {
    $('#listToggle span').css({
      transform: 'rotateX(180deg)'
    });
  } else {
    $('#listToggle span').css({
      transform: 'rotateX(0)'
    });
  }
}; //	End Friends List Hide / Show
// Add another Question when create the group


$('.btn-create-question').click(function (e) {
  e.preventDefault(); // Get Teaxtarea Container

  var textAreaSection = $(this).parent().find('section'); // Get the first textarea

  var textArea = textAreaSection.find('textarea.first:first');

  if (textAreaSection.find('textarea').length > 3) {
    return;
  } // Clone it, and insert it in the last


  var tx = textArea.clone().insertAfter(textAreaSection.find('textarea:last')).val('');
}); // Show Uploaded image under file input

$('.imageUpload').change(function (event) {
  var input = event.target.files[0];
  var inputName = $(this).data('id');

  if (input) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#' + inputName).removeClass('d-none').attr('src', e.target.result);
    };

    reader.readAsDataURL(input);
  }
});

/***/ }),

/***/ 1:
/*!******************************************!*\
  !*** multi ./resources/assets/custom.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/rbzgo/resources/assets/custom.js */"./resources/assets/custom.js");


/***/ })

/******/ });