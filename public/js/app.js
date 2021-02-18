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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

$(document).on('theme:init', function () {
  var uploadDropzone;
  var isDropZoneInit;
  var countryFlags = 'https://lipis.github.io/flag-icon-css/flags/4x3/';

  function format(item, state) {
    if (!item.id) {
      return item.text;
    }

    var img = $('<img>', {
      "class": 'img-flag',
      width: 26,
      src: countryFlags + item.element.attributes[1].value.toLowerCase() + '.svg'
    });
    var span = $('<span>', {
      text: ' ' + item.text
    });
    span.prepend(img);
    return span;
  }

  function formatState(state) {
    if (!state.id) {
      return state.text;
    }

    var $state = $('<span><img class="img-flag" width="26px" src="' + countryFlags + state.element.attributes[1].value.toLowerCase() + '.svg" class="img-flag" /> ' + state.text + '</span>');
    return $state;
  }

  $('.js-client-country').select2({
    width: '100%',
    placeholder: 'Select country',
    templateResult: function templateResult(item) {
      return format(item, false);
    },
    templateSelection: formatState
  });
  $('.js-accept-checkbox').click(function () {
    var element = $(this);
    var isCheck = $(this).prop('checked');

    if (isCheck == true) {
      element.removeClass('is-invalid');
    } else {
      element.addClass('is-invalid');
    }
  });
  var pageVisibility = document.querySelector('.js-password-visibility');

  if (pageVisibility !== null) {
    var togglePassword = pageVisibility.querySelector('.js-togglePassword');
    var password = pageVisibility.querySelector('input[type=password]');
    togglePassword.addEventListener('click', function (e) {
      var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });
  }

  function isObject(val) {
    if (val === null) {
      return false;
    }

    return typeof val === 'function' || _typeof(val) === 'object';
  }

  window.showAlert = function (formID, data) {
    var notifyMsg = '';
    $('.alert').remove();
    $('.invalid-feedback').remove();
    $('.form-control').removeClass('is-invalid');

    if (isObject(data.message) && data.status == 'danger') {
      $.each(data.message, function (key, value) {
        notifyMsg += '<div>' + value + '</div>';
        $('input[name="' + key + '"]').addClass('is-invalid');
        $('input[name="' + key + '"]').after('<div class="invalid-feedback">' + value + '</div>');
      });
    } else if (isObject(data.message)) {
      $.each(data.message, function (key, value) {
        notifyMsg += '<div>' + value + '</div>';
      });
    } else {
      notifyMsg += '<div>' + data.message + '</div>';
    } // For Success Alert Only
    // To be use inside Controller
    // - notify = inline, popup
    // - action = reload, redirect, hideModal,previewContent
    // - actionUrl = url to redirect
    // - actionData is use together with previewContent


    if (typeof data.notify !== 'undefined') {
      // If Page has Confirm Option
      if (data.action == 'confirm') {
        $(formID).addClass('is-confirm');
        $('.js-btn-cancel').addClass('d-none');
        $('.js-btn-confirm').addClass('d-none');
        $('.js-btn-back').removeClass('d-none');
        $('.js-btn-submit').removeClass('d-none');
        $('.form-control').attr('readonly', 'readonly');
        $('.form-control.js-input-flatpickr.input').attr('disabled', 'disabled'); // $('.custom-control-input').attr('disabled', 'disabled');

        $('.js-btn-confirm-disabled').attr('disabled', 'disabled');
        $('.js-input-confirm').remove();
        $('.modal-body').scrollTop(0);
      } else {
        if (notifyMsg != '') {
          var modalHeader = $(formID).parents('.modal').find('.modal-header');

          if (modalHeader.length > 0) {
            $('<div class="alert alert-info alert-dismissible fade show ' + data.status + '">' + notifyMsg + '</div>').insertAfter(modalHeader);
          } else {
            $('.page-inner').prepend('<div class="alert alert-info alert-dismissible fade show col-12 ' + data.status + '">' + notifyMsg + '</div>');
          }

          setTimeout(function () {
            $('.alert').fadeTo(500, 0).slideUp(500, function () {
              $(this).remove();
              formAction(formID, data);
            });
          }, 1000);
        } else {
          formAction(formID, data);
        }
      }
    }
  };

  function formAction(formID, data) {
    if (data.status == 'success') {
      if (typeof data.action !== 'undefined') {
        switch (data.action) {
          case 'reload':
            location.reload();
            break;

          case 'redirect':
            location.href = data.actionUrl;
            break;

          case 'hideModal':
            $(formID).parents('.modal').modal('hide');
            formID.trigger('reset'); // If Page has Confirm Option

            if ($('.js-btn-back').length) {
              backConfirm();
            }

            break;

          case 'previewContent':
            // console.log(data.actionData);
            $('.js-form-view').remove();
            $('.js-form-edit').hide();
            $('.js-form-edit').after(data.actionData);
            break;

          case 'previewPartialContent':
            $('.js-form-view').html(data.actionData);
            break;
        }
      }
    }
  }

  window.ajaxForm = function (btnObj) {
    var btnHTML = $(btnObj).html();
    var formID = $(btnObj).parents('form');

    if (!$(btnObj).hasClass('js-no-loader')) {
      $(btnObj).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading');
    }

    if ($(btnObj).hasClass('js-send-chat')) {
      if ($('div.emojionearea-editor').data('emojioneArea').getText() == '') {
        return false;
      }
    }

    btnObj.disabled = true;
    $(btnObj).parents('.modal').addClass('is-loading');
    $.ajax({
      url: $(formID).attr('action'),
      type: "POST",
      data: new FormData($(formID)[0]),
      //$(formID).serialize(),
      cache: false,
      processData: false,
      contentType: false
    }).done(function (data) {
      $(btnObj).parents('.modal').removeClass('is-loading');

      if (data.action != 'reload' && data.action != 'redirect') {
        $(btnObj).html(btnHTML);
        btnObj.disabled = false;
      }

      window.showAlert(formID, data);
    });
  };

  window.ajaxFetch = function (btnObj) {
    console.log(btnObj);
    var modalId = $(btnObj).data('target');
    var formObj = $(modalId).find('form');
    var inputTypeObj = ['input', 'textarea', 'select'];
    $(modalId).find('.modal-title').text($(btnObj).attr('data-title'));
    $(modalId).find('.invalid-feedback').remove();
    $(modalId).find('.form-control').removeClass('is-invalid');
    $(modalId).addClass('is-loading');
    $.ajax({
      url: $(btnObj).data('url'),
      type: "GET",
      cache: false
    }).done(function (data) {
      console.log(data);
      $(modalId).removeClass('is-loading');
      var updateUrl = $(btnObj).data('update');
      formObj.attr('action', updateUrl);

      if ($('.js-btn-status').length > 0) {
        $('.js-btn-status').attr('data-id', data.id);
      }

      if (typeof data.action !== 'undefined') {
        if (data.action == 'previewContent') {
          $('.js-form-view').remove();
          $('.js-form-edit').hide();
          $('.js-form-edit').after(data.actionData);
        }
      } // It is use for filling data in Form


      $.each(data, function (fieldName, fieldValue) {
        $.each(inputTypeObj, function (key, input) {
          var inputObj = $(input + '[name="' + fieldName + '"]');

          if (inputObj.is('input')) {
            if (inputObj.hasClass('js-input-flatpickr') && !inputObj.hasClass('js-input-flatpickr-setMaxDate') && !inputObj.hasClass('js-input-flatpickr-setMinDate')) {
              var allowEdit = true;

              if (data.status == 3) {
                allowEdit = false;
              }

              var defaultDatePicker = inputObj.flatpickr({
                disableMobile: 'true',
                altInput: true,
                altFormat: 'F j, Y',
                dateFormat: 'Y-m-d',
                defaultDate: data.due_date,
                clickOpens: allowEdit
              });
            } else if (inputObj.hasClass('js-input-flatpickr-setMaxDate')) {
              var datePickerMaxDate = inputObj.flatpickr({
                disableMobile: 'true',
                altInput: true,
                altFormat: 'F j, Y',
                dateFormat: 'Y-m-d',
                maxDate: data.due_date
              });
              datePickerMaxDate.setDate(data.remind_before_due_date);
            } else if (inputObj.hasClass('js-input-flatpickr-setMinDate')) {
              var datePickerMinDate = inputObj.flatpickr({
                disableMobile: 'true',
                altInput: true,
                altFormat: 'F j, Y',
                dateFormat: 'Y-m-d',
                minDate: data.due_date
              });
              datePickerMinDate.setDate(data.remind_after_due_date);
            } else {
              inputObj.val(fieldValue);
            }
          } else if (inputObj.is('textarea')) {
            inputObj.html(fieldValue);
          } else if (inputObj.is('select')) {
            // this is used to assign value to select2 input type
            if (inputObj.hasClass('custom-select') || inputObj.hasClass('custom-select2')) {
              inputObj.val(fieldValue).trigger('change');
            } else {
              inputObj.val(fieldValue);
            }
          }
        });
      }); // It is use for dropzone upload js

      if (updateUrl != undefined && $('.js-dropzone-upload').length > 0) {
        isDropZoneInit = true;
        Dropzone.autoDiscover = false;
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        uploadDropzone = new Dropzone('.js-dropzone-upload', {
          url: updateUrl,
          addRemoveLinks: true,
          maxFiles: 1,
          maxFilesize: 2,
          acceptedFiles: ".jpeg,.jpg,.png,.pdf,.xls,.xlsx,.doc,.docx,.txt,.pptx,.csv"
        });
        uploadDropzone.on('sending', function (file, xhr, formData) {
          formData.append('_token', CSRF_TOKEN);
        });
        uploadDropzone.on('success', function () {
          var args = Array.prototype.slice.call(arguments); // Look at the output in you browser console, if there is something interesting
          // console.log(args[1]);

          window.showAlert(formObj, args[1]);
          uploadDropzone.removeAllFiles(true);
          $(modalId).modal('hide');
        });
        uploadDropzone.on('maxfilesexceeded', function (file) {
          this.removeFile(file);
        });
        uploadDropzone.on('error', function (file, message) {
          console.log(message); // this.removeFile(file);
        });
      }
    });
  };

  window.ajaxFetchTemplate = function (btnObj) {
    var modalId = $(btnObj).data('target');
    $(modalId).find('.modal-title').text($(btnObj).attr('data-title'));
    $(modalId).find('.invalid-feedback').remove();
    $(modalId).find('.form-control').removeClass('is-invalid');
    $(modalId).addClass('is-loading');
    $.ajax({
      url: $(btnObj).data('url'),
      type: "GET",
      cache: false
    }).done(function (data) {
      // console.log(data);
      $(modalId).removeClass('is-loading');
      $(modalId).find('.modal-body').html(data);
    });
  };

  window.ajaxSingle = function (btnObj) {
    var statusClass = $(btnObj).children("option:selected").data('status');
    $(btnObj).addClass(statusClass);
    var disableEle = $(btnObj).data('disable');
    disableEle.disabled = true;
    var ajaxUrl = $(btnObj).data('update');

    if ($(btnObj).val() != '') {
      ajaxUrl = $(btnObj).data('update') + '/' + $(btnObj).val();
    }

    $.ajax({
      url: ajaxUrl,
      type: "GET",
      cache: false,
      processData: false,
      contentType: false
    }).done(function (data) {
      disableEle.disabled = false;
      $('.alert').remove();
      $('.page-inner').prepend('<div class="alert alert-info alert-dismissible fade show col-12 ' + data.status + '">' + data.message + '</div>');
      $('.alert').fadeTo(1500, 0).slideUp(1500, function () {
        $(this).remove();
      });
      $('#dataTableIndex').DataTable().ajax.reload(function (json) {
        window.setReadmore();
        $('.js-status-filter .btn').removeClass('active');
        $('input[value="status-all"]').attr('checked', true).parent().addClass('active');
      });
    });
  };

  window.setReadmore = function () {
    $('.js-read-more-item').readmore({
      speed: 75,
      collapsedHeight: 24,
      lessLink: '<a href="#">Read less</a>'
    });
  };

  $('body').on('change', 'input[type=radio][name=template_id]', function () {
    var selectedTemplateItem = this;
    $('#templateListModal').find('.list-group-item').removeClass('active');
    $(selectedTemplateItem).closest('.list-group-item ').addClass('active');
  });

  function notifyPopUp(formID, data, msg) {
    $('.modal-default-popup .modal-content-holder').html(msg);
    $('.modal-default-popup').modal('show');
    setTimeout(function () {
      $('.modal-default-popup').modal('hide');
      formAction(formID, data);
    }, 1500);
  }
  /*
   * Trigger: js-photo-preview
   * Target Parent Element: js-photo-preview-holder
   * Target Img: js-img-preview
   * Target Placeholder: js-img-placeholder
   * Sample Template
   * <div class="js-photo-preview-holder">
   *  <img class="js-img-preview" />
   *  <img class="js-img-placeholder" />
   *  <input type="file" class="js-photo-preview" />
   * </div>
   */


  $('body').on('change', '.js-photo-preview', function () {
    var inputFile = this;

    if (inputFile.files && inputFile.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(inputFile).parent('.js-photo-preview-holder').children('.js-img-preview').attr('src', e.target.result).show(); // $(inputFile).parent('.js-photo-preview-holder').children('.js-img-placeholder').hide();
      };

      reader.readAsDataURL(inputFile.files[0]);
    }
  });
  $('body').on('change', '.js-bgphoto-preview', function () {
    var inputFile = this;

    if (inputFile.files && inputFile.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(inputFile).parents('.js-bgphoto-preview-holder').attr('style', 'background: url("' + e.target.result + '") no-repeat');
      };

      reader.readAsDataURL(inputFile.files[0]);
    }
  });
  $('body').on('click', '.js-btn-back', function () {
    backConfirm();
  }); // All code here are used to reset form

  $('body').on('click', '.js-btn-add', function () {
    var modalId = $(this).data('target');
    $(modalId).find('.modal-title').text($(this).attr('data-title'));
    $(modalId).find('.form-control').val('');
    $(modalId).find('.custom-select').val(null).trigger('change');
    $(modalId).find('form').attr('action', $(this).data('create'));
  });

  function backConfirm() {
    $('.js-btn-cancel').removeClass('d-none');
    $('.js-btn-confirm').removeClass('d-none');
    $('.js-btn-back').addClass('d-none');
    $('.js-btn-submit').addClass('d-none');
    $('.form-control').removeAttr('readonly', 'readonly');
    $('.form-control.js-input-flatpickr').removeAttr('disabled');
    $('.custom-control-input').removeAttr('disabled');
    $('.js-btn-confirm-disabled').removeAttr('disabled');
    $('form').removeClass('is-confirm');
    $('.js-btn-back').after('<input type="hidden" name="confirm_first" class="js-input-confirm" value="1" />');
  }

  $('.modal:not(.is-confirm-modal)').on('hidden.bs.modal', function (event) {
    if (!$(this).find('form').hasClass('view-form-only')) {
      // $(this).find('form')[0].reset();
      $(this).find('input').removeClass('is-invalid').val('');
      $(this).find('textarea').html('');
      $(this).find('input:checkbox').attr('checked', false);
      $(this).find('input:checkbox').prop('checked', false);
      $(this).find('input:checkbox').removeAttr('checked');
      $(this).find('.form-control').removeAttr('readonly', 'readonly');
      $(this).find('.form-control.js-input-flatpickr').removeAttr('disabled');
      $(this).find('.custom-control-input').removeAttr('disabled');
      $(this).find('.js-btn-confirm-disabled').removeAttr('disabled');
      $(this).find('form').removeClass('is-confirm');
    }

    if (isDropZoneInit == true) {
      uploadDropzone.destroy();
      uploadDropzone.removeAllFiles(true);
    }
  });
  $('.modal.modal-no-overlap').on('shown.bs.modal', function (e) {
    var currentModal;
    currentModal = this;
    $('.modal').each(function () {
      if (this !== currentModal) {
        $(this).modal('hide');
      }
    });
  });
  $('.modal:not(.modal-no-scrolltop)').on('shown.bs.modal', function (e) {
    if ($(this).find('.modal-body')[0] != undefined) {
      $(this).find('.modal-body').animate({
        scrollTop: $(this).find('.modal-body')[0]
      }, 1000);
    }
  });
  $('#clientTaskChatFormModal').on('shown.bs.modal', function (e) {
    $('.emojionearea-editor').focus();

    if ($('#clientTaskChatFormModal .message-body')[0] != undefined) {
      $('#clientTaskChatFormModal .message-body').animate({
        scrollTop: $('#clientTaskChatFormModal .message-body')[0].scrollHeight
      }, 1000);
    }
  });
  $('.navbar-nav .nav-link').on('click', function (event) {
    if (this.hash !== '') {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function () {
        window.location.hash = hash;
      });
    }
  });
  $('body').on('click', '.js-dropdown-item', function (event) {
    var currentItem = $(this);
    var dropdownItemText = this.text;
    var dropdownItemType = currentItem.attr('data-type');
    var dropdownParent = currentItem.parents('.js-btn-group-parent').find('.js-dropdown-selected');
    dropdownParent.text(dropdownItemText);

    if (dropdownItemType == "restricted") {
      $('.js-group-anyone').addClass('d-none');
      $('.js-group-restricted').removeClass('d-none');
      $('.js-group-icon').removeClass('fa-globe').addClass('fa-lock');
      $('.js-view-access').val(1);
    } else {
      $('.js-group-anyone').removeClass('d-none');
      $('.js-group-restricted').addClass('d-none');
      $('.js-group-icon').removeClass('fa-lock').addClass('fa-globe');
      $('.js-view-access').val(0);
    }
  });
  $('body').on('change', '.js-status-switcher-control', function () {
    var newStatus = 1;
    var status = $(this).children('.switcher-input').val();

    if (status == 1) {
      newStatus = 0;
    }

    $(this).children('.switcher-input').val(newStatus);
  });
  var btnBackToTop = $('#js-back-to-top');
  var offset = 500;
  var duration = 500;
  $(window).scroll(function () {
    if ($(this).scrollTop() > offset) {
      btnBackToTop.fadeIn(duration);
    } else {
      btnBackToTop.fadeOut(duration);
    }
  });
  btnBackToTop.click(function (event) {
    event.preventDefault();
    jQuery('html, body').animate({
      scrollTop: 0
    }, duration);
    return false;
  });
  $(window).keydown(function (event) {
    if (event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
  $('body').on('change', '#forgot-role', function () {
    var url = $(this).val();
    console.log(url);
    $(this).parents('form').attr('action', url);
  });
});
window.setTimeout(function () {
  $('.alert').fadeTo(500, 0).slideUp(500, function () {
    $(this).remove();
  });
}, 1000);

/***/ }),

/***/ "./resources/sass/custom-dark.scss":
/*!*****************************************!*\
  !*** ./resources/sass/custom-dark.scss ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/custom.scss":
/*!************************************!*\
  !*** ./resources/sass/custom.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/theme-dark.scss":
/*!****************************************!*\
  !*** ./resources/sass/theme-dark.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/theme.scss":
/*!***********************************!*\
  !*** ./resources/sass/theme.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/theme.scss ./resources/sass/theme-dark.scss ./resources/sass/custom.scss ./resources/sass/custom-dark.scss ***!
  \***************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/tazki/Documents/web/laravel/diversity-eikaiwa/resources/js/app.js */"./resources/js/app.js");
__webpack_require__(/*! /Users/tazki/Documents/web/laravel/diversity-eikaiwa/resources/sass/theme.scss */"./resources/sass/theme.scss");
__webpack_require__(/*! /Users/tazki/Documents/web/laravel/diversity-eikaiwa/resources/sass/theme-dark.scss */"./resources/sass/theme-dark.scss");
__webpack_require__(/*! /Users/tazki/Documents/web/laravel/diversity-eikaiwa/resources/sass/custom.scss */"./resources/sass/custom.scss");
module.exports = __webpack_require__(/*! /Users/tazki/Documents/web/laravel/diversity-eikaiwa/resources/sass/custom-dark.scss */"./resources/sass/custom-dark.scss");


/***/ })

/******/ });