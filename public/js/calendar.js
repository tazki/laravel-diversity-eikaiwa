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

/***/ "./resources/js/calendar.js":
/*!**********************************!*\
  !*** ./resources/js/calendar.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var fcTheme = FullCalendar.Theme;

  var LooperCalendarTheme = function (fcTheme) {
    function LooperCalendarTheme() {
      fcTheme.apply(this, arguments);
    }

    if (fcTheme) LooperCalendarTheme.__proto__ = fcTheme;
    LooperCalendarTheme.prototype = Object.create(fcTheme && fcTheme.prototype);
    LooperCalendarTheme.prototype.constructor = LooperCalendarTheme;
    return LooperCalendarTheme;
  }(fcTheme);

  LooperCalendarTheme.prototype.classes = {
    widget: 'fc-bootstrap4',
    tableGrid: 'table-bordered',
    tableList: 'table',
    tableListHeading: 'bg-light',
    buttonGroup: 'btn-group',
    button: 'btn btn-secondary',
    stateActive: 'active',
    stateDisabled: 'disabled',
    today: 'highlight',
    popover: 'popover',
    popoverHeader: 'popover-header',
    popoverContent: 'popover-body',
    headerRow: 'table-bordered',
    dayRow: 'table-bordered',
    listView: 'card card-reflow'
  };
  LooperCalendarTheme.prototype.iconClasses = {
    close: 'fa-times',
    prev: 'fa-chevron-left',
    next: 'fa-chevron-right',
    prevYear: 'fa-angle-double-left',
    nextYear: 'fa-angle-double-right'
  };
  LooperCalendarTheme.prototype.baseIconClass = 'fa';
  LooperCalendarTheme.prototype.iconOverrideOption = 'fontAwesome';
  LooperCalendarTheme.prototype.iconOverrideCustomButtonOption = 'fontAwesome';
  LooperCalendarTheme.prototype.iconOverridePrefix = 'fa-';
  FullCalendar.defineThemeSystem('looper', LooperCalendarTheme);
  $('#calendar').fullCalendar({
    themeSystem: 'looper',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    defaultView: 'month',
    height: 'auto',
    nowIndicator: true,
    weekNumbers: false,
    navLinks: true,
    editable: false,
    eventLimit: true,
    eventTextColor: 'rgb(52, 108, 176)',
    eventBackgroundColor: 'rgba(52, 108, 176, .12)',
    eventBorderColor: 'rgb(52, 108, 176)',
    events: 'js/json/events.json',
    eventRender: function eventRender(eventObj, $el) {
      $el.popover({
        title: eventObj.title,
        content: eventObj.description,
        trigger: 'hover',
        placement: 'top',
        container: 'body'
      });
    }
  });
});

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/calendar.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/tazki/Documents/web/laravel/diversity-eikaiwa/resources/js/calendar.js */"./resources/js/calendar.js");


/***/ })

/******/ });