(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/css/app.css":
/*!****************************!*\
  !*** ./assets/css/app.css ***!
  \****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/images/logo.png":
/*!********************************!*\
  !*** ./assets/images/logo.png ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/logo.0072b469.png";

/***/ }),

/***/ "./assets/images/profil.svg":
/*!**********************************!*\
  !*** ./assets/images/profil.svg ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/build/images/profil.96a2c3f0.svg";

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you require will output into a single css file (app.css in this case)
__webpack_require__(/*! ../css/app.css */ "./assets/css/app.css"); //const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
//require('bootstrap');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

/*$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});*/


__webpack_require__(/*! ../js/main.js */ "./assets/js/main.js");

__webpack_require__(/*! ../images/logo.png */ "./assets/images/logo.png");

__webpack_require__(/*! ../images/profil.svg */ "./assets/images/profil.svg");

/***/ }),

/***/ "./assets/js/main.js":
/*!***************************!*\
  !*** ./assets/js/main.js ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $("#search-filter").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTableBody tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
  /*//exporte les données sélectionnées
  var $table = $('#table');
  $(function () {
   $('#toolbar').find('select').change(function () {
       $table.bootstrapTable('refreshOptions', {
           exportDataType: $(this).val(),
       });
   });
  })
  var trBoldBlue = $("table");*/
  // Au clique d'une case d'un tableau cela nous redirige vers la page correspondante

  $("tbody td").click(function () {
    var UrlLink = $(this).find("a").attr('href');
    $(location).attr('href', UrlLink);
  });
  /**$(trBoldBlue).on("click", "tr", function (){
  		$(this).toggleClass("bold-blue");
  });
   $( "#export" ).click(function() {
  	$("#table").tableExport({
      headings: true,                    // (Boolean), display table headings (th/td elements) in the <thead>
      footers: true,                     // (Boolean), display table footers (th/td elements) in the <tfoot>
      formats: ["csv"],    // (String[]), filetypes for the export
      fileName: "id",                    // (id, String), filename for the downloaded file
      bootstrap: true,                   // (Boolean), style buttons using bootstrap
      position: "bottom",                 // (top, bottom), position of the caption element relative to table
      ignoreRows: null,                  // (Number, Number[]), row indices to exclude from the exported file(s)
      ignoreCols: null,                  // (Number, Number[]), column indices to exclude from the exported file(s)
      ignoreCSS: ".tableexport-ignore",  // (selector, selector[]), selector(s) to exclude from the exported file(s)
      emptyCSS: ".tableexport-empty",    // (selector, selector[]), selector(s) to replace cells with an empty string in the exported file(s)
      trimWhitespace: false              // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s)
  });
  })**/
  // ---------- Tableau contenant la liste des données -------------
  // Au clique de la checkbox principal, cela sélectionne toutes les checkbox
  // Plus possiblité de séléctionner plusieurs checkbox

  $("#table #checkall").click(function () {
    if ($("#table #checkall").is(':checked')) {
      $("#table input[type=checkbox]").each(function () {
        $(this).prop("checked", true);
      });
    } else {
      $("#table input[type=checkbox]").each(function () {
        $(this).prop("checked", false);
      });
    }
  });
  $("[data-toggle=tooltip]").tooltip(); // --------------------------------------------------------------

  $.fn.pageMe = function (opts) {
    var $this = this,
        defaults = {
      perPage: 7,
      showPrevNext: false,
      hidePageNumbers: false
    },
        settings = $.extend(defaults, opts);
    var listElement = $this;
    var perPage = settings.perPage;
    var children = listElement.children();
    var pager = $('.pager');

    if (typeof settings.childSelector != "undefined") {
      children = listElement.find(settings.childSelector);
    }

    if (typeof settings.pagerSelector != "undefined") {
      pager = $(settings.pagerSelector);
    }

    var numItems = children.length;
    var numPages = Math.ceil(numItems / perPage);
    pager.data("curr", 0);

    if (settings.showPrevNext) {
      $('<li class="page-item prev-page"><a href="#" class="prev-link"><i class="fas fa-arrow-left"></i></a></li>').appendTo(pager);
    }

    var curr = 0;

    while (numPages > curr && settings.hidePageNumbers == false) {
      $('<li class="page-item"><a href="#" class="link-page">' + (curr + 1) + '</a></li>').appendTo(pager);
      curr++;
    }

    if (settings.showPrevNext) {
      $('<li class="page-item next-page"><a href="#" class="next-link"><i class="fas fa-arrow-right"></i></a></li>').appendTo(pager);
    }

    var nbPage = $(".pager li").length - 2;
    pager.find('.link-page:first').addClass('active');
    /*pager.find('.prev-link').hide();*/

    pager.find('.prev-link').addClass("prev-link-diseable"); //pager.find('.prev-link').removeClass("prev-link");

    if (numPages <= 1) {
      /*pager.find('.next-link').hide();*/
      pager.find('.next-link').addClass("next-link-diseable");
      pager.find('.next-link').removeClass("next-link");
    }

    if (nbPage === 2) {
      $(".table-after-pagination").addClass("table-after-pagination-2-width");
      $(".table-after-pagination").removeClass("table-after-pagination-3-width");
      $(".table-after-pagination").removeClass("table-after-pagination-4-width");
      $(".table-after-pagination").removeClass("table-after-pagination-5-width");
    } else if (nbPage === 3) {
      $(".table-after-pagination").addClass("table-after-pagination-3-width");
      $(".table-after-pagination").removeClass("table-after-pagination-2-width");
      $(".table-after-pagination").removeClass("table-after-pagination-4-width");
      $(".table-after-pagination").removeClass("table-after-pagination-5-width");
    } else if (nbPage === 4) {
      $(".table-after-pagination").addClass("table-after-pagination-4-width");
      $(".table-after-pagination").removeClass("table-after-pagination-2-width");
      $(".table-after-pagination").removeClass("table-after-pagination-3-width");
      $(".table-after-pagination").removeClass("table-after-pagination-5-width");
    } else if (nbPage === 5) {
      $(".table-after-pagination").addClass("table-after-pagination-5-width");
      $(".table-after-pagination").removeClass("table-after-pagination-2-width");
      $(".table-after-pagination").removeClass("table-after-pagination-3-width");
      $(".table-after-pagination").removeClass("table-after-pagination-4-width");
    }

    pager.children().eq(1).addClass("active");
    children.hide();
    children.slice(0, perPage).show();
    pager.find('li .link-page').click(function () {
      var clickedPage = $(this).html().valueOf() - 1;
      goTo(clickedPage, perPage);
      return false;
    });
    pager.find('li .prev-link').click(function () {
      previous();
      return false;
    });
    pager.find('li .next-link').click(function () {
      next();
      return false;
    });

    function previous() {
      var goToPage = parseInt(pager.data("curr")) - 1;
      goTo(goToPage);
    }

    function next() {
      goToPage = parseInt(pager.data("curr")) + 1;
      goTo(goToPage);
    }

    function goTo(page) {
      var startAt = page * perPage,
          endOn = startAt + perPage;
      children.css('display', 'none').slice(startAt, endOn).show();

      if (page >= 1) {
        /*pager.find('.prev-link').show();*/
        pager.find('.prev-link-diseable').addClass("prev-link");
        pager.find('.prev-link-diseable').removeClass("prev-link-diseable");
      } else {
        /*pager.find('.prev-link').hide();*/
        pager.find('.prev-link').addClass("prev-link-diseable");
        pager.find('.prev-link').removeClass("prev-link");
      }

      if (page < numPages - 1) {
        /*pager.find('.next-link').show();*/
        pager.find('.next-link-diseable').addClass("next-link");
        pager.find('.next-link-diseable').removeClass("next-link-diseable");
      } else {
        /*pager.find('.next-link').hide();*/
        pager.find('.next-link').addClass("next-link-diseable");
        pager.find('.next-link').removeClass("next-link");
      }

      pager.data("curr", page);
      pager.children().removeClass("active");
      pager.children().eq(page + 1).addClass("active");
    }
  };
  /*$("#table-nb-entry").change(function(){
  	$("#table-nb-entry option:selected").each(function(){
  		nbPerPage = $(this).text();
  	});
  	console.log(nbPerPage);
  });*/

  /*$("#table-nb-entry option:selected").click(function(){
  	var nbPerPage = $("#table-nb-entry option:selected").text();
  	console.log(nbPerPage);
  });*/


  $('#myTableBody').pageMe({
    pagerSelector: '#myPager',
    showPrevNext: true,
    hidePageNumbers: false,
    perPage: 5
  });
  $(function () {
    $('[data-toggle="popover"]').popover({
      html: true,
      trigger: 'hover'
    });
  }) // ---------- Opération -------------
  // --------------------------------------------------------------

  /*
  *  jQuery StarRatingSvg v1.2.0
  *
  *  http://github.com/nashio/star-rating-svg
  *  Author: Ignacio Chavez
  *  hello@ignaciochavez.com
  *  Licensed under MIT
  */
  ;

  (function ($, window, document, undefined) {
    'use strict'; // Create the defaults once

    var pluginName = 'starRating';

    var noop = function noop() {};

    var defaults = {
      totalStars: 5,
      useFullStars: false,
      starShape: 'straight',
      emptyColor: 'lightgray',
      hoverColor: 'orange',
      activeColor: 'gold',
      ratedColor: 'crimson',
      useGradient: true,
      readOnly: false,
      disableAfterRate: false,
      baseUrl: false,
      starGradient: {
        start: '#FEF7CD',
        end: '#FF9511'
      },
      strokeWidth: 4,
      strokeColor: 'black',
      initialRating: 0,
      starSize: 40,
      callback: noop,
      onHover: noop,
      onLeave: noop
    }; // The actual plugin constructor

    var Plugin = function Plugin(element, options) {
      var _rating;

      var newRating;
      var roundFn;
      this.element = element;
      this.$el = $(element);
      this.settings = $.extend({}, defaults, options); // grab rating if defined on the element

      _rating = this.$el.data('rating') || this.settings.initialRating; // round to the nearest half

      roundFn = this.settings.forceRoundUp ? Math.ceil : Math.round;
      newRating = (roundFn(_rating * 2) / 2).toFixed(1);
      this._state = {
        rating: newRating
      }; // create unique id for stars

      this._uid = Math.floor(Math.random() * 999); // override gradient if not used

      if (!options.starGradient && !this.settings.useGradient) {
        this.settings.starGradient.start = this.settings.starGradient.end = this.settings.activeColor;
      }

      this._defaults = defaults;
      this._name = pluginName;
      this.init();
    };

    var methods = {
      init: function init() {
        this.renderMarkup();
        this.addListeners();
        this.initRating();
      },
      addListeners: function addListeners() {
        if (this.settings.readOnly) {
          return;
        }

        this.$stars.on('mouseover', this.hoverRating.bind(this));
        this.$stars.on('mouseout', this.restoreState.bind(this));
        this.$stars.on('click', this.handleRating.bind(this));
      },
      // apply styles to hovered stars
      hoverRating: function hoverRating(e) {
        var index = this.getIndex(e);
        this.paintStars(index, 'hovered');
        this.settings.onHover(index + 1, this._state.rating, this.$el);
      },
      // clicked on a rate, apply style and state
      handleRating: function handleRating(e) {
        var index = this.getIndex(e);
        var rating = index + 1;
        this.applyRating(rating, this.$el);
        this.executeCallback(rating, this.$el);

        if (this.settings.disableAfterRate) {
          this.$stars.off();
        }
      },
      applyRating: function applyRating(rating) {
        var index = rating - 1; // paint selected and remove hovered color

        this.paintStars(index, 'rated');
        this._state.rating = index + 1;
        this._state.rated = true;
      },
      restoreState: function restoreState(e) {
        var index = this.getIndex(e);
        var rating = this._state.rating || -1; // determine star color depending on manually rated

        var colorType = this._state.rated ? 'rated' : 'active';
        this.paintStars(rating - 1, colorType);
        this.settings.onLeave(index + 1, this._state.rating, this.$el);
      },
      getIndex: function getIndex(e) {
        var $target = $(e.currentTarget);
        var width = $target.width();
        var side = $(e.target).attr('data-side');
        var minRating = this.settings.minRating; // hovered outside the star, calculate by pixel instead

        side = !side ? this.getOffsetByPixel(e, $target, width) : side;
        side = this.settings.useFullStars ? 'right' : side; // get index for half or whole star

        var index = $target.index() - (side === 'left' ? 0.5 : 0); // pointer is way to the left, rating should be none

        index = index < 0.5 && e.offsetX < width / 4 ? -1 : index; // force minimum rating

        index = minRating && minRating <= this.settings.totalStars && index < minRating ? minRating - 1 : index;
        return index;
      },
      getOffsetByPixel: function getOffsetByPixel(e, $target, width) {
        var leftX = e.pageX - $target.offset().left;
        return leftX <= width / 2 && !this.settings.useFullStars ? 'left' : 'right';
      },
      initRating: function initRating() {
        this.paintStars(this._state.rating - 1, 'active');
      },
      paintStars: function paintStars(endIndex, stateClass) {
        var $polygonLeft;
        var $polygonRight;
        var leftClass;
        var rightClass;
        $.each(this.$stars, function (index, star) {
          $polygonLeft = $(star).find('[data-side="left"]');
          $polygonRight = $(star).find('[data-side="right"]');
          leftClass = rightClass = index <= endIndex ? stateClass : 'empty'; // has another half rating, add half star

          leftClass = index - endIndex === 0.5 ? stateClass : leftClass;
          $polygonLeft.attr('class', 'svg-' + leftClass + '-' + this._uid);
          $polygonRight.attr('class', 'svg-' + rightClass + '-' + this._uid);
        }.bind(this));
      },
      renderMarkup: function renderMarkup() {
        var s = this.settings;
        var baseUrl = s.baseUrl ? location.href.split('#')[0] : ''; // inject an svg manually to have control over attributes

        var star = '<div class="jq-star" style="width:' + s.starSize + 'px;  height:' + s.starSize + 'px;"><svg version="1.0" class="jq-star-svg" shape-rendering="geometricPrecision" xmlns="http://www.w3.org/2000/svg" ' + this.getSvgDimensions(s.starShape) + ' stroke-width:' + s.strokeWidth + 'px;" xml:space="preserve"><style type="text/css">.svg-empty-' + this._uid + '{fill:url(' + baseUrl + '#' + this._uid + '_SVGID_1_);}.svg-hovered-' + this._uid + '{fill:url(' + baseUrl + '#' + this._uid + '_SVGID_2_);}.svg-active-' + this._uid + '{fill:url(' + baseUrl + '#' + this._uid + '_SVGID_3_);}.svg-rated-' + this._uid + '{fill:' + s.ratedColor + ';}</style>' + this.getLinearGradient(this._uid + '_SVGID_1_', s.emptyColor, s.emptyColor, s.starShape) + this.getLinearGradient(this._uid + '_SVGID_2_', s.hoverColor, s.hoverColor, s.starShape) + this.getLinearGradient(this._uid + '_SVGID_3_', s.starGradient.start, s.starGradient.end, s.starShape) + this.getVectorPath(this._uid, {
          starShape: s.starShape,
          strokeWidth: s.strokeWidth,
          strokeColor: s.strokeColor
        }) + '</svg></div>'; // inject svg markup

        var starsMarkup = '';

        for (var i = 0; i < s.totalStars; i++) {
          starsMarkup += star;
        }

        this.$el.append(starsMarkup);
        this.$stars = this.$el.find('.jq-star');
      },
      getVectorPath: function getVectorPath(id, attrs) {
        return attrs.starShape === 'rounded' ? this.getRoundedVectorPath(id, attrs) : this.getSpikeVectorPath(id, attrs);
      },
      getSpikeVectorPath: function getSpikeVectorPath(id, attrs) {
        return '<polygon data-side="center" class="svg-empty-' + id + '" points="281.1,129.8 364,55.7 255.5,46.8 214,-59 172.5,46.8 64,55.4 146.8,129.7 121.1,241 212.9,181.1 213.9,181 306.5,241 " style="fill: transparent; stroke: ' + attrs.strokeColor + ';" />' + '<polygon data-side="left" class="svg-empty-' + id + '" points="281.1,129.8 364,55.7 255.5,46.8 214,-59 172.5,46.8 64,55.4 146.8,129.7 121.1,241 213.9,181.1 213.9,181 306.5,241 " style="stroke-opacity: 0;" />' + '<polygon data-side="right" class="svg-empty-' + id + '" points="364,55.7 255.5,46.8 214,-59 213.9,181 306.5,241 281.1,129.8 " style="stroke-opacity: 0;" />';
      },
      getRoundedVectorPath: function getRoundedVectorPath(id, attrs) {
        var fullPoints = 'M520.9,336.5c-3.8-11.8-14.2-20.5-26.5-22.2l-140.9-20.5l-63-127.7 c-5.5-11.2-16.8-18.2-29.3-18.2c-12.5,0-23.8,7-29.3,18.2l-63,127.7L28,314.2C15.7,316,5.4,324.7,1.6,336.5S1,361.3,9.9,370 l102,99.4l-24,140.3c-2.1,12.3,2.9,24.6,13,32c5.7,4.2,12.4,6.2,19.2,6.2c5.2,0,10.5-1.2,15.2-3.8l126-66.3l126,66.2 c4.8,2.6,10,3.8,15.2,3.8c6.8,0,13.5-2.1,19.2-6.2c10.1-7.3,15.1-19.7,13-32l-24-140.3l102-99.4 C521.6,361.3,524.8,348.3,520.9,336.5z';
        return '<path data-side="center" class="svg-empty-' + id + '" d="' + fullPoints + '" style="stroke: ' + attrs.strokeColor + '; fill: transparent; " /><path data-side="right" class="svg-empty-' + id + '" d="' + fullPoints + '" style="stroke-opacity: 0;" /><path data-side="left" class="svg-empty-' + id + '" d="M121,648c-7.3,0-14.1-2.2-19.8-6.4c-10.4-7.6-15.6-20.3-13.4-33l24-139.9l-101.6-99 c-9.1-8.9-12.4-22.4-8.6-34.5c3.9-12.1,14.6-21.1,27.2-23l140.4-20.4L232,164.6c5.7-11.6,17.3-18.8,30.2-16.8c0.6,0,1,0.4,1,1 v430.1c0,0.4-0.2,0.7-0.5,0.9l-126,66.3C132,646.6,126.6,648,121,648z" style="stroke: ' + attrs.strokeColor + '; stroke-opacity: 0;" />';
      },
      getSvgDimensions: function getSvgDimensions(starShape) {
        return starShape === 'rounded' ? 'width="550px" height="500.2px" viewBox="0 146.8 550 500.2" style="enable-background:new 0 0 550 500.2;' : 'x="0px" y="0px" width="305px" height="305px" viewBox="60 -62 309 309" style="enable-background:new 64 -59 305 305;';
      },
      getLinearGradient: function getLinearGradient(id, startColor, endColor, starShape) {
        var height = starShape === 'rounded' ? 500 : 250;
        return '<linearGradient id="' + id + '" gradientUnits="userSpaceOnUse" x1="0" y1="-50" x2="0" y2="' + height + '"><stop  offset="0" style="stop-color:' + startColor + '"/><stop  offset="1" style="stop-color:' + endColor + '"/> </linearGradient>';
      },
      executeCallback: function executeCallback(rating, $el) {
        var callback = this.settings.callback;
        callback(rating, $el);
      }
    };
    var publicMethods = {
      unload: function unload() {
        var _name = 'plugin_' + pluginName;

        var $el = $(this);
        var $starSet = $el.data(_name).$stars;
        $starSet.off();
        $el.removeData(_name).remove();
      },
      setRating: function setRating(rating, round) {
        var _name = 'plugin_' + pluginName;

        var $el = $(this);
        var $plugin = $el.data(_name);

        if (rating > $plugin.settings.totalStars || rating < 0) {
          return;
        }

        if (round) {
          rating = Math.round(rating);
        }

        $plugin.applyRating(rating);
      },
      getRating: function getRating() {
        var _name = 'plugin_' + pluginName;

        var $el = $(this);
        var $starSet = $el.data(_name);
        return $starSet._state.rating;
      },
      resize: function resize(newSize) {
        var _name = 'plugin_' + pluginName;

        var $el = $(this);
        var $starSet = $el.data(_name);
        var $stars = $starSet.$stars;

        if (newSize <= 1 || newSize > 200) {
          console.log('star size out of bounds');
          return;
        }

        $stars = Array.prototype.slice.call($stars);
        $stars.forEach(function (star) {
          $(star).css({
            'width': newSize + 'px',
            'height': newSize + 'px'
          });
        });
      },
      setReadOnly: function setReadOnly(flag) {
        var _name = 'plugin_' + pluginName;

        var $el = $(this);
        var $plugin = $el.data(_name);

        if (flag === true) {
          $plugin.$stars.off('mouseover mouseout click');
        } else {
          $plugin.settings.readOnly = false;
          $plugin.addListeners();
        }
      }
    }; // Avoid Plugin.prototype conflicts

    $.extend(Plugin.prototype, methods);

    $.fn[pluginName] = function (options) {
      // if options is a public method
      if (!$.isPlainObject(options)) {
        if (publicMethods.hasOwnProperty(options)) {
          return publicMethods[options].apply(this, Array.prototype.slice.call(arguments, 1));
        } else {
          $.error('Method ' + options + ' does not exist on ' + pluginName + '.js');
        }
      }

      return this.each(function () {
        // preventing against multiple instantiations
        if (!$.data(this, 'plugin_' + pluginName)) {
          $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
        }
      });
    };
  })(jQuery, window, document);

  $(".my-rating").starRating({
    initialRating: $("#potential_level").val() / 2,
    strokeColor: 'gold',
    strokeWidth: 10,
    starSize: 25,
    ratedColor: 'gold',
    callback: function callback(currentRating, $el) {
      var data = {
        potential_level: currentRating * 2
      };
      var url = "potential/" + $("#idCompany").val();
      $.post(url, data, function (data) {
        if (data.retour == true) {}
      });
    }
  });
  $(document).on('click', '.my-rating', function () {
    console.log($(this).starRating('getRating'));
  });
  $(".gestion_formulaire > .row > div").addClass("col-lg-8");
  $(".gestion_formulaire > .row > p").addClass("col-lg-4");
  $(".gestion-formulaire-checkbox-div > div").addClass("custom-control custom-checkbox"); //Permet de rendre dynamique la selection des checkbox dans le formulaire d'opérations

  $(".gestion-formulaire-checkbox-div").on("click", ":checkbox", function () {
    if ($(this).is(":checked")) {
      switch ($(this).val()) {
        case "2":
          $(this).parent().prev().children("input").prop("checked", true);
          break;

        case "3":
          $(this).parent().prev().children("input").prop("checked", true);
          $(this).parent().prev().prev().children("input").prop("checked", true);
          break;
      }
    }

    if (!$(this).is(":checked")) {
      switch ($(this).val()) {
        case "2":
          $(this).parent().next().children("input").prop("checked", false);
          break;

        case "1":
          $(this).parent().next().children("input").prop("checked", false);
          $(this).parent().next().next().children("input").prop("checked", false);
          break;
      }
    }
  }); // --------------------------------------------------------------
  // --------------------------------------------------------------
});

/***/ })

},[["./assets/js/app.js","runtime"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5jc3M/MzVjZSIsIndlYnBhY2s6Ly8vLi9hc3NldHMvaW1hZ2VzL2xvZ28ucG5nIiwid2VicGFjazovLy8uL2Fzc2V0cy9pbWFnZXMvcHJvZmlsLnN2ZyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9tYWluLmpzIl0sIm5hbWVzIjpbInJlcXVpcmUiLCIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsIm9uIiwidmFsdWUiLCJ2YWwiLCJ0b0xvd2VyQ2FzZSIsImZpbHRlciIsInRvZ2dsZSIsInRleHQiLCJpbmRleE9mIiwiY2xpY2siLCJVcmxMaW5rIiwiZmluZCIsImF0dHIiLCJsb2NhdGlvbiIsImlzIiwiZWFjaCIsInByb3AiLCJ0b29sdGlwIiwiZm4iLCJwYWdlTWUiLCJvcHRzIiwiJHRoaXMiLCJkZWZhdWx0cyIsInBlclBhZ2UiLCJzaG93UHJldk5leHQiLCJoaWRlUGFnZU51bWJlcnMiLCJzZXR0aW5ncyIsImV4dGVuZCIsImxpc3RFbGVtZW50IiwiY2hpbGRyZW4iLCJwYWdlciIsImNoaWxkU2VsZWN0b3IiLCJwYWdlclNlbGVjdG9yIiwibnVtSXRlbXMiLCJsZW5ndGgiLCJudW1QYWdlcyIsIk1hdGgiLCJjZWlsIiwiZGF0YSIsImFwcGVuZFRvIiwiY3VyciIsIm5iUGFnZSIsImFkZENsYXNzIiwicmVtb3ZlQ2xhc3MiLCJlcSIsImhpZGUiLCJzbGljZSIsInNob3ciLCJjbGlja2VkUGFnZSIsImh0bWwiLCJ2YWx1ZU9mIiwiZ29UbyIsInByZXZpb3VzIiwibmV4dCIsImdvVG9QYWdlIiwicGFyc2VJbnQiLCJwYWdlIiwic3RhcnRBdCIsImVuZE9uIiwiY3NzIiwicG9wb3ZlciIsInRyaWdnZXIiLCJ3aW5kb3ciLCJ1bmRlZmluZWQiLCJwbHVnaW5OYW1lIiwibm9vcCIsInRvdGFsU3RhcnMiLCJ1c2VGdWxsU3RhcnMiLCJzdGFyU2hhcGUiLCJlbXB0eUNvbG9yIiwiaG92ZXJDb2xvciIsImFjdGl2ZUNvbG9yIiwicmF0ZWRDb2xvciIsInVzZUdyYWRpZW50IiwicmVhZE9ubHkiLCJkaXNhYmxlQWZ0ZXJSYXRlIiwiYmFzZVVybCIsInN0YXJHcmFkaWVudCIsInN0YXJ0IiwiZW5kIiwic3Ryb2tlV2lkdGgiLCJzdHJva2VDb2xvciIsImluaXRpYWxSYXRpbmciLCJzdGFyU2l6ZSIsImNhbGxiYWNrIiwib25Ib3ZlciIsIm9uTGVhdmUiLCJQbHVnaW4iLCJlbGVtZW50Iiwib3B0aW9ucyIsIl9yYXRpbmciLCJuZXdSYXRpbmciLCJyb3VuZEZuIiwiJGVsIiwiZm9yY2VSb3VuZFVwIiwicm91bmQiLCJ0b0ZpeGVkIiwiX3N0YXRlIiwicmF0aW5nIiwiX3VpZCIsImZsb29yIiwicmFuZG9tIiwiX2RlZmF1bHRzIiwiX25hbWUiLCJpbml0IiwibWV0aG9kcyIsInJlbmRlck1hcmt1cCIsImFkZExpc3RlbmVycyIsImluaXRSYXRpbmciLCIkc3RhcnMiLCJob3ZlclJhdGluZyIsImJpbmQiLCJyZXN0b3JlU3RhdGUiLCJoYW5kbGVSYXRpbmciLCJlIiwiaW5kZXgiLCJnZXRJbmRleCIsInBhaW50U3RhcnMiLCJhcHBseVJhdGluZyIsImV4ZWN1dGVDYWxsYmFjayIsIm9mZiIsInJhdGVkIiwiY29sb3JUeXBlIiwiJHRhcmdldCIsImN1cnJlbnRUYXJnZXQiLCJ3aWR0aCIsInNpZGUiLCJ0YXJnZXQiLCJtaW5SYXRpbmciLCJnZXRPZmZzZXRCeVBpeGVsIiwib2Zmc2V0WCIsImxlZnRYIiwicGFnZVgiLCJvZmZzZXQiLCJsZWZ0IiwiZW5kSW5kZXgiLCJzdGF0ZUNsYXNzIiwiJHBvbHlnb25MZWZ0IiwiJHBvbHlnb25SaWdodCIsImxlZnRDbGFzcyIsInJpZ2h0Q2xhc3MiLCJzdGFyIiwicyIsImhyZWYiLCJzcGxpdCIsImdldFN2Z0RpbWVuc2lvbnMiLCJnZXRMaW5lYXJHcmFkaWVudCIsImdldFZlY3RvclBhdGgiLCJzdGFyc01hcmt1cCIsImkiLCJhcHBlbmQiLCJpZCIsImF0dHJzIiwiZ2V0Um91bmRlZFZlY3RvclBhdGgiLCJnZXRTcGlrZVZlY3RvclBhdGgiLCJmdWxsUG9pbnRzIiwic3RhcnRDb2xvciIsImVuZENvbG9yIiwiaGVpZ2h0IiwicHVibGljTWV0aG9kcyIsInVubG9hZCIsIiRzdGFyU2V0IiwicmVtb3ZlRGF0YSIsInJlbW92ZSIsInNldFJhdGluZyIsIiRwbHVnaW4iLCJnZXRSYXRpbmciLCJyZXNpemUiLCJuZXdTaXplIiwiY29uc29sZSIsImxvZyIsIkFycmF5IiwicHJvdG90eXBlIiwiY2FsbCIsImZvckVhY2giLCJzZXRSZWFkT25seSIsImZsYWciLCJpc1BsYWluT2JqZWN0IiwiaGFzT3duUHJvcGVydHkiLCJhcHBseSIsImFyZ3VtZW50cyIsImVycm9yIiwialF1ZXJ5Iiwic3RhclJhdGluZyIsImN1cnJlbnRSYXRpbmciLCJwb3RlbnRpYWxfbGV2ZWwiLCJ1cmwiLCJwb3N0IiwicmV0b3VyIiwicGFyZW50IiwicHJldiJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7O0FBQUEsdUM7Ozs7Ozs7Ozs7O0FDQUEsbUQ7Ozs7Ozs7Ozs7O0FDQUEscUQ7Ozs7Ozs7Ozs7O0FDQUE7Ozs7OztBQU9BO0FBQ0FBLG1CQUFPLENBQUMsNENBQUQsQ0FBUCxDLENBRUE7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7Ozs7O0FBSUFBLG1CQUFPLENBQUMsMENBQUQsQ0FBUDs7QUFHQUEsbUJBQU8sQ0FBQyxvREFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLHdEQUFELENBQVAsQzs7Ozs7Ozs7Ozs7QUMzQkFDLENBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlDLEtBQVosQ0FBbUIsWUFBWTtBQUM5QkYsR0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0JHLEVBQXBCLENBQXVCLE9BQXZCLEVBQWdDLFlBQVc7QUFFdkMsUUFBSUMsS0FBSyxHQUFHSixDQUFDLENBQUMsSUFBRCxDQUFELENBQVFLLEdBQVIsR0FBY0MsV0FBZCxFQUFaO0FBQ0FOLEtBQUMsQ0FBQyxpQkFBRCxDQUFELENBQXFCTyxNQUFyQixDQUE0QixZQUFXO0FBQ3JDUCxPQUFDLENBQUMsSUFBRCxDQUFELENBQVFRLE1BQVIsQ0FBZVIsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUyxJQUFSLEdBQWVILFdBQWYsR0FBNkJJLE9BQTdCLENBQXFDTixLQUFyQyxJQUE4QyxDQUFDLENBQTlEO0FBQ0QsS0FGRDtBQUdELEdBTkg7QUFRRzs7Ozs7Ozs7OztBQWFIOztBQUNBSixHQUFDLENBQUUsVUFBRixDQUFELENBQWdCVyxLQUFoQixDQUFzQixZQUFXO0FBQ2hDLFFBQUlDLE9BQU8sR0FBR1osQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRYSxJQUFSLENBQWEsR0FBYixFQUFrQkMsSUFBbEIsQ0FBdUIsTUFBdkIsQ0FBZDtBQUNBZCxLQUFDLENBQUNlLFFBQUQsQ0FBRCxDQUFZRCxJQUFaLENBQWlCLE1BQWpCLEVBQXlCRixPQUF6QjtBQUNBLEdBSEQ7QUFLQTs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBbUJBO0FBQ0E7QUFDQTs7QUFDQVosR0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JXLEtBQXRCLENBQTRCLFlBQVk7QUFDdkMsUUFBSVgsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JnQixFQUF0QixDQUF5QixVQUF6QixDQUFKLEVBQTBDO0FBQ3pDaEIsT0FBQyxDQUFDLDZCQUFELENBQUQsQ0FBaUNpQixJQUFqQyxDQUFzQyxZQUFZO0FBQ2pEakIsU0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRa0IsSUFBUixDQUFhLFNBQWIsRUFBd0IsSUFBeEI7QUFDQSxPQUZEO0FBSUEsS0FMRCxNQUtPO0FBQ05sQixPQUFDLENBQUMsNkJBQUQsQ0FBRCxDQUFpQ2lCLElBQWpDLENBQXNDLFlBQVk7QUFDakRqQixTQUFDLENBQUMsSUFBRCxDQUFELENBQVFrQixJQUFSLENBQWEsU0FBYixFQUF3QixLQUF4QjtBQUNBLE9BRkQ7QUFHQTtBQUNELEdBWEQ7QUFZQWxCLEdBQUMsQ0FBQyx1QkFBRCxDQUFELENBQTJCbUIsT0FBM0IsR0E5RDhCLENBK0Q5Qjs7QUFFQW5CLEdBQUMsQ0FBQ29CLEVBQUYsQ0FBS0MsTUFBTCxHQUFjLFVBQVNDLElBQVQsRUFBYztBQUMzQixRQUFJQyxLQUFLLEdBQUcsSUFBWjtBQUFBLFFBQ0NDLFFBQVEsR0FBRztBQUNWQyxhQUFPLEVBQUUsQ0FEQztBQUVWQyxrQkFBWSxFQUFFLEtBRko7QUFHVkMscUJBQWUsRUFBRTtBQUhQLEtBRFo7QUFBQSxRQU1DQyxRQUFRLEdBQUc1QixDQUFDLENBQUM2QixNQUFGLENBQVNMLFFBQVQsRUFBbUJGLElBQW5CLENBTlo7QUFRQSxRQUFJUSxXQUFXLEdBQUdQLEtBQWxCO0FBQ0EsUUFBSUUsT0FBTyxHQUFHRyxRQUFRLENBQUNILE9BQXZCO0FBQ0EsUUFBSU0sUUFBUSxHQUFHRCxXQUFXLENBQUNDLFFBQVosRUFBZjtBQUNBLFFBQUlDLEtBQUssR0FBR2hDLENBQUMsQ0FBQyxRQUFELENBQWI7O0FBRUEsUUFBSSxPQUFPNEIsUUFBUSxDQUFDSyxhQUFoQixJQUErQixXQUFuQyxFQUFnRDtBQUMvQ0YsY0FBUSxHQUFHRCxXQUFXLENBQUNqQixJQUFaLENBQWlCZSxRQUFRLENBQUNLLGFBQTFCLENBQVg7QUFDQTs7QUFFRCxRQUFJLE9BQU9MLFFBQVEsQ0FBQ00sYUFBaEIsSUFBK0IsV0FBbkMsRUFBZ0Q7QUFDL0NGLFdBQUssR0FBR2hDLENBQUMsQ0FBQzRCLFFBQVEsQ0FBQ00sYUFBVixDQUFUO0FBQ0E7O0FBRUQsUUFBSUMsUUFBUSxHQUFHSixRQUFRLENBQUNLLE1BQXhCO0FBQ0EsUUFBSUMsUUFBUSxHQUFHQyxJQUFJLENBQUNDLElBQUwsQ0FBVUosUUFBUSxHQUFDVixPQUFuQixDQUFmO0FBRUFPLFNBQUssQ0FBQ1EsSUFBTixDQUFXLE1BQVgsRUFBa0IsQ0FBbEI7O0FBRUEsUUFBSVosUUFBUSxDQUFDRixZQUFiLEVBQTBCO0FBQ3pCMUIsT0FBQyxDQUFDLDBHQUFELENBQUQsQ0FBOEd5QyxRQUE5RyxDQUF1SFQsS0FBdkg7QUFDQTs7QUFFRCxRQUFJVSxJQUFJLEdBQUcsQ0FBWDs7QUFDQSxXQUFNTCxRQUFRLEdBQUdLLElBQVgsSUFBb0JkLFFBQVEsQ0FBQ0QsZUFBVCxJQUEwQixLQUFwRCxFQUEyRDtBQUMxRDNCLE9BQUMsQ0FBQywwREFBd0QwQyxJQUFJLEdBQUMsQ0FBN0QsSUFBZ0UsV0FBakUsQ0FBRCxDQUErRUQsUUFBL0UsQ0FBd0ZULEtBQXhGO0FBQ0FVLFVBQUk7QUFDSjs7QUFFRCxRQUFJZCxRQUFRLENBQUNGLFlBQWIsRUFBMEI7QUFDekIxQixPQUFDLENBQUMsMkdBQUQsQ0FBRCxDQUErR3lDLFFBQS9HLENBQXdIVCxLQUF4SDtBQUNBOztBQUVELFFBQUlXLE1BQU0sR0FBRzNDLENBQUMsQ0FBQyxXQUFELENBQUQsQ0FBZW9DLE1BQWYsR0FBd0IsQ0FBckM7QUFFQUosU0FBSyxDQUFDbkIsSUFBTixDQUFXLGtCQUFYLEVBQStCK0IsUUFBL0IsQ0FBd0MsUUFBeEM7QUFDQTs7QUFDQVosU0FBSyxDQUFDbkIsSUFBTixDQUFXLFlBQVgsRUFBeUIrQixRQUF6QixDQUFrQyxvQkFBbEMsRUE3QzJCLENBOEMzQjs7QUFDQSxRQUFJUCxRQUFRLElBQUUsQ0FBZCxFQUFpQjtBQUNoQjtBQUNBTCxXQUFLLENBQUNuQixJQUFOLENBQVcsWUFBWCxFQUF5QitCLFFBQXpCLENBQWtDLG9CQUFsQztBQUNBWixXQUFLLENBQUNuQixJQUFOLENBQVcsWUFBWCxFQUF5QmdDLFdBQXpCLENBQXFDLFdBQXJDO0FBQ0E7O0FBRUQsUUFBSUYsTUFBTSxLQUFLLENBQWYsRUFBa0I7QUFDakIzQyxPQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QjRDLFFBQTdCLENBQXNDLGdDQUF0QztBQUNBNUMsT0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkI2QyxXQUE3QixDQUF5QyxnQ0FBekM7QUFDQTdDLE9BQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCNkMsV0FBN0IsQ0FBeUMsZ0NBQXpDO0FBQ0E3QyxPQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QjZDLFdBQTdCLENBQXlDLGdDQUF6QztBQUNBLEtBTEQsTUFNSyxJQUFJRixNQUFNLEtBQUssQ0FBZixFQUFrQjtBQUN0QjNDLE9BQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCNEMsUUFBN0IsQ0FBc0MsZ0NBQXRDO0FBQ0E1QyxPQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QjZDLFdBQTdCLENBQXlDLGdDQUF6QztBQUNBN0MsT0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkI2QyxXQUE3QixDQUF5QyxnQ0FBekM7QUFDQTdDLE9BQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCNkMsV0FBN0IsQ0FBeUMsZ0NBQXpDO0FBQ0EsS0FMSSxNQU1BLElBQUlGLE1BQU0sS0FBSyxDQUFmLEVBQWtCO0FBQ3RCM0MsT0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkI0QyxRQUE3QixDQUFzQyxnQ0FBdEM7QUFDQTVDLE9BQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCNkMsV0FBN0IsQ0FBeUMsZ0NBQXpDO0FBQ0E3QyxPQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QjZDLFdBQTdCLENBQXlDLGdDQUF6QztBQUNBN0MsT0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkI2QyxXQUE3QixDQUF5QyxnQ0FBekM7QUFDQSxLQUxJLE1BTUEsSUFBSUYsTUFBTSxLQUFLLENBQWYsRUFBa0I7QUFDdEIzQyxPQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QjRDLFFBQTdCLENBQXNDLGdDQUF0QztBQUNBNUMsT0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkI2QyxXQUE3QixDQUF5QyxnQ0FBekM7QUFDQTdDLE9BQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCNkMsV0FBN0IsQ0FBeUMsZ0NBQXpDO0FBQ0E3QyxPQUFDLENBQUMseUJBQUQsQ0FBRCxDQUE2QjZDLFdBQTdCLENBQXlDLGdDQUF6QztBQUNBOztBQUVEYixTQUFLLENBQUNELFFBQU4sR0FBaUJlLEVBQWpCLENBQW9CLENBQXBCLEVBQXVCRixRQUF2QixDQUFnQyxRQUFoQztBQUVBYixZQUFRLENBQUNnQixJQUFUO0FBQ0FoQixZQUFRLENBQUNpQixLQUFULENBQWUsQ0FBZixFQUFrQnZCLE9BQWxCLEVBQTJCd0IsSUFBM0I7QUFFQWpCLFNBQUssQ0FBQ25CLElBQU4sQ0FBVyxlQUFYLEVBQTRCRixLQUE1QixDQUFrQyxZQUFVO0FBQzNDLFVBQUl1QyxXQUFXLEdBQUdsRCxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFtRCxJQUFSLEdBQWVDLE9BQWYsS0FBeUIsQ0FBM0M7QUFDQUMsVUFBSSxDQUFDSCxXQUFELEVBQWF6QixPQUFiLENBQUo7QUFDQSxhQUFPLEtBQVA7QUFDQSxLQUpEO0FBS0FPLFNBQUssQ0FBQ25CLElBQU4sQ0FBVyxlQUFYLEVBQTRCRixLQUE1QixDQUFrQyxZQUFVO0FBQzNDMkMsY0FBUTtBQUNSLGFBQU8sS0FBUDtBQUNBLEtBSEQ7QUFJQXRCLFNBQUssQ0FBQ25CLElBQU4sQ0FBVyxlQUFYLEVBQTRCRixLQUE1QixDQUFrQyxZQUFVO0FBQzNDNEMsVUFBSTtBQUNKLGFBQU8sS0FBUDtBQUNBLEtBSEQ7O0FBS0EsYUFBU0QsUUFBVCxHQUFtQjtBQUNsQixVQUFJRSxRQUFRLEdBQUdDLFFBQVEsQ0FBQ3pCLEtBQUssQ0FBQ1EsSUFBTixDQUFXLE1BQVgsQ0FBRCxDQUFSLEdBQStCLENBQTlDO0FBQ0FhLFVBQUksQ0FBQ0csUUFBRCxDQUFKO0FBQ0E7O0FBRUQsYUFBU0QsSUFBVCxHQUFlO0FBQ2RDLGNBQVEsR0FBR0MsUUFBUSxDQUFDekIsS0FBSyxDQUFDUSxJQUFOLENBQVcsTUFBWCxDQUFELENBQVIsR0FBK0IsQ0FBMUM7QUFDQWEsVUFBSSxDQUFDRyxRQUFELENBQUo7QUFDQTs7QUFFRCxhQUFTSCxJQUFULENBQWNLLElBQWQsRUFBbUI7QUFDbEIsVUFBSUMsT0FBTyxHQUFHRCxJQUFJLEdBQUdqQyxPQUFyQjtBQUFBLFVBQ0NtQyxLQUFLLEdBQUdELE9BQU8sR0FBR2xDLE9BRG5CO0FBR0FNLGNBQVEsQ0FBQzhCLEdBQVQsQ0FBYSxTQUFiLEVBQXVCLE1BQXZCLEVBQStCYixLQUEvQixDQUFxQ1csT0FBckMsRUFBOENDLEtBQTlDLEVBQXFEWCxJQUFyRDs7QUFFQSxVQUFJUyxJQUFJLElBQUUsQ0FBVixFQUFhO0FBQ1o7QUFDQTFCLGFBQUssQ0FBQ25CLElBQU4sQ0FBVyxxQkFBWCxFQUFrQytCLFFBQWxDLENBQTJDLFdBQTNDO0FBQ0FaLGFBQUssQ0FBQ25CLElBQU4sQ0FBVyxxQkFBWCxFQUFrQ2dDLFdBQWxDLENBQThDLG9CQUE5QztBQUNBLE9BSkQsTUFLSztBQUNKO0FBQ0FiLGFBQUssQ0FBQ25CLElBQU4sQ0FBVyxZQUFYLEVBQXlCK0IsUUFBekIsQ0FBa0Msb0JBQWxDO0FBQ0FaLGFBQUssQ0FBQ25CLElBQU4sQ0FBVyxZQUFYLEVBQXlCZ0MsV0FBekIsQ0FBcUMsV0FBckM7QUFDQTs7QUFFRCxVQUFJYSxJQUFJLEdBQUVyQixRQUFRLEdBQUMsQ0FBbkIsRUFBdUI7QUFDdEI7QUFDQUwsYUFBSyxDQUFDbkIsSUFBTixDQUFXLHFCQUFYLEVBQWtDK0IsUUFBbEMsQ0FBMkMsV0FBM0M7QUFDQVosYUFBSyxDQUFDbkIsSUFBTixDQUFXLHFCQUFYLEVBQWtDZ0MsV0FBbEMsQ0FBOEMsb0JBQTlDO0FBQ0EsT0FKRCxNQUtLO0FBQ0o7QUFDQWIsYUFBSyxDQUFDbkIsSUFBTixDQUFXLFlBQVgsRUFBeUIrQixRQUF6QixDQUFrQyxvQkFBbEM7QUFDQVosYUFBSyxDQUFDbkIsSUFBTixDQUFXLFlBQVgsRUFBeUJnQyxXQUF6QixDQUFxQyxXQUFyQztBQUNBOztBQUVEYixXQUFLLENBQUNRLElBQU4sQ0FBVyxNQUFYLEVBQWtCa0IsSUFBbEI7QUFDQTFCLFdBQUssQ0FBQ0QsUUFBTixHQUFpQmMsV0FBakIsQ0FBNkIsUUFBN0I7QUFDQWIsV0FBSyxDQUFDRCxRQUFOLEdBQWlCZSxFQUFqQixDQUFvQlksSUFBSSxHQUFDLENBQXpCLEVBQTRCZCxRQUE1QixDQUFxQyxRQUFyQztBQUNBO0FBQ0QsR0EzSUQ7QUE0SUE7Ozs7Ozs7QUFNQTs7Ozs7O0FBS0E1QyxHQUFDLENBQUMsY0FBRCxDQUFELENBQWtCcUIsTUFBbEIsQ0FBeUI7QUFBQ2EsaUJBQWEsRUFBQyxVQUFmO0FBQTBCUixnQkFBWSxFQUFDLElBQXZDO0FBQTRDQyxtQkFBZSxFQUFDLEtBQTVEO0FBQWtFRixXQUFPLEVBQUM7QUFBMUUsR0FBekI7QUFDQXpCLEdBQUMsQ0FBQyxZQUFZO0FBRWJBLEtBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCOEQsT0FBN0IsQ0FBcUM7QUFBQ1gsVUFBSSxFQUFDLElBQU47QUFBV1ksYUFBTyxFQUFFO0FBQXBCLEtBQXJDO0FBQ0EsR0FIQSxDQUFELENBS0E7QUFDQTs7QUFFQTs7Ozs7Ozs7QUFSQTs7QUFpQkMsR0FBQyxVQUFXL0QsQ0FBWCxFQUFjZ0UsTUFBZCxFQUFzQi9ELFFBQXRCLEVBQWdDZ0UsU0FBaEMsRUFBNEM7QUFFN0MsaUJBRjZDLENBSTdDOztBQUNBLFFBQUlDLFVBQVUsR0FBRyxZQUFqQjs7QUFDQSxRQUFJQyxJQUFJLEdBQUcsU0FBUEEsSUFBTyxHQUFVLENBQUUsQ0FBdkI7O0FBQ0EsUUFBSTNDLFFBQVEsR0FBRztBQUNkNEMsZ0JBQVUsRUFBRSxDQURFO0FBRWRDLGtCQUFZLEVBQUUsS0FGQTtBQUdkQyxlQUFTLEVBQUUsVUFIRztBQUlkQyxnQkFBVSxFQUFFLFdBSkU7QUFLZEMsZ0JBQVUsRUFBRSxRQUxFO0FBTWRDLGlCQUFXLEVBQUUsTUFOQztBQU9kQyxnQkFBVSxFQUFFLFNBUEU7QUFRZEMsaUJBQVcsRUFBRSxJQVJDO0FBU2RDLGNBQVEsRUFBRSxLQVRJO0FBVWRDLHNCQUFnQixFQUFFLEtBVko7QUFXZEMsYUFBTyxFQUFFLEtBWEs7QUFZZEMsa0JBQVksRUFBRTtBQUNiQyxhQUFLLEVBQUUsU0FETTtBQUViQyxXQUFHLEVBQUU7QUFGUSxPQVpBO0FBZ0JkQyxpQkFBVyxFQUFFLENBaEJDO0FBaUJkQyxpQkFBVyxFQUFFLE9BakJDO0FBa0JkQyxtQkFBYSxFQUFFLENBbEJEO0FBbUJkQyxjQUFRLEVBQUUsRUFuQkk7QUFvQmRDLGNBQVEsRUFBRW5CLElBcEJJO0FBcUJkb0IsYUFBTyxFQUFFcEIsSUFyQks7QUFzQmRxQixhQUFPLEVBQUVyQjtBQXRCSyxLQUFmLENBUDZDLENBZ0M3Qzs7QUFDQSxRQUFJc0IsTUFBTSxHQUFHLFNBQVRBLE1BQVMsQ0FBVUMsT0FBVixFQUFtQkMsT0FBbkIsRUFBNkI7QUFDekMsVUFBSUMsT0FBSjs7QUFDQSxVQUFJQyxTQUFKO0FBQ0EsVUFBSUMsT0FBSjtBQUVBLFdBQUtKLE9BQUwsR0FBZUEsT0FBZjtBQUNBLFdBQUtLLEdBQUwsR0FBVy9GLENBQUMsQ0FBQzBGLE9BQUQsQ0FBWjtBQUNBLFdBQUs5RCxRQUFMLEdBQWdCNUIsQ0FBQyxDQUFDNkIsTUFBRixDQUFVLEVBQVYsRUFBY0wsUUFBZCxFQUF3Qm1FLE9BQXhCLENBQWhCLENBUHlDLENBU3pDOztBQUNBQyxhQUFPLEdBQUcsS0FBS0csR0FBTCxDQUFTdkQsSUFBVCxDQUFjLFFBQWQsS0FBMkIsS0FBS1osUUFBTCxDQUFjd0QsYUFBbkQsQ0FWeUMsQ0FZekM7O0FBQ0FVLGFBQU8sR0FBRyxLQUFLbEUsUUFBTCxDQUFjb0UsWUFBZCxHQUE2QjFELElBQUksQ0FBQ0MsSUFBbEMsR0FBeUNELElBQUksQ0FBQzJELEtBQXhEO0FBQ0FKLGVBQVMsR0FBRyxDQUFDQyxPQUFPLENBQUVGLE9BQU8sR0FBRyxDQUFaLENBQVAsR0FBeUIsQ0FBMUIsRUFBNkJNLE9BQTdCLENBQXFDLENBQXJDLENBQVo7QUFDQSxXQUFLQyxNQUFMLEdBQWM7QUFDYkMsY0FBTSxFQUFFUDtBQURLLE9BQWQsQ0FmeUMsQ0FtQnpDOztBQUNBLFdBQUtRLElBQUwsR0FBWS9ELElBQUksQ0FBQ2dFLEtBQUwsQ0FBWWhFLElBQUksQ0FBQ2lFLE1BQUwsS0FBZ0IsR0FBNUIsQ0FBWixDQXBCeUMsQ0FzQnpDOztBQUNBLFVBQUksQ0FBQ1osT0FBTyxDQUFDWixZQUFULElBQXlCLENBQUMsS0FBS25ELFFBQUwsQ0FBYytDLFdBQTVDLEVBQXlEO0FBQ3hELGFBQUsvQyxRQUFMLENBQWNtRCxZQUFkLENBQTJCQyxLQUEzQixHQUFtQyxLQUFLcEQsUUFBTCxDQUFjbUQsWUFBZCxDQUEyQkUsR0FBM0IsR0FBaUMsS0FBS3JELFFBQUwsQ0FBYzZDLFdBQWxGO0FBQ0E7O0FBRUQsV0FBSytCLFNBQUwsR0FBaUJoRixRQUFqQjtBQUNBLFdBQUtpRixLQUFMLEdBQWF2QyxVQUFiO0FBQ0EsV0FBS3dDLElBQUw7QUFDQSxLQTlCRDs7QUFnQ0EsUUFBSUMsT0FBTyxHQUFHO0FBQ2JELFVBQUksRUFBRSxnQkFBWTtBQUNqQixhQUFLRSxZQUFMO0FBQ0EsYUFBS0MsWUFBTDtBQUNBLGFBQUtDLFVBQUw7QUFDQSxPQUxZO0FBT2JELGtCQUFZLEVBQUUsd0JBQVU7QUFDdkIsWUFBSSxLQUFLakYsUUFBTCxDQUFjZ0QsUUFBbEIsRUFBNEI7QUFBRTtBQUFTOztBQUN2QyxhQUFLbUMsTUFBTCxDQUFZNUcsRUFBWixDQUFlLFdBQWYsRUFBNEIsS0FBSzZHLFdBQUwsQ0FBaUJDLElBQWpCLENBQXNCLElBQXRCLENBQTVCO0FBQ0EsYUFBS0YsTUFBTCxDQUFZNUcsRUFBWixDQUFlLFVBQWYsRUFBMkIsS0FBSytHLFlBQUwsQ0FBa0JELElBQWxCLENBQXVCLElBQXZCLENBQTNCO0FBQ0EsYUFBS0YsTUFBTCxDQUFZNUcsRUFBWixDQUFlLE9BQWYsRUFBd0IsS0FBS2dILFlBQUwsQ0FBa0JGLElBQWxCLENBQXVCLElBQXZCLENBQXhCO0FBQ0EsT0FaWTtBQWNiO0FBQ0FELGlCQUFXLEVBQUUscUJBQVNJLENBQVQsRUFBVztBQUN2QixZQUFJQyxLQUFLLEdBQUcsS0FBS0MsUUFBTCxDQUFjRixDQUFkLENBQVo7QUFDQSxhQUFLRyxVQUFMLENBQWdCRixLQUFoQixFQUF1QixTQUF2QjtBQUNBLGFBQUt6RixRQUFMLENBQWMyRCxPQUFkLENBQXNCOEIsS0FBSyxHQUFHLENBQTlCLEVBQWlDLEtBQUtsQixNQUFMLENBQVlDLE1BQTdDLEVBQXFELEtBQUtMLEdBQTFEO0FBQ0EsT0FuQlk7QUFxQmI7QUFDQW9CLGtCQUFZLEVBQUUsc0JBQVNDLENBQVQsRUFBVztBQUN4QixZQUFJQyxLQUFLLEdBQUcsS0FBS0MsUUFBTCxDQUFjRixDQUFkLENBQVo7QUFDQSxZQUFJaEIsTUFBTSxHQUFHaUIsS0FBSyxHQUFHLENBQXJCO0FBRUEsYUFBS0csV0FBTCxDQUFpQnBCLE1BQWpCLEVBQXlCLEtBQUtMLEdBQTlCO0FBQ0EsYUFBSzBCLGVBQUwsQ0FBc0JyQixNQUF0QixFQUE4QixLQUFLTCxHQUFuQzs7QUFFQSxZQUFHLEtBQUtuRSxRQUFMLENBQWNpRCxnQkFBakIsRUFBa0M7QUFDakMsZUFBS2tDLE1BQUwsQ0FBWVcsR0FBWjtBQUNBO0FBQ0QsT0FoQ1k7QUFrQ2JGLGlCQUFXLEVBQUUscUJBQVNwQixNQUFULEVBQWdCO0FBQzVCLFlBQUlpQixLQUFLLEdBQUdqQixNQUFNLEdBQUcsQ0FBckIsQ0FENEIsQ0FFNUI7O0FBQ0EsYUFBS21CLFVBQUwsQ0FBZ0JGLEtBQWhCLEVBQXVCLE9BQXZCO0FBQ0EsYUFBS2xCLE1BQUwsQ0FBWUMsTUFBWixHQUFxQmlCLEtBQUssR0FBRyxDQUE3QjtBQUNBLGFBQUtsQixNQUFMLENBQVl3QixLQUFaLEdBQW9CLElBQXBCO0FBQ0EsT0F4Q1k7QUEwQ2JULGtCQUFZLEVBQUUsc0JBQVNFLENBQVQsRUFBVztBQUN4QixZQUFJQyxLQUFLLEdBQUcsS0FBS0MsUUFBTCxDQUFjRixDQUFkLENBQVo7QUFDQSxZQUFJaEIsTUFBTSxHQUFHLEtBQUtELE1BQUwsQ0FBWUMsTUFBWixJQUFzQixDQUFDLENBQXBDLENBRndCLENBR3hCOztBQUNBLFlBQUl3QixTQUFTLEdBQUcsS0FBS3pCLE1BQUwsQ0FBWXdCLEtBQVosR0FBb0IsT0FBcEIsR0FBOEIsUUFBOUM7QUFDQSxhQUFLSixVQUFMLENBQWdCbkIsTUFBTSxHQUFHLENBQXpCLEVBQTRCd0IsU0FBNUI7QUFDQSxhQUFLaEcsUUFBTCxDQUFjNEQsT0FBZCxDQUFzQjZCLEtBQUssR0FBRyxDQUE5QixFQUFpQyxLQUFLbEIsTUFBTCxDQUFZQyxNQUE3QyxFQUFxRCxLQUFLTCxHQUExRDtBQUNBLE9BakRZO0FBbURidUIsY0FBUSxFQUFFLGtCQUFTRixDQUFULEVBQVc7QUFDcEIsWUFBSVMsT0FBTyxHQUFHN0gsQ0FBQyxDQUFDb0gsQ0FBQyxDQUFDVSxhQUFILENBQWY7QUFDQSxZQUFJQyxLQUFLLEdBQUdGLE9BQU8sQ0FBQ0UsS0FBUixFQUFaO0FBQ0EsWUFBSUMsSUFBSSxHQUFHaEksQ0FBQyxDQUFDb0gsQ0FBQyxDQUFDYSxNQUFILENBQUQsQ0FBWW5ILElBQVosQ0FBaUIsV0FBakIsQ0FBWDtBQUNBLFlBQUlvSCxTQUFTLEdBQUcsS0FBS3RHLFFBQUwsQ0FBY3NHLFNBQTlCLENBSm9CLENBTXBCOztBQUNBRixZQUFJLEdBQUksQ0FBQ0EsSUFBRixHQUFVLEtBQUtHLGdCQUFMLENBQXNCZixDQUF0QixFQUF5QlMsT0FBekIsRUFBa0NFLEtBQWxDLENBQVYsR0FBcURDLElBQTVEO0FBQ0FBLFlBQUksR0FBSSxLQUFLcEcsUUFBTCxDQUFjeUMsWUFBZixHQUErQixPQUEvQixHQUF5QzJELElBQWhELENBUm9CLENBVXBCOztBQUNBLFlBQUlYLEtBQUssR0FBR1EsT0FBTyxDQUFDUixLQUFSLE1BQW9CVyxJQUFJLEtBQUssTUFBVixHQUFvQixHQUFwQixHQUEwQixDQUE3QyxDQUFaLENBWG9CLENBYXBCOztBQUNBWCxhQUFLLEdBQUtBLEtBQUssR0FBRyxHQUFSLElBQWdCRCxDQUFDLENBQUNnQixPQUFGLEdBQVlMLEtBQUssR0FBRyxDQUF0QyxHQUE2QyxDQUFDLENBQTlDLEdBQWtEVixLQUExRCxDQWRvQixDQWdCcEI7O0FBQ0FBLGFBQUssR0FBS2EsU0FBUyxJQUFJQSxTQUFTLElBQUksS0FBS3RHLFFBQUwsQ0FBY3dDLFVBQXhDLElBQXNEaUQsS0FBSyxHQUFHYSxTQUFoRSxHQUE4RUEsU0FBUyxHQUFHLENBQTFGLEdBQThGYixLQUF0RztBQUNBLGVBQU9BLEtBQVA7QUFDQSxPQXRFWTtBQXdFYmMsc0JBQWdCLEVBQUUsMEJBQVNmLENBQVQsRUFBWVMsT0FBWixFQUFxQkUsS0FBckIsRUFBMkI7QUFDNUMsWUFBSU0sS0FBSyxHQUFHakIsQ0FBQyxDQUFDa0IsS0FBRixHQUFVVCxPQUFPLENBQUNVLE1BQVIsR0FBaUJDLElBQXZDO0FBQ0EsZUFBU0gsS0FBSyxJQUFLTixLQUFLLEdBQUcsQ0FBbEIsSUFBd0IsQ0FBQyxLQUFLbkcsUUFBTCxDQUFjeUMsWUFBekMsR0FBeUQsTUFBekQsR0FBa0UsT0FBekU7QUFDQSxPQTNFWTtBQTZFYnlDLGdCQUFVLEVBQUUsc0JBQVU7QUFDckIsYUFBS1MsVUFBTCxDQUFnQixLQUFLcEIsTUFBTCxDQUFZQyxNQUFaLEdBQXFCLENBQXJDLEVBQXdDLFFBQXhDO0FBQ0EsT0EvRVk7QUFpRmJtQixnQkFBVSxFQUFFLG9CQUFTa0IsUUFBVCxFQUFtQkMsVUFBbkIsRUFBOEI7QUFDekMsWUFBSUMsWUFBSjtBQUNBLFlBQUlDLGFBQUo7QUFDQSxZQUFJQyxTQUFKO0FBQ0EsWUFBSUMsVUFBSjtBQUVBOUksU0FBQyxDQUFDaUIsSUFBRixDQUFPLEtBQUs4RixNQUFaLEVBQW9CLFVBQVNNLEtBQVQsRUFBZ0IwQixJQUFoQixFQUFxQjtBQUN4Q0osc0JBQVksR0FBRzNJLENBQUMsQ0FBQytJLElBQUQsQ0FBRCxDQUFRbEksSUFBUixDQUFhLG9CQUFiLENBQWY7QUFDQStILHVCQUFhLEdBQUc1SSxDQUFDLENBQUMrSSxJQUFELENBQUQsQ0FBUWxJLElBQVIsQ0FBYSxxQkFBYixDQUFoQjtBQUNBZ0ksbUJBQVMsR0FBR0MsVUFBVSxHQUFJekIsS0FBSyxJQUFJb0IsUUFBVixHQUFzQkMsVUFBdEIsR0FBbUMsT0FBNUQsQ0FId0MsQ0FLeEM7O0FBQ0FHLG1CQUFTLEdBQUt4QixLQUFLLEdBQUdvQixRQUFSLEtBQXFCLEdBQXZCLEdBQStCQyxVQUEvQixHQUE0Q0csU0FBeEQ7QUFFQUYsc0JBQVksQ0FBQzdILElBQWIsQ0FBa0IsT0FBbEIsRUFBMkIsU0FBVStILFNBQVYsR0FBc0IsR0FBdEIsR0FBNEIsS0FBS3hDLElBQTVEO0FBQ0F1Qyx1QkFBYSxDQUFDOUgsSUFBZCxDQUFtQixPQUFuQixFQUE0QixTQUFVZ0ksVUFBVixHQUF1QixHQUF2QixHQUE2QixLQUFLekMsSUFBOUQ7QUFFQSxTQVhtQixDQVdsQlksSUFYa0IsQ0FXYixJQVhhLENBQXBCO0FBWUEsT0FuR1k7QUFxR2JMLGtCQUFZLEVBQUUsd0JBQVk7QUFDekIsWUFBSW9DLENBQUMsR0FBRyxLQUFLcEgsUUFBYjtBQUNBLFlBQUlrRCxPQUFPLEdBQUdrRSxDQUFDLENBQUNsRSxPQUFGLEdBQVkvRCxRQUFRLENBQUNrSSxJQUFULENBQWNDLEtBQWQsQ0FBb0IsR0FBcEIsRUFBeUIsQ0FBekIsQ0FBWixHQUEwQyxFQUF4RCxDQUZ5QixDQUl6Qjs7QUFDQSxZQUFJSCxJQUFJLEdBQUcsdUNBQXVDQyxDQUFDLENBQUMzRCxRQUF6QyxHQUFtRCxjQUFuRCxHQUFvRTJELENBQUMsQ0FBQzNELFFBQXRFLEdBQWlGLHNIQUFqRixHQUEwTSxLQUFLOEQsZ0JBQUwsQ0FBc0JILENBQUMsQ0FBQzFFLFNBQXhCLENBQTFNLEdBQWdQLGdCQUFoUCxHQUFtUTBFLENBQUMsQ0FBQzlELFdBQXJRLEdBQW1SLDhEQUFuUixHQUFvVixLQUFLbUIsSUFBelYsR0FBZ1csWUFBaFcsR0FBK1d2QixPQUEvVyxHQUF5WCxHQUF6WCxHQUErWCxLQUFLdUIsSUFBcFksR0FBMlksMkJBQTNZLEdBQXlhLEtBQUtBLElBQTlhLEdBQXFiLFlBQXJiLEdBQW9jdkIsT0FBcGMsR0FBOGMsR0FBOWMsR0FBb2QsS0FBS3VCLElBQXpkLEdBQWdlLDBCQUFoZSxHQUE2ZixLQUFLQSxJQUFsZ0IsR0FBeWdCLFlBQXpnQixHQUF3aEJ2QixPQUF4aEIsR0FBa2lCLEdBQWxpQixHQUF3aUIsS0FBS3VCLElBQTdpQixHQUFvakIseUJBQXBqQixHQUFnbEIsS0FBS0EsSUFBcmxCLEdBQTRsQixRQUE1bEIsR0FBdW1CMkMsQ0FBQyxDQUFDdEUsVUFBem1CLEdBQXNuQixZQUF0bkIsR0FFVixLQUFLMEUsaUJBQUwsQ0FBdUIsS0FBSy9DLElBQUwsR0FBWSxXQUFuQyxFQUFnRDJDLENBQUMsQ0FBQ3pFLFVBQWxELEVBQThEeUUsQ0FBQyxDQUFDekUsVUFBaEUsRUFBNEV5RSxDQUFDLENBQUMxRSxTQUE5RSxDQUZVLEdBR1YsS0FBSzhFLGlCQUFMLENBQXVCLEtBQUsvQyxJQUFMLEdBQVksV0FBbkMsRUFBZ0QyQyxDQUFDLENBQUN4RSxVQUFsRCxFQUE4RHdFLENBQUMsQ0FBQ3hFLFVBQWhFLEVBQTRFd0UsQ0FBQyxDQUFDMUUsU0FBOUUsQ0FIVSxHQUlWLEtBQUs4RSxpQkFBTCxDQUF1QixLQUFLL0MsSUFBTCxHQUFZLFdBQW5DLEVBQWdEMkMsQ0FBQyxDQUFDakUsWUFBRixDQUFlQyxLQUEvRCxFQUFzRWdFLENBQUMsQ0FBQ2pFLFlBQUYsQ0FBZUUsR0FBckYsRUFBMEYrRCxDQUFDLENBQUMxRSxTQUE1RixDQUpVLEdBS1YsS0FBSytFLGFBQUwsQ0FBbUIsS0FBS2hELElBQXhCLEVBQThCO0FBQzdCL0IsbUJBQVMsRUFBRTBFLENBQUMsQ0FBQzFFLFNBRGdCO0FBRTdCWSxxQkFBVyxFQUFFOEQsQ0FBQyxDQUFDOUQsV0FGYztBQUc3QkMscUJBQVcsRUFBRTZELENBQUMsQ0FBQzdEO0FBSGMsU0FBOUIsQ0FMVSxHQVVWLGNBVkQsQ0FMeUIsQ0FpQnpCOztBQUNBLFlBQUltRSxXQUFXLEdBQUcsRUFBbEI7O0FBQ0EsYUFBSyxJQUFJQyxDQUFDLEdBQUcsQ0FBYixFQUFnQkEsQ0FBQyxHQUFHUCxDQUFDLENBQUM1RSxVQUF0QixFQUFrQ21GLENBQUMsRUFBbkMsRUFBc0M7QUFDckNELHFCQUFXLElBQUlQLElBQWY7QUFDQTs7QUFDRCxhQUFLaEQsR0FBTCxDQUFTeUQsTUFBVCxDQUFnQkYsV0FBaEI7QUFDQSxhQUFLdkMsTUFBTCxHQUFjLEtBQUtoQixHQUFMLENBQVNsRixJQUFULENBQWMsVUFBZCxDQUFkO0FBQ0EsT0E3SFk7QUErSGJ3SSxtQkFBYSxFQUFFLHVCQUFTSSxFQUFULEVBQWFDLEtBQWIsRUFBbUI7QUFDakMsZUFBUUEsS0FBSyxDQUFDcEYsU0FBTixLQUFvQixTQUFyQixHQUNOLEtBQUtxRixvQkFBTCxDQUEwQkYsRUFBMUIsRUFBOEJDLEtBQTlCLENBRE0sR0FDaUMsS0FBS0Usa0JBQUwsQ0FBd0JILEVBQXhCLEVBQTRCQyxLQUE1QixDQUR4QztBQUVBLE9BbElZO0FBb0liRSx3QkFBa0IsRUFBRSw0QkFBU0gsRUFBVCxFQUFhQyxLQUFiLEVBQW1CO0FBQ3RDLGVBQU8sa0RBQWtERCxFQUFsRCxHQUF1RCxpS0FBdkQsR0FBMk5DLEtBQUssQ0FBQ3ZFLFdBQWpPLEdBQStPLE9BQS9PLEdBQ04sNkNBRE0sR0FDMENzRSxFQUQxQyxHQUMrQyw0SkFEL0MsR0FFTiw4Q0FGTSxHQUUyQ0EsRUFGM0MsR0FFZ0QsdUdBRnZEO0FBR0EsT0F4SVk7QUEwSWJFLDBCQUFvQixFQUFFLDhCQUFTRixFQUFULEVBQWFDLEtBQWIsRUFBbUI7QUFDeEMsWUFBSUcsVUFBVSxHQUFHLDhhQUFqQjtBQUVBLGVBQU8sK0NBQStDSixFQUEvQyxHQUFvRCxPQUFwRCxHQUE4REksVUFBOUQsR0FBMkUsbUJBQTNFLEdBQWlHSCxLQUFLLENBQUN2RSxXQUF2RyxHQUFxSCxvRUFBckgsR0FBNExzRSxFQUE1TCxHQUFpTSxPQUFqTSxHQUEyTUksVUFBM00sR0FBd04seUVBQXhOLEdBQW9TSixFQUFwUyxHQUF5UyxzU0FBelMsR0FBa2xCQyxLQUFLLENBQUN2RSxXQUF4bEIsR0FBc21CLDBCQUE3bUI7QUFDQSxPQTlJWTtBQWdKYmdFLHNCQUFnQixFQUFFLDBCQUFTN0UsU0FBVCxFQUFtQjtBQUNwQyxlQUFRQSxTQUFTLEtBQUssU0FBZixHQUE0Qix3R0FBNUIsR0FBdUksb0hBQTlJO0FBQ0EsT0FsSlk7QUFvSmI4RSx1QkFBaUIsRUFBRSwyQkFBU0ssRUFBVCxFQUFhSyxVQUFiLEVBQXlCQyxRQUF6QixFQUFtQ3pGLFNBQW5DLEVBQTZDO0FBQy9ELFlBQUkwRixNQUFNLEdBQUkxRixTQUFTLEtBQUssU0FBZixHQUE0QixHQUE1QixHQUFrQyxHQUEvQztBQUNBLGVBQU8seUJBQXlCbUYsRUFBekIsR0FBOEIsOERBQTlCLEdBQStGTyxNQUEvRixHQUF3Ryx3Q0FBeEcsR0FBbUpGLFVBQW5KLEdBQWdLLHlDQUFoSyxHQUE0TUMsUUFBNU0sR0FBdU4sdUJBQTlOO0FBQ0EsT0F2Slk7QUF5SmJ0QyxxQkFBZSxFQUFFLHlCQUFTckIsTUFBVCxFQUFpQkwsR0FBakIsRUFBcUI7QUFDckMsWUFBSVQsUUFBUSxHQUFHLEtBQUsxRCxRQUFMLENBQWMwRCxRQUE3QjtBQUNBQSxnQkFBUSxDQUFDYyxNQUFELEVBQVNMLEdBQVQsQ0FBUjtBQUNBO0FBNUpZLEtBQWQ7QUFnS0EsUUFBSWtFLGFBQWEsR0FBRztBQUVuQkMsWUFBTSxFQUFFLGtCQUFXO0FBQ2xCLFlBQUl6RCxLQUFLLEdBQUcsWUFBWXZDLFVBQXhCOztBQUNBLFlBQUk2QixHQUFHLEdBQUcvRixDQUFDLENBQUMsSUFBRCxDQUFYO0FBQ0EsWUFBSW1LLFFBQVEsR0FBR3BFLEdBQUcsQ0FBQ3ZELElBQUosQ0FBU2lFLEtBQVQsRUFBZ0JNLE1BQS9CO0FBQ0FvRCxnQkFBUSxDQUFDekMsR0FBVDtBQUNBM0IsV0FBRyxDQUFDcUUsVUFBSixDQUFlM0QsS0FBZixFQUFzQjRELE1BQXRCO0FBQ0EsT0FSa0I7QUFVbkJDLGVBQVMsRUFBRSxtQkFBU2xFLE1BQVQsRUFBaUJILEtBQWpCLEVBQXdCO0FBQ2xDLFlBQUlRLEtBQUssR0FBRyxZQUFZdkMsVUFBeEI7O0FBQ0EsWUFBSTZCLEdBQUcsR0FBRy9GLENBQUMsQ0FBQyxJQUFELENBQVg7QUFDQSxZQUFJdUssT0FBTyxHQUFHeEUsR0FBRyxDQUFDdkQsSUFBSixDQUFTaUUsS0FBVCxDQUFkOztBQUNBLFlBQUlMLE1BQU0sR0FBR21FLE9BQU8sQ0FBQzNJLFFBQVIsQ0FBaUJ3QyxVQUExQixJQUF3Q2dDLE1BQU0sR0FBRyxDQUFyRCxFQUF5RDtBQUFFO0FBQVM7O0FBQ3BFLFlBQUlILEtBQUosRUFBVztBQUNWRyxnQkFBTSxHQUFHOUQsSUFBSSxDQUFDMkQsS0FBTCxDQUFXRyxNQUFYLENBQVQ7QUFDQTs7QUFDRG1FLGVBQU8sQ0FBQy9DLFdBQVIsQ0FBb0JwQixNQUFwQjtBQUNBLE9BbkJrQjtBQXFCbkJvRSxlQUFTLEVBQUUscUJBQVc7QUFDckIsWUFBSS9ELEtBQUssR0FBRyxZQUFZdkMsVUFBeEI7O0FBQ0EsWUFBSTZCLEdBQUcsR0FBRy9GLENBQUMsQ0FBQyxJQUFELENBQVg7QUFDQSxZQUFJbUssUUFBUSxHQUFHcEUsR0FBRyxDQUFDdkQsSUFBSixDQUFTaUUsS0FBVCxDQUFmO0FBQ0EsZUFBTzBELFFBQVEsQ0FBQ2hFLE1BQVQsQ0FBZ0JDLE1BQXZCO0FBQ0EsT0ExQmtCO0FBNEJuQnFFLFlBQU0sRUFBRSxnQkFBU0MsT0FBVCxFQUFrQjtBQUN6QixZQUFJakUsS0FBSyxHQUFHLFlBQVl2QyxVQUF4Qjs7QUFDQSxZQUFJNkIsR0FBRyxHQUFHL0YsQ0FBQyxDQUFDLElBQUQsQ0FBWDtBQUNBLFlBQUltSyxRQUFRLEdBQUdwRSxHQUFHLENBQUN2RCxJQUFKLENBQVNpRSxLQUFULENBQWY7QUFDQSxZQUFJTSxNQUFNLEdBQUdvRCxRQUFRLENBQUNwRCxNQUF0Qjs7QUFFQSxZQUFHMkQsT0FBTyxJQUFJLENBQVgsSUFBZ0JBLE9BQU8sR0FBRyxHQUE3QixFQUFrQztBQUNqQ0MsaUJBQU8sQ0FBQ0MsR0FBUixDQUFZLHlCQUFaO0FBQ0E7QUFDQTs7QUFFRDdELGNBQU0sR0FBRzhELEtBQUssQ0FBQ0MsU0FBTixDQUFnQjlILEtBQWhCLENBQXNCK0gsSUFBdEIsQ0FBMkJoRSxNQUEzQixDQUFUO0FBQ0FBLGNBQU0sQ0FBQ2lFLE9BQVAsQ0FBZSxVQUFTakMsSUFBVCxFQUFjO0FBQzVCL0ksV0FBQyxDQUFDK0ksSUFBRCxDQUFELENBQVFsRixHQUFSLENBQVk7QUFDWCxxQkFBUzZHLE9BQU8sR0FBRyxJQURSO0FBRVgsc0JBQVVBLE9BQU8sR0FBRztBQUZULFdBQVo7QUFJQSxTQUxEO0FBTUEsT0E5Q2tCO0FBZ0RuQk8saUJBQVcsRUFBRSxxQkFBU0MsSUFBVCxFQUFlO0FBQzNCLFlBQUl6RSxLQUFLLEdBQUcsWUFBWXZDLFVBQXhCOztBQUNBLFlBQUk2QixHQUFHLEdBQUcvRixDQUFDLENBQUMsSUFBRCxDQUFYO0FBQ0EsWUFBSXVLLE9BQU8sR0FBR3hFLEdBQUcsQ0FBQ3ZELElBQUosQ0FBU2lFLEtBQVQsQ0FBZDs7QUFDQSxZQUFHeUUsSUFBSSxLQUFLLElBQVosRUFBaUI7QUFDaEJYLGlCQUFPLENBQUN4RCxNQUFSLENBQWVXLEdBQWYsQ0FBbUIsMEJBQW5CO0FBQ0EsU0FGRCxNQUVPO0FBQ042QyxpQkFBTyxDQUFDM0ksUUFBUixDQUFpQmdELFFBQWpCLEdBQTRCLEtBQTVCO0FBQ0EyRixpQkFBTyxDQUFDMUQsWUFBUjtBQUNBO0FBQ0Q7QUExRGtCLEtBQXBCLENBak82QyxDQWdTN0M7O0FBQ0E3RyxLQUFDLENBQUM2QixNQUFGLENBQVM0RCxNQUFNLENBQUNxRixTQUFoQixFQUEyQm5FLE9BQTNCOztBQUVBM0csS0FBQyxDQUFDb0IsRUFBRixDQUFNOEMsVUFBTixJQUFxQixVQUFXeUIsT0FBWCxFQUFxQjtBQUV6QztBQUNBLFVBQUksQ0FBQzNGLENBQUMsQ0FBQ21MLGFBQUYsQ0FBZ0J4RixPQUFoQixDQUFMLEVBQStCO0FBQzlCLFlBQUlzRSxhQUFhLENBQUNtQixjQUFkLENBQTZCekYsT0FBN0IsQ0FBSixFQUEyQztBQUMxQyxpQkFBT3NFLGFBQWEsQ0FBQ3RFLE9BQUQsQ0FBYixDQUF1QjBGLEtBQXZCLENBQTZCLElBQTdCLEVBQW1DUixLQUFLLENBQUNDLFNBQU4sQ0FBZ0I5SCxLQUFoQixDQUFzQitILElBQXRCLENBQTJCTyxTQUEzQixFQUFzQyxDQUF0QyxDQUFuQyxDQUFQO0FBQ0EsU0FGRCxNQUVPO0FBQ050TCxXQUFDLENBQUN1TCxLQUFGLENBQVEsWUFBVzVGLE9BQVgsR0FBb0IscUJBQXBCLEdBQTRDekIsVUFBNUMsR0FBeUQsS0FBakU7QUFDQTtBQUNEOztBQUVELGFBQU8sS0FBS2pELElBQUwsQ0FBVSxZQUFXO0FBQzNCO0FBQ0EsWUFBSyxDQUFDakIsQ0FBQyxDQUFDd0MsSUFBRixDQUFRLElBQVIsRUFBYyxZQUFZMEIsVUFBMUIsQ0FBTixFQUErQztBQUM5Q2xFLFdBQUMsQ0FBQ3dDLElBQUYsQ0FBUSxJQUFSLEVBQWMsWUFBWTBCLFVBQTFCLEVBQXNDLElBQUl1QixNQUFKLENBQVksSUFBWixFQUFrQkUsT0FBbEIsQ0FBdEM7QUFDQTtBQUNELE9BTE0sQ0FBUDtBQU1BLEtBakJEO0FBbUJBLEdBdFRBLEVBc1RHNkYsTUF0VEgsRUFzVFd4SCxNQXRUWCxFQXNUbUIvRCxRQXRUbkI7O0FBeVRERCxHQUFDLENBQUMsWUFBRCxDQUFELENBQWdCeUwsVUFBaEIsQ0FBMkI7QUFDMUJyRyxpQkFBYSxFQUFFcEYsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JLLEdBQXRCLEtBQThCLENBRG5CO0FBRTFCOEUsZUFBVyxFQUFFLE1BRmE7QUFHMUJELGVBQVcsRUFBRSxFQUhhO0FBSTFCRyxZQUFRLEVBQUUsRUFKZ0I7QUFLMUJYLGNBQVUsRUFBRSxNQUxjO0FBTTFCWSxZQUFRLEVBQUUsa0JBQVVvRyxhQUFWLEVBQXlCM0YsR0FBekIsRUFBOEI7QUFDdkMsVUFBSXZELElBQUksR0FBRztBQUNWbUosdUJBQWUsRUFBRUQsYUFBYSxHQUFHO0FBRHZCLE9BQVg7QUFHQSxVQUFJRSxHQUFHLEdBQUcsZUFBZTVMLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JLLEdBQWhCLEVBQXpCO0FBQ0FMLE9BQUMsQ0FBQzZMLElBQUYsQ0FBT0QsR0FBUCxFQUFZcEosSUFBWixFQUFrQixVQUFVQSxJQUFWLEVBQWdCO0FBQ2pDLFlBQUlBLElBQUksQ0FBQ3NKLE1BQUwsSUFBZSxJQUFuQixFQUF5QixDQUN4QjtBQUNELE9BSEQ7QUFJQTtBQWZ5QixHQUEzQjtBQWtCQTlMLEdBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlFLEVBQVosQ0FBZSxPQUFmLEVBQXVCLFlBQXZCLEVBQW9DLFlBQVk7QUFDL0N3SyxXQUFPLENBQUNDLEdBQVIsQ0FBWTVLLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUXlMLFVBQVIsQ0FBbUIsV0FBbkIsQ0FBWjtBQUNBLEdBRkQ7QUFJR3pMLEdBQUMsQ0FBQyxrQ0FBRCxDQUFELENBQXNDNEMsUUFBdEMsQ0FBK0MsVUFBL0M7QUFDQTVDLEdBQUMsQ0FBQyxnQ0FBRCxDQUFELENBQW9DNEMsUUFBcEMsQ0FBNkMsVUFBN0M7QUFFQTVDLEdBQUMsQ0FBQyx3Q0FBRCxDQUFELENBQTRDNEMsUUFBNUMsQ0FBcUQsZ0NBQXJELEVBNWpCMkIsQ0E4akIzQjs7QUFDQTVDLEdBQUMsQ0FBQyxrQ0FBRCxDQUFELENBQXNDRyxFQUF0QyxDQUF5QyxPQUF6QyxFQUFrRCxXQUFsRCxFQUErRCxZQUFZO0FBQ3ZFLFFBQUlILENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUWdCLEVBQVIsQ0FBVyxVQUFYLENBQUosRUFBNEI7QUFDeEIsY0FBUWhCLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUssR0FBUixFQUFSO0FBQ0ksYUFBSyxHQUFMO0FBQ0lMLFdBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUStMLE1BQVIsR0FBaUJDLElBQWpCLEdBQXdCakssUUFBeEIsQ0FBaUMsT0FBakMsRUFBMENiLElBQTFDLENBQStDLFNBQS9DLEVBQTBELElBQTFEO0FBQ0E7O0FBQ0osYUFBSyxHQUFMO0FBQ0lsQixXQUFDLENBQUMsSUFBRCxDQUFELENBQVErTCxNQUFSLEdBQWlCQyxJQUFqQixHQUF3QmpLLFFBQXhCLENBQWlDLE9BQWpDLEVBQTBDYixJQUExQyxDQUErQyxTQUEvQyxFQUEwRCxJQUExRDtBQUNBbEIsV0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRK0wsTUFBUixHQUFpQkMsSUFBakIsR0FBd0JBLElBQXhCLEdBQStCakssUUFBL0IsQ0FBd0MsT0FBeEMsRUFBaURiLElBQWpELENBQXNELFNBQXRELEVBQWlFLElBQWpFO0FBQ0E7QUFQUjtBQVNIOztBQUNELFFBQUksQ0FBQ2xCLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUWdCLEVBQVIsQ0FBVyxVQUFYLENBQUwsRUFBNkI7QUFDekIsY0FBUWhCLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUssR0FBUixFQUFSO0FBQ0ksYUFBSyxHQUFMO0FBQ0lMLFdBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUStMLE1BQVIsR0FBaUJ4SSxJQUFqQixHQUF3QnhCLFFBQXhCLENBQWlDLE9BQWpDLEVBQTBDYixJQUExQyxDQUErQyxTQUEvQyxFQUEwRCxLQUExRDtBQUNBOztBQUNKLGFBQUssR0FBTDtBQUNJbEIsV0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRK0wsTUFBUixHQUFpQnhJLElBQWpCLEdBQXdCeEIsUUFBeEIsQ0FBaUMsT0FBakMsRUFBMENiLElBQTFDLENBQStDLFNBQS9DLEVBQTBELEtBQTFEO0FBQ0FsQixXQUFDLENBQUMsSUFBRCxDQUFELENBQVErTCxNQUFSLEdBQWlCeEksSUFBakIsR0FBd0JBLElBQXhCLEdBQStCeEIsUUFBL0IsQ0FBd0MsT0FBeEMsRUFBaURiLElBQWpELENBQXNELFNBQXRELEVBQWlFLEtBQWpFO0FBQ0E7QUFQUjtBQVNIO0FBRUosR0F4QkQsRUEvakIyQixDQXlsQjNCO0FBQ0E7QUFDSCxDQTNsQkQsRSIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW4iLCJtb2R1bGUuZXhwb3J0cyA9IFwiL2J1aWxkL2ltYWdlcy9sb2dvLjAwNzJiNDY5LnBuZ1wiOyIsIm1vZHVsZS5leHBvcnRzID0gXCIvYnVpbGQvaW1hZ2VzL3Byb2ZpbC45NmEyYzNmMC5zdmdcIjsiLCIvKlxyXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXHJcbiAqXHJcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcclxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cclxuICovXHJcblxyXG4vLyBhbnkgQ1NTIHlvdSByZXF1aXJlIHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxyXG5yZXF1aXJlKCcuLi9jc3MvYXBwLmNzcycpO1xyXG5cclxuLy9jb25zdCAkID0gcmVxdWlyZSgnanF1ZXJ5Jyk7XHJcbi8vIHRoaXMgXCJtb2RpZmllc1wiIHRoZSBqcXVlcnkgbW9kdWxlOiBhZGRpbmcgYmVoYXZpb3IgdG8gaXRcclxuLy8gdGhlIGJvb3RzdHJhcCBtb2R1bGUgZG9lc24ndCBleHBvcnQvcmV0dXJuIGFueXRoaW5nXHJcbi8vcmVxdWlyZSgnYm9vdHN0cmFwJyk7XHJcblxyXG4vLyBvciB5b3UgY2FuIGluY2x1ZGUgc3BlY2lmaWMgcGllY2VzXHJcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcC9qcy9kaXN0L3Rvb2x0aXAnKTtcclxuLy8gcmVxdWlyZSgnYm9vdHN0cmFwL2pzL2Rpc3QvcG9wb3ZlcicpO1xyXG5cclxuLyokKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKCk7XHJcbn0pOyovXHJcblxyXG5yZXF1aXJlKCcuLi9qcy9tYWluLmpzJyk7XHJcblxyXG5cclxucmVxdWlyZSgnLi4vaW1hZ2VzL2xvZ28ucG5nJyk7XHJcbnJlcXVpcmUoJy4uL2ltYWdlcy9wcm9maWwuc3ZnJyk7IiwiJChkb2N1bWVudCkucmVhZHkoIGZ1bmN0aW9uICgpIHtcclxuXHQkKFwiI3NlYXJjaC1maWx0ZXJcIikub24oXCJrZXl1cFwiLCBmdW5jdGlvbigpIHtcclxuXHJcblx0ICAgIHZhciB2YWx1ZSA9ICQodGhpcykudmFsKCkudG9Mb3dlckNhc2UoKTtcclxuXHQgICAgJChcIiNteVRhYmxlQm9keSB0clwiKS5maWx0ZXIoZnVuY3Rpb24oKSB7XHJcblx0ICAgICAgJCh0aGlzKS50b2dnbGUoJCh0aGlzKS50ZXh0KCkudG9Mb3dlckNhc2UoKS5pbmRleE9mKHZhbHVlKSA+IC0xKVxyXG5cdCAgICB9KTtcclxuXHQgIH0pO1xyXG5cclxuICAgIC8qLy9leHBvcnRlIGxlcyBkb25uw6llcyBzw6lsZWN0aW9ubsOpZXNcclxuXHR2YXIgJHRhYmxlID0gJCgnI3RhYmxlJyk7XHJcblx0JChmdW5jdGlvbiAoKSB7XHJcblx0ICAgICQoJyN0b29sYmFyJykuZmluZCgnc2VsZWN0JykuY2hhbmdlKGZ1bmN0aW9uICgpIHtcclxuXHQgICAgICAgICR0YWJsZS5ib290c3RyYXBUYWJsZSgncmVmcmVzaE9wdGlvbnMnLCB7XHJcblx0ICAgICAgICAgICAgZXhwb3J0RGF0YVR5cGU6ICQodGhpcykudmFsKCksXHJcblx0ICAgICAgICB9KTtcclxuXHQgICAgfSk7XHJcblx0fSlcclxuXHR2YXIgdHJCb2xkQmx1ZSA9ICQoXCJ0YWJsZVwiKTsqL1xyXG5cclxuXHJcblxyXG5cdC8vIEF1IGNsaXF1ZSBkJ3VuZSBjYXNlIGQndW4gdGFibGVhdSBjZWxhIG5vdXMgcmVkaXJpZ2UgdmVycyBsYSBwYWdlIGNvcnJlc3BvbmRhbnRlXHJcblx0JCggXCJ0Ym9keSB0ZFwiICkuY2xpY2soZnVuY3Rpb24oKSB7XHJcblx0XHR2YXIgVXJsTGluayA9ICQodGhpcykuZmluZChcImFcIikuYXR0cignaHJlZicpO1xyXG5cdFx0JChsb2NhdGlvbikuYXR0cignaHJlZicsIFVybExpbmspO1xyXG5cdH0pXHJcblxyXG5cdC8qKiQodHJCb2xkQmx1ZSkub24oXCJjbGlja1wiLCBcInRyXCIsIGZ1bmN0aW9uICgpe1xyXG5cdFx0XHQkKHRoaXMpLnRvZ2dsZUNsYXNzKFwiYm9sZC1ibHVlXCIpO1xyXG5cdH0pO1xyXG5cdCAkKCBcIiNleHBvcnRcIiApLmNsaWNrKGZ1bmN0aW9uKCkge1xyXG5cdFx0JChcIiN0YWJsZVwiKS50YWJsZUV4cG9ydCh7XHJcblx0ICAgIGhlYWRpbmdzOiB0cnVlLCAgICAgICAgICAgICAgICAgICAgLy8gKEJvb2xlYW4pLCBkaXNwbGF5IHRhYmxlIGhlYWRpbmdzICh0aC90ZCBlbGVtZW50cykgaW4gdGhlIDx0aGVhZD5cclxuXHQgICAgZm9vdGVyczogdHJ1ZSwgICAgICAgICAgICAgICAgICAgICAvLyAoQm9vbGVhbiksIGRpc3BsYXkgdGFibGUgZm9vdGVycyAodGgvdGQgZWxlbWVudHMpIGluIHRoZSA8dGZvb3Q+XHJcblx0ICAgIGZvcm1hdHM6IFtcImNzdlwiXSwgICAgLy8gKFN0cmluZ1tdKSwgZmlsZXR5cGVzIGZvciB0aGUgZXhwb3J0XHJcblx0ICAgIGZpbGVOYW1lOiBcImlkXCIsICAgICAgICAgICAgICAgICAgICAvLyAoaWQsIFN0cmluZyksIGZpbGVuYW1lIGZvciB0aGUgZG93bmxvYWRlZCBmaWxlXHJcblx0ICAgIGJvb3RzdHJhcDogdHJ1ZSwgICAgICAgICAgICAgICAgICAgLy8gKEJvb2xlYW4pLCBzdHlsZSBidXR0b25zIHVzaW5nIGJvb3RzdHJhcFxyXG5cdCAgICBwb3NpdGlvbjogXCJib3R0b21cIiwgICAgICAgICAgICAgICAgIC8vICh0b3AsIGJvdHRvbSksIHBvc2l0aW9uIG9mIHRoZSBjYXB0aW9uIGVsZW1lbnQgcmVsYXRpdmUgdG8gdGFibGVcclxuXHQgICAgaWdub3JlUm93czogbnVsbCwgICAgICAgICAgICAgICAgICAvLyAoTnVtYmVyLCBOdW1iZXJbXSksIHJvdyBpbmRpY2VzIHRvIGV4Y2x1ZGUgZnJvbSB0aGUgZXhwb3J0ZWQgZmlsZShzKVxyXG5cdCAgICBpZ25vcmVDb2xzOiBudWxsLCAgICAgICAgICAgICAgICAgIC8vIChOdW1iZXIsIE51bWJlcltdKSwgY29sdW1uIGluZGljZXMgdG8gZXhjbHVkZSBmcm9tIHRoZSBleHBvcnRlZCBmaWxlKHMpXHJcblx0ICAgIGlnbm9yZUNTUzogXCIudGFibGVleHBvcnQtaWdub3JlXCIsICAvLyAoc2VsZWN0b3IsIHNlbGVjdG9yW10pLCBzZWxlY3RvcihzKSB0byBleGNsdWRlIGZyb20gdGhlIGV4cG9ydGVkIGZpbGUocylcclxuXHQgICAgZW1wdHlDU1M6IFwiLnRhYmxlZXhwb3J0LWVtcHR5XCIsICAgIC8vIChzZWxlY3Rvciwgc2VsZWN0b3JbXSksIHNlbGVjdG9yKHMpIHRvIHJlcGxhY2UgY2VsbHMgd2l0aCBhbiBlbXB0eSBzdHJpbmcgaW4gdGhlIGV4cG9ydGVkIGZpbGUocylcclxuXHQgICAgdHJpbVdoaXRlc3BhY2U6IGZhbHNlICAgICAgICAgICAgICAvLyAoQm9vbGVhbiksIHJlbW92ZSBhbGwgbGVhZGluZy90cmFpbGluZyBuZXdsaW5lcywgc3BhY2VzLCBhbmQgdGFicyBmcm9tIGNlbGwgdGV4dCBpbiB0aGUgZXhwb3J0ZWQgZmlsZShzKVxyXG5cdH0pO1xyXG5cdH0pKiovXHJcblxyXG5cdC8vIC0tLS0tLS0tLS0gVGFibGVhdSBjb250ZW5hbnQgbGEgbGlzdGUgZGVzIGRvbm7DqWVzIC0tLS0tLS0tLS0tLS1cclxuXHQvLyBBdSBjbGlxdWUgZGUgbGEgY2hlY2tib3ggcHJpbmNpcGFsLCBjZWxhIHPDqWxlY3Rpb25uZSB0b3V0ZXMgbGVzIGNoZWNrYm94XHJcblx0Ly8gUGx1cyBwb3NzaWJsaXTDqSBkZSBzw6lsw6ljdGlvbm5lciBwbHVzaWV1cnMgY2hlY2tib3hcclxuXHQkKFwiI3RhYmxlICNjaGVja2FsbFwiKS5jbGljayhmdW5jdGlvbiAoKSB7XHJcblx0XHRpZiAoJChcIiN0YWJsZSAjY2hlY2thbGxcIikuaXMoJzpjaGVja2VkJykpIHtcclxuXHRcdFx0JChcIiN0YWJsZSBpbnB1dFt0eXBlPWNoZWNrYm94XVwiKS5lYWNoKGZ1bmN0aW9uICgpIHtcclxuXHRcdFx0XHQkKHRoaXMpLnByb3AoXCJjaGVja2VkXCIsIHRydWUpO1xyXG5cdFx0XHR9KTtcclxuXHJcblx0XHR9IGVsc2Uge1xyXG5cdFx0XHQkKFwiI3RhYmxlIGlucHV0W3R5cGU9Y2hlY2tib3hdXCIpLmVhY2goZnVuY3Rpb24gKCkge1xyXG5cdFx0XHRcdCQodGhpcykucHJvcChcImNoZWNrZWRcIiwgZmFsc2UpO1xyXG5cdFx0XHR9KTtcclxuXHRcdH1cclxuXHR9KTtcclxuXHQkKFwiW2RhdGEtdG9nZ2xlPXRvb2x0aXBdXCIpLnRvb2x0aXAoKTtcclxuXHQvLyAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxyXG5cclxuXHQkLmZuLnBhZ2VNZSA9IGZ1bmN0aW9uKG9wdHMpe1xyXG5cdFx0dmFyICR0aGlzID0gdGhpcyxcclxuXHRcdFx0ZGVmYXVsdHMgPSB7XHJcblx0XHRcdFx0cGVyUGFnZTogNyxcclxuXHRcdFx0XHRzaG93UHJldk5leHQ6IGZhbHNlLFxyXG5cdFx0XHRcdGhpZGVQYWdlTnVtYmVyczogZmFsc2VcclxuXHRcdFx0fSxcclxuXHRcdFx0c2V0dGluZ3MgPSAkLmV4dGVuZChkZWZhdWx0cywgb3B0cyk7XHJcblxyXG5cdFx0dmFyIGxpc3RFbGVtZW50ID0gJHRoaXM7XHJcblx0XHR2YXIgcGVyUGFnZSA9IHNldHRpbmdzLnBlclBhZ2U7XHJcblx0XHR2YXIgY2hpbGRyZW4gPSBsaXN0RWxlbWVudC5jaGlsZHJlbigpO1xyXG5cdFx0dmFyIHBhZ2VyID0gJCgnLnBhZ2VyJyk7XHJcblxyXG5cdFx0aWYgKHR5cGVvZiBzZXR0aW5ncy5jaGlsZFNlbGVjdG9yIT1cInVuZGVmaW5lZFwiKSB7XHJcblx0XHRcdGNoaWxkcmVuID0gbGlzdEVsZW1lbnQuZmluZChzZXR0aW5ncy5jaGlsZFNlbGVjdG9yKTtcclxuXHRcdH1cclxuXHJcblx0XHRpZiAodHlwZW9mIHNldHRpbmdzLnBhZ2VyU2VsZWN0b3IhPVwidW5kZWZpbmVkXCIpIHtcclxuXHRcdFx0cGFnZXIgPSAkKHNldHRpbmdzLnBhZ2VyU2VsZWN0b3IpO1xyXG5cdFx0fVxyXG5cclxuXHRcdHZhciBudW1JdGVtcyA9IGNoaWxkcmVuLmxlbmd0aDtcclxuXHRcdHZhciBudW1QYWdlcyA9IE1hdGguY2VpbChudW1JdGVtcy9wZXJQYWdlKTtcclxuXHJcblx0XHRwYWdlci5kYXRhKFwiY3VyclwiLDApO1xyXG5cclxuXHRcdGlmIChzZXR0aW5ncy5zaG93UHJldk5leHQpe1xyXG5cdFx0XHQkKCc8bGkgY2xhc3M9XCJwYWdlLWl0ZW0gcHJldi1wYWdlXCI+PGEgaHJlZj1cIiNcIiBjbGFzcz1cInByZXYtbGlua1wiPjxpIGNsYXNzPVwiZmFzIGZhLWFycm93LWxlZnRcIj48L2k+PC9hPjwvbGk+JykuYXBwZW5kVG8ocGFnZXIpO1xyXG5cdFx0fVxyXG5cclxuXHRcdHZhciBjdXJyID0gMDtcclxuXHRcdHdoaWxlKG51bVBhZ2VzID4gY3VyciAmJiAoc2V0dGluZ3MuaGlkZVBhZ2VOdW1iZXJzPT1mYWxzZSkpe1xyXG5cdFx0XHQkKCc8bGkgY2xhc3M9XCJwYWdlLWl0ZW1cIj48YSBocmVmPVwiI1wiIGNsYXNzPVwibGluay1wYWdlXCI+JysoY3VycisxKSsnPC9hPjwvbGk+JykuYXBwZW5kVG8ocGFnZXIpO1xyXG5cdFx0XHRjdXJyKys7XHJcblx0XHR9XHJcblxyXG5cdFx0aWYgKHNldHRpbmdzLnNob3dQcmV2TmV4dCl7XHJcblx0XHRcdCQoJzxsaSBjbGFzcz1cInBhZ2UtaXRlbSBuZXh0LXBhZ2VcIj48YSBocmVmPVwiI1wiIGNsYXNzPVwibmV4dC1saW5rXCI+PGkgY2xhc3M9XCJmYXMgZmEtYXJyb3ctcmlnaHRcIj48L2k+PC9hPjwvbGk+JykuYXBwZW5kVG8ocGFnZXIpO1xyXG5cdFx0fVxyXG5cclxuXHRcdHZhciBuYlBhZ2UgPSAkKFwiLnBhZ2VyIGxpXCIpLmxlbmd0aCAtIDI7XHJcblxyXG5cdFx0cGFnZXIuZmluZCgnLmxpbmstcGFnZTpmaXJzdCcpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuXHRcdC8qcGFnZXIuZmluZCgnLnByZXYtbGluaycpLmhpZGUoKTsqL1xyXG5cdFx0cGFnZXIuZmluZCgnLnByZXYtbGluaycpLmFkZENsYXNzKFwicHJldi1saW5rLWRpc2VhYmxlXCIpO1xyXG5cdFx0Ly9wYWdlci5maW5kKCcucHJldi1saW5rJykucmVtb3ZlQ2xhc3MoXCJwcmV2LWxpbmtcIik7XHJcblx0XHRpZiAobnVtUGFnZXM8PTEpIHtcclxuXHRcdFx0LypwYWdlci5maW5kKCcubmV4dC1saW5rJykuaGlkZSgpOyovXHJcblx0XHRcdHBhZ2VyLmZpbmQoJy5uZXh0LWxpbmsnKS5hZGRDbGFzcyhcIm5leHQtbGluay1kaXNlYWJsZVwiKTtcclxuXHRcdFx0cGFnZXIuZmluZCgnLm5leHQtbGluaycpLnJlbW92ZUNsYXNzKFwibmV4dC1saW5rXCIpO1xyXG5cdFx0fVxyXG5cclxuXHRcdGlmIChuYlBhZ2UgPT09IDIpIHtcclxuXHRcdFx0JChcIi50YWJsZS1hZnRlci1wYWdpbmF0aW9uXCIpLmFkZENsYXNzKFwidGFibGUtYWZ0ZXItcGFnaW5hdGlvbi0yLXdpZHRoXCIpO1xyXG5cdFx0XHQkKFwiLnRhYmxlLWFmdGVyLXBhZ2luYXRpb25cIikucmVtb3ZlQ2xhc3MoXCJ0YWJsZS1hZnRlci1wYWdpbmF0aW9uLTMtd2lkdGhcIik7XHJcblx0XHRcdCQoXCIudGFibGUtYWZ0ZXItcGFnaW5hdGlvblwiKS5yZW1vdmVDbGFzcyhcInRhYmxlLWFmdGVyLXBhZ2luYXRpb24tNC13aWR0aFwiKTtcclxuXHRcdFx0JChcIi50YWJsZS1hZnRlci1wYWdpbmF0aW9uXCIpLnJlbW92ZUNsYXNzKFwidGFibGUtYWZ0ZXItcGFnaW5hdGlvbi01LXdpZHRoXCIpO1xyXG5cdFx0fVxyXG5cdFx0ZWxzZSBpZiAobmJQYWdlID09PSAzKSB7XHJcblx0XHRcdCQoXCIudGFibGUtYWZ0ZXItcGFnaW5hdGlvblwiKS5hZGRDbGFzcyhcInRhYmxlLWFmdGVyLXBhZ2luYXRpb24tMy13aWR0aFwiKTtcclxuXHRcdFx0JChcIi50YWJsZS1hZnRlci1wYWdpbmF0aW9uXCIpLnJlbW92ZUNsYXNzKFwidGFibGUtYWZ0ZXItcGFnaW5hdGlvbi0yLXdpZHRoXCIpO1xyXG5cdFx0XHQkKFwiLnRhYmxlLWFmdGVyLXBhZ2luYXRpb25cIikucmVtb3ZlQ2xhc3MoXCJ0YWJsZS1hZnRlci1wYWdpbmF0aW9uLTQtd2lkdGhcIik7XHJcblx0XHRcdCQoXCIudGFibGUtYWZ0ZXItcGFnaW5hdGlvblwiKS5yZW1vdmVDbGFzcyhcInRhYmxlLWFmdGVyLXBhZ2luYXRpb24tNS13aWR0aFwiKTtcclxuXHRcdH1cclxuXHRcdGVsc2UgaWYgKG5iUGFnZSA9PT0gNCkge1xyXG5cdFx0XHQkKFwiLnRhYmxlLWFmdGVyLXBhZ2luYXRpb25cIikuYWRkQ2xhc3MoXCJ0YWJsZS1hZnRlci1wYWdpbmF0aW9uLTQtd2lkdGhcIik7XHJcblx0XHRcdCQoXCIudGFibGUtYWZ0ZXItcGFnaW5hdGlvblwiKS5yZW1vdmVDbGFzcyhcInRhYmxlLWFmdGVyLXBhZ2luYXRpb24tMi13aWR0aFwiKTtcclxuXHRcdFx0JChcIi50YWJsZS1hZnRlci1wYWdpbmF0aW9uXCIpLnJlbW92ZUNsYXNzKFwidGFibGUtYWZ0ZXItcGFnaW5hdGlvbi0zLXdpZHRoXCIpO1xyXG5cdFx0XHQkKFwiLnRhYmxlLWFmdGVyLXBhZ2luYXRpb25cIikucmVtb3ZlQ2xhc3MoXCJ0YWJsZS1hZnRlci1wYWdpbmF0aW9uLTUtd2lkdGhcIik7XHJcblx0XHR9XHJcblx0XHRlbHNlIGlmIChuYlBhZ2UgPT09IDUpIHtcclxuXHRcdFx0JChcIi50YWJsZS1hZnRlci1wYWdpbmF0aW9uXCIpLmFkZENsYXNzKFwidGFibGUtYWZ0ZXItcGFnaW5hdGlvbi01LXdpZHRoXCIpO1xyXG5cdFx0XHQkKFwiLnRhYmxlLWFmdGVyLXBhZ2luYXRpb25cIikucmVtb3ZlQ2xhc3MoXCJ0YWJsZS1hZnRlci1wYWdpbmF0aW9uLTItd2lkdGhcIik7XHJcblx0XHRcdCQoXCIudGFibGUtYWZ0ZXItcGFnaW5hdGlvblwiKS5yZW1vdmVDbGFzcyhcInRhYmxlLWFmdGVyLXBhZ2luYXRpb24tMy13aWR0aFwiKTtcclxuXHRcdFx0JChcIi50YWJsZS1hZnRlci1wYWdpbmF0aW9uXCIpLnJlbW92ZUNsYXNzKFwidGFibGUtYWZ0ZXItcGFnaW5hdGlvbi00LXdpZHRoXCIpO1xyXG5cdFx0fVxyXG5cclxuXHRcdHBhZ2VyLmNoaWxkcmVuKCkuZXEoMSkuYWRkQ2xhc3MoXCJhY3RpdmVcIik7XHJcblxyXG5cdFx0Y2hpbGRyZW4uaGlkZSgpO1xyXG5cdFx0Y2hpbGRyZW4uc2xpY2UoMCwgcGVyUGFnZSkuc2hvdygpO1xyXG5cclxuXHRcdHBhZ2VyLmZpbmQoJ2xpIC5saW5rLXBhZ2UnKS5jbGljayhmdW5jdGlvbigpe1xyXG5cdFx0XHR2YXIgY2xpY2tlZFBhZ2UgPSAkKHRoaXMpLmh0bWwoKS52YWx1ZU9mKCktMTtcclxuXHRcdFx0Z29UbyhjbGlja2VkUGFnZSxwZXJQYWdlKTtcclxuXHRcdFx0cmV0dXJuIGZhbHNlO1xyXG5cdFx0fSk7XHJcblx0XHRwYWdlci5maW5kKCdsaSAucHJldi1saW5rJykuY2xpY2soZnVuY3Rpb24oKXtcclxuXHRcdFx0cHJldmlvdXMoKTtcclxuXHRcdFx0cmV0dXJuIGZhbHNlO1xyXG5cdFx0fSk7XHJcblx0XHRwYWdlci5maW5kKCdsaSAubmV4dC1saW5rJykuY2xpY2soZnVuY3Rpb24oKXtcclxuXHRcdFx0bmV4dCgpO1xyXG5cdFx0XHRyZXR1cm4gZmFsc2U7XHJcblx0XHR9KTtcclxuXHJcblx0XHRmdW5jdGlvbiBwcmV2aW91cygpe1xyXG5cdFx0XHR2YXIgZ29Ub1BhZ2UgPSBwYXJzZUludChwYWdlci5kYXRhKFwiY3VyclwiKSkgLSAxO1xyXG5cdFx0XHRnb1RvKGdvVG9QYWdlKTtcclxuXHRcdH1cclxuXHJcblx0XHRmdW5jdGlvbiBuZXh0KCl7XHJcblx0XHRcdGdvVG9QYWdlID0gcGFyc2VJbnQocGFnZXIuZGF0YShcImN1cnJcIikpICsgMTtcclxuXHRcdFx0Z29Ubyhnb1RvUGFnZSk7XHJcblx0XHR9XHJcblxyXG5cdFx0ZnVuY3Rpb24gZ29UbyhwYWdlKXtcclxuXHRcdFx0dmFyIHN0YXJ0QXQgPSBwYWdlICogcGVyUGFnZSxcclxuXHRcdFx0XHRlbmRPbiA9IHN0YXJ0QXQgKyBwZXJQYWdlO1xyXG5cclxuXHRcdFx0Y2hpbGRyZW4uY3NzKCdkaXNwbGF5Jywnbm9uZScpLnNsaWNlKHN0YXJ0QXQsIGVuZE9uKS5zaG93KCk7XHJcblxyXG5cdFx0XHRpZiAocGFnZT49MSkge1xyXG5cdFx0XHRcdC8qcGFnZXIuZmluZCgnLnByZXYtbGluaycpLnNob3coKTsqL1xyXG5cdFx0XHRcdHBhZ2VyLmZpbmQoJy5wcmV2LWxpbmstZGlzZWFibGUnKS5hZGRDbGFzcyhcInByZXYtbGlua1wiKTtcclxuXHRcdFx0XHRwYWdlci5maW5kKCcucHJldi1saW5rLWRpc2VhYmxlJykucmVtb3ZlQ2xhc3MoXCJwcmV2LWxpbmstZGlzZWFibGVcIik7XHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZSB7XHJcblx0XHRcdFx0LypwYWdlci5maW5kKCcucHJldi1saW5rJykuaGlkZSgpOyovXHJcblx0XHRcdFx0cGFnZXIuZmluZCgnLnByZXYtbGluaycpLmFkZENsYXNzKFwicHJldi1saW5rLWRpc2VhYmxlXCIpO1xyXG5cdFx0XHRcdHBhZ2VyLmZpbmQoJy5wcmV2LWxpbmsnKS5yZW1vdmVDbGFzcyhcInByZXYtbGlua1wiKTtcclxuXHRcdFx0fVxyXG5cclxuXHRcdFx0aWYgKHBhZ2U8KG51bVBhZ2VzLTEpKSB7XHJcblx0XHRcdFx0LypwYWdlci5maW5kKCcubmV4dC1saW5rJykuc2hvdygpOyovXHJcblx0XHRcdFx0cGFnZXIuZmluZCgnLm5leHQtbGluay1kaXNlYWJsZScpLmFkZENsYXNzKFwibmV4dC1saW5rXCIpO1xyXG5cdFx0XHRcdHBhZ2VyLmZpbmQoJy5uZXh0LWxpbmstZGlzZWFibGUnKS5yZW1vdmVDbGFzcyhcIm5leHQtbGluay1kaXNlYWJsZVwiKTtcclxuXHRcdFx0fVxyXG5cdFx0XHRlbHNlIHtcclxuXHRcdFx0XHQvKnBhZ2VyLmZpbmQoJy5uZXh0LWxpbmsnKS5oaWRlKCk7Ki9cclxuXHRcdFx0XHRwYWdlci5maW5kKCcubmV4dC1saW5rJykuYWRkQ2xhc3MoXCJuZXh0LWxpbmstZGlzZWFibGVcIik7XHJcblx0XHRcdFx0cGFnZXIuZmluZCgnLm5leHQtbGluaycpLnJlbW92ZUNsYXNzKFwibmV4dC1saW5rXCIpO1xyXG5cdFx0XHR9XHJcblxyXG5cdFx0XHRwYWdlci5kYXRhKFwiY3VyclwiLHBhZ2UpO1xyXG5cdFx0XHRwYWdlci5jaGlsZHJlbigpLnJlbW92ZUNsYXNzKFwiYWN0aXZlXCIpO1xyXG5cdFx0XHRwYWdlci5jaGlsZHJlbigpLmVxKHBhZ2UrMSkuYWRkQ2xhc3MoXCJhY3RpdmVcIik7XHJcblx0XHR9XHJcblx0fTtcclxuXHQvKiQoXCIjdGFibGUtbmItZW50cnlcIikuY2hhbmdlKGZ1bmN0aW9uKCl7XHJcblx0XHQkKFwiI3RhYmxlLW5iLWVudHJ5IG9wdGlvbjpzZWxlY3RlZFwiKS5lYWNoKGZ1bmN0aW9uKCl7XHJcblx0XHRcdG5iUGVyUGFnZSA9ICQodGhpcykudGV4dCgpO1xyXG5cdFx0fSk7XHJcblx0XHRjb25zb2xlLmxvZyhuYlBlclBhZ2UpO1xyXG5cdH0pOyovXHJcblx0LyokKFwiI3RhYmxlLW5iLWVudHJ5IG9wdGlvbjpzZWxlY3RlZFwiKS5jbGljayhmdW5jdGlvbigpe1xyXG5cdFx0dmFyIG5iUGVyUGFnZSA9ICQoXCIjdGFibGUtbmItZW50cnkgb3B0aW9uOnNlbGVjdGVkXCIpLnRleHQoKTtcclxuXHRcdGNvbnNvbGUubG9nKG5iUGVyUGFnZSk7XHJcblx0fSk7Ki9cclxuXHJcblx0JCgnI215VGFibGVCb2R5JykucGFnZU1lKHtwYWdlclNlbGVjdG9yOicjbXlQYWdlcicsc2hvd1ByZXZOZXh0OnRydWUsaGlkZVBhZ2VOdW1iZXJzOmZhbHNlLHBlclBhZ2U6NX0pO1xyXG5cdCQoZnVuY3Rpb24gKCkge1xyXG5cclxuXHRcdCQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKHtodG1sOnRydWUsdHJpZ2dlcjogJ2hvdmVyJ30pXHJcblx0fSlcclxuICBcclxuXHQvLyAtLS0tLS0tLS0tIE9ww6lyYXRpb24gLS0tLS0tLS0tLS0tLVxyXG5cdC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXHJcblxyXG5cdC8qXHJcbiAqICBqUXVlcnkgU3RhclJhdGluZ1N2ZyB2MS4yLjBcclxuICpcclxuICogIGh0dHA6Ly9naXRodWIuY29tL25hc2hpby9zdGFyLXJhdGluZy1zdmdcclxuICogIEF1dGhvcjogSWduYWNpbyBDaGF2ZXpcclxuICogIGhlbGxvQGlnbmFjaW9jaGF2ZXouY29tXHJcbiAqICBMaWNlbnNlZCB1bmRlciBNSVRcclxuICovXHJcblxyXG5cdDsoZnVuY3Rpb24gKCAkLCB3aW5kb3csIGRvY3VtZW50LCB1bmRlZmluZWQgKSB7XHJcblxyXG5cdFx0J3VzZSBzdHJpY3QnO1xyXG5cclxuXHRcdC8vIENyZWF0ZSB0aGUgZGVmYXVsdHMgb25jZVxyXG5cdFx0dmFyIHBsdWdpbk5hbWUgPSAnc3RhclJhdGluZyc7XHJcblx0XHR2YXIgbm9vcCA9IGZ1bmN0aW9uKCl7fTtcclxuXHRcdHZhciBkZWZhdWx0cyA9IHtcclxuXHRcdFx0dG90YWxTdGFyczogNSxcclxuXHRcdFx0dXNlRnVsbFN0YXJzOiBmYWxzZSxcclxuXHRcdFx0c3RhclNoYXBlOiAnc3RyYWlnaHQnLFxyXG5cdFx0XHRlbXB0eUNvbG9yOiAnbGlnaHRncmF5JyxcclxuXHRcdFx0aG92ZXJDb2xvcjogJ29yYW5nZScsXHJcblx0XHRcdGFjdGl2ZUNvbG9yOiAnZ29sZCcsXHJcblx0XHRcdHJhdGVkQ29sb3I6ICdjcmltc29uJyxcclxuXHRcdFx0dXNlR3JhZGllbnQ6IHRydWUsXHJcblx0XHRcdHJlYWRPbmx5OiBmYWxzZSxcclxuXHRcdFx0ZGlzYWJsZUFmdGVyUmF0ZTogZmFsc2UsXHJcblx0XHRcdGJhc2VVcmw6IGZhbHNlLFxyXG5cdFx0XHRzdGFyR3JhZGllbnQ6IHtcclxuXHRcdFx0XHRzdGFydDogJyNGRUY3Q0QnLFxyXG5cdFx0XHRcdGVuZDogJyNGRjk1MTEnXHJcblx0XHRcdH0sXHJcblx0XHRcdHN0cm9rZVdpZHRoOiA0LFxyXG5cdFx0XHRzdHJva2VDb2xvcjogJ2JsYWNrJyxcclxuXHRcdFx0aW5pdGlhbFJhdGluZzogMCxcclxuXHRcdFx0c3RhclNpemU6IDQwLFxyXG5cdFx0XHRjYWxsYmFjazogbm9vcCxcclxuXHRcdFx0b25Ib3Zlcjogbm9vcCxcclxuXHRcdFx0b25MZWF2ZTogbm9vcFxyXG5cdFx0fTtcclxuXHJcblx0XHQvLyBUaGUgYWN0dWFsIHBsdWdpbiBjb25zdHJ1Y3RvclxyXG5cdFx0dmFyIFBsdWdpbiA9IGZ1bmN0aW9uKCBlbGVtZW50LCBvcHRpb25zICkge1xyXG5cdFx0XHR2YXIgX3JhdGluZztcclxuXHRcdFx0dmFyIG5ld1JhdGluZztcclxuXHRcdFx0dmFyIHJvdW5kRm47XHJcblxyXG5cdFx0XHR0aGlzLmVsZW1lbnQgPSBlbGVtZW50O1xyXG5cdFx0XHR0aGlzLiRlbCA9ICQoZWxlbWVudCk7XHJcblx0XHRcdHRoaXMuc2V0dGluZ3MgPSAkLmV4dGVuZCgge30sIGRlZmF1bHRzLCBvcHRpb25zICk7XHJcblxyXG5cdFx0XHQvLyBncmFiIHJhdGluZyBpZiBkZWZpbmVkIG9uIHRoZSBlbGVtZW50XHJcblx0XHRcdF9yYXRpbmcgPSB0aGlzLiRlbC5kYXRhKCdyYXRpbmcnKSB8fCB0aGlzLnNldHRpbmdzLmluaXRpYWxSYXRpbmc7XHJcblxyXG5cdFx0XHQvLyByb3VuZCB0byB0aGUgbmVhcmVzdCBoYWxmXHJcblx0XHRcdHJvdW5kRm4gPSB0aGlzLnNldHRpbmdzLmZvcmNlUm91bmRVcCA/IE1hdGguY2VpbCA6IE1hdGgucm91bmQ7XHJcblx0XHRcdG5ld1JhdGluZyA9IChyb3VuZEZuKCBfcmF0aW5nICogMiApIC8gMikudG9GaXhlZCgxKTtcclxuXHRcdFx0dGhpcy5fc3RhdGUgPSB7XHJcblx0XHRcdFx0cmF0aW5nOiBuZXdSYXRpbmdcclxuXHRcdFx0fTtcclxuXHJcblx0XHRcdC8vIGNyZWF0ZSB1bmlxdWUgaWQgZm9yIHN0YXJzXHJcblx0XHRcdHRoaXMuX3VpZCA9IE1hdGguZmxvb3IoIE1hdGgucmFuZG9tKCkgKiA5OTkgKTtcclxuXHJcblx0XHRcdC8vIG92ZXJyaWRlIGdyYWRpZW50IGlmIG5vdCB1c2VkXHJcblx0XHRcdGlmKCAhb3B0aW9ucy5zdGFyR3JhZGllbnQgJiYgIXRoaXMuc2V0dGluZ3MudXNlR3JhZGllbnQgKXtcclxuXHRcdFx0XHR0aGlzLnNldHRpbmdzLnN0YXJHcmFkaWVudC5zdGFydCA9IHRoaXMuc2V0dGluZ3Muc3RhckdyYWRpZW50LmVuZCA9IHRoaXMuc2V0dGluZ3MuYWN0aXZlQ29sb3I7XHJcblx0XHRcdH1cclxuXHJcblx0XHRcdHRoaXMuX2RlZmF1bHRzID0gZGVmYXVsdHM7XHJcblx0XHRcdHRoaXMuX25hbWUgPSBwbHVnaW5OYW1lO1xyXG5cdFx0XHR0aGlzLmluaXQoKTtcclxuXHRcdH07XHJcblxyXG5cdFx0dmFyIG1ldGhvZHMgPSB7XHJcblx0XHRcdGluaXQ6IGZ1bmN0aW9uICgpIHtcclxuXHRcdFx0XHR0aGlzLnJlbmRlck1hcmt1cCgpO1xyXG5cdFx0XHRcdHRoaXMuYWRkTGlzdGVuZXJzKCk7XHJcblx0XHRcdFx0dGhpcy5pbml0UmF0aW5nKCk7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHRhZGRMaXN0ZW5lcnM6IGZ1bmN0aW9uKCl7XHJcblx0XHRcdFx0aWYoIHRoaXMuc2V0dGluZ3MucmVhZE9ubHkgKXsgcmV0dXJuOyB9XHJcblx0XHRcdFx0dGhpcy4kc3RhcnMub24oJ21vdXNlb3ZlcicsIHRoaXMuaG92ZXJSYXRpbmcuYmluZCh0aGlzKSk7XHJcblx0XHRcdFx0dGhpcy4kc3RhcnMub24oJ21vdXNlb3V0JywgdGhpcy5yZXN0b3JlU3RhdGUuYmluZCh0aGlzKSk7XHJcblx0XHRcdFx0dGhpcy4kc3RhcnMub24oJ2NsaWNrJywgdGhpcy5oYW5kbGVSYXRpbmcuYmluZCh0aGlzKSk7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHQvLyBhcHBseSBzdHlsZXMgdG8gaG92ZXJlZCBzdGFyc1xyXG5cdFx0XHRob3ZlclJhdGluZzogZnVuY3Rpb24oZSl7XHJcblx0XHRcdFx0dmFyIGluZGV4ID0gdGhpcy5nZXRJbmRleChlKTtcclxuXHRcdFx0XHR0aGlzLnBhaW50U3RhcnMoaW5kZXgsICdob3ZlcmVkJyk7XHJcblx0XHRcdFx0dGhpcy5zZXR0aW5ncy5vbkhvdmVyKGluZGV4ICsgMSwgdGhpcy5fc3RhdGUucmF0aW5nLCB0aGlzLiRlbCk7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHQvLyBjbGlja2VkIG9uIGEgcmF0ZSwgYXBwbHkgc3R5bGUgYW5kIHN0YXRlXHJcblx0XHRcdGhhbmRsZVJhdGluZzogZnVuY3Rpb24oZSl7XHJcblx0XHRcdFx0dmFyIGluZGV4ID0gdGhpcy5nZXRJbmRleChlKTtcclxuXHRcdFx0XHR2YXIgcmF0aW5nID0gaW5kZXggKyAxO1xyXG5cclxuXHRcdFx0XHR0aGlzLmFwcGx5UmF0aW5nKHJhdGluZywgdGhpcy4kZWwpO1xyXG5cdFx0XHRcdHRoaXMuZXhlY3V0ZUNhbGxiYWNrKCByYXRpbmcsIHRoaXMuJGVsICk7XHJcblxyXG5cdFx0XHRcdGlmKHRoaXMuc2V0dGluZ3MuZGlzYWJsZUFmdGVyUmF0ZSl7XHJcblx0XHRcdFx0XHR0aGlzLiRzdGFycy5vZmYoKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHRhcHBseVJhdGluZzogZnVuY3Rpb24ocmF0aW5nKXtcclxuXHRcdFx0XHR2YXIgaW5kZXggPSByYXRpbmcgLSAxO1xyXG5cdFx0XHRcdC8vIHBhaW50IHNlbGVjdGVkIGFuZCByZW1vdmUgaG92ZXJlZCBjb2xvclxyXG5cdFx0XHRcdHRoaXMucGFpbnRTdGFycyhpbmRleCwgJ3JhdGVkJyk7XHJcblx0XHRcdFx0dGhpcy5fc3RhdGUucmF0aW5nID0gaW5kZXggKyAxO1xyXG5cdFx0XHRcdHRoaXMuX3N0YXRlLnJhdGVkID0gdHJ1ZTtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdHJlc3RvcmVTdGF0ZTogZnVuY3Rpb24oZSl7XHJcblx0XHRcdFx0dmFyIGluZGV4ID0gdGhpcy5nZXRJbmRleChlKTtcclxuXHRcdFx0XHR2YXIgcmF0aW5nID0gdGhpcy5fc3RhdGUucmF0aW5nIHx8IC0xO1xyXG5cdFx0XHRcdC8vIGRldGVybWluZSBzdGFyIGNvbG9yIGRlcGVuZGluZyBvbiBtYW51YWxseSByYXRlZFxyXG5cdFx0XHRcdHZhciBjb2xvclR5cGUgPSB0aGlzLl9zdGF0ZS5yYXRlZCA/ICdyYXRlZCcgOiAnYWN0aXZlJztcclxuXHRcdFx0XHR0aGlzLnBhaW50U3RhcnMocmF0aW5nIC0gMSwgY29sb3JUeXBlKTtcclxuXHRcdFx0XHR0aGlzLnNldHRpbmdzLm9uTGVhdmUoaW5kZXggKyAxLCB0aGlzLl9zdGF0ZS5yYXRpbmcsIHRoaXMuJGVsKTtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdGdldEluZGV4OiBmdW5jdGlvbihlKXtcclxuXHRcdFx0XHR2YXIgJHRhcmdldCA9ICQoZS5jdXJyZW50VGFyZ2V0KTtcclxuXHRcdFx0XHR2YXIgd2lkdGggPSAkdGFyZ2V0LndpZHRoKCk7XHJcblx0XHRcdFx0dmFyIHNpZGUgPSAkKGUudGFyZ2V0KS5hdHRyKCdkYXRhLXNpZGUnKTtcclxuXHRcdFx0XHR2YXIgbWluUmF0aW5nID0gdGhpcy5zZXR0aW5ncy5taW5SYXRpbmc7XHJcblxyXG5cdFx0XHRcdC8vIGhvdmVyZWQgb3V0c2lkZSB0aGUgc3RhciwgY2FsY3VsYXRlIGJ5IHBpeGVsIGluc3RlYWRcclxuXHRcdFx0XHRzaWRlID0gKCFzaWRlKSA/IHRoaXMuZ2V0T2Zmc2V0QnlQaXhlbChlLCAkdGFyZ2V0LCB3aWR0aCkgOiBzaWRlO1xyXG5cdFx0XHRcdHNpZGUgPSAodGhpcy5zZXR0aW5ncy51c2VGdWxsU3RhcnMpID8gJ3JpZ2h0JyA6IHNpZGUgO1xyXG5cclxuXHRcdFx0XHQvLyBnZXQgaW5kZXggZm9yIGhhbGYgb3Igd2hvbGUgc3RhclxyXG5cdFx0XHRcdHZhciBpbmRleCA9ICR0YXJnZXQuaW5kZXgoKSAtICgoc2lkZSA9PT0gJ2xlZnQnKSA/IDAuNSA6IDApO1xyXG5cclxuXHRcdFx0XHQvLyBwb2ludGVyIGlzIHdheSB0byB0aGUgbGVmdCwgcmF0aW5nIHNob3VsZCBiZSBub25lXHJcblx0XHRcdFx0aW5kZXggPSAoIGluZGV4IDwgMC41ICYmIChlLm9mZnNldFggPCB3aWR0aCAvIDQpICkgPyAtMSA6IGluZGV4O1xyXG5cclxuXHRcdFx0XHQvLyBmb3JjZSBtaW5pbXVtIHJhdGluZ1xyXG5cdFx0XHRcdGluZGV4ID0gKCBtaW5SYXRpbmcgJiYgbWluUmF0aW5nIDw9IHRoaXMuc2V0dGluZ3MudG90YWxTdGFycyAmJiBpbmRleCA8IG1pblJhdGluZyApID8gbWluUmF0aW5nIC0gMSA6IGluZGV4O1xyXG5cdFx0XHRcdHJldHVybiBpbmRleDtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdGdldE9mZnNldEJ5UGl4ZWw6IGZ1bmN0aW9uKGUsICR0YXJnZXQsIHdpZHRoKXtcclxuXHRcdFx0XHR2YXIgbGVmdFggPSBlLnBhZ2VYIC0gJHRhcmdldC5vZmZzZXQoKS5sZWZ0O1xyXG5cdFx0XHRcdHJldHVybiAoIGxlZnRYIDw9ICh3aWR0aCAvIDIpICYmICF0aGlzLnNldHRpbmdzLnVzZUZ1bGxTdGFycykgPyAnbGVmdCcgOiAncmlnaHQnO1xyXG5cdFx0XHR9LFxyXG5cclxuXHRcdFx0aW5pdFJhdGluZzogZnVuY3Rpb24oKXtcclxuXHRcdFx0XHR0aGlzLnBhaW50U3RhcnModGhpcy5fc3RhdGUucmF0aW5nIC0gMSwgJ2FjdGl2ZScpO1xyXG5cdFx0XHR9LFxyXG5cclxuXHRcdFx0cGFpbnRTdGFyczogZnVuY3Rpb24oZW5kSW5kZXgsIHN0YXRlQ2xhc3Mpe1xyXG5cdFx0XHRcdHZhciAkcG9seWdvbkxlZnQ7XHJcblx0XHRcdFx0dmFyICRwb2x5Z29uUmlnaHQ7XHJcblx0XHRcdFx0dmFyIGxlZnRDbGFzcztcclxuXHRcdFx0XHR2YXIgcmlnaHRDbGFzcztcclxuXHJcblx0XHRcdFx0JC5lYWNoKHRoaXMuJHN0YXJzLCBmdW5jdGlvbihpbmRleCwgc3Rhcil7XHJcblx0XHRcdFx0XHQkcG9seWdvbkxlZnQgPSAkKHN0YXIpLmZpbmQoJ1tkYXRhLXNpZGU9XCJsZWZ0XCJdJyk7XHJcblx0XHRcdFx0XHQkcG9seWdvblJpZ2h0ID0gJChzdGFyKS5maW5kKCdbZGF0YS1zaWRlPVwicmlnaHRcIl0nKTtcclxuXHRcdFx0XHRcdGxlZnRDbGFzcyA9IHJpZ2h0Q2xhc3MgPSAoaW5kZXggPD0gZW5kSW5kZXgpID8gc3RhdGVDbGFzcyA6ICdlbXB0eSc7XHJcblxyXG5cdFx0XHRcdFx0Ly8gaGFzIGFub3RoZXIgaGFsZiByYXRpbmcsIGFkZCBoYWxmIHN0YXJcclxuXHRcdFx0XHRcdGxlZnRDbGFzcyA9ICggaW5kZXggLSBlbmRJbmRleCA9PT0gMC41ICkgPyBzdGF0ZUNsYXNzIDogbGVmdENsYXNzO1xyXG5cclxuXHRcdFx0XHRcdCRwb2x5Z29uTGVmdC5hdHRyKCdjbGFzcycsICdzdmctJyAgKyBsZWZ0Q2xhc3MgKyAnLScgKyB0aGlzLl91aWQpO1xyXG5cdFx0XHRcdFx0JHBvbHlnb25SaWdodC5hdHRyKCdjbGFzcycsICdzdmctJyAgKyByaWdodENsYXNzICsgJy0nICsgdGhpcy5fdWlkKTtcclxuXHJcblx0XHRcdFx0fS5iaW5kKHRoaXMpKTtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdHJlbmRlck1hcmt1cDogZnVuY3Rpb24gKCkge1xyXG5cdFx0XHRcdHZhciBzID0gdGhpcy5zZXR0aW5ncztcclxuXHRcdFx0XHR2YXIgYmFzZVVybCA9IHMuYmFzZVVybCA/IGxvY2F0aW9uLmhyZWYuc3BsaXQoJyMnKVswXSA6ICcnO1xyXG5cclxuXHRcdFx0XHQvLyBpbmplY3QgYW4gc3ZnIG1hbnVhbGx5IHRvIGhhdmUgY29udHJvbCBvdmVyIGF0dHJpYnV0ZXNcclxuXHRcdFx0XHR2YXIgc3RhciA9ICc8ZGl2IGNsYXNzPVwianEtc3RhclwiIHN0eWxlPVwid2lkdGg6JyArIHMuc3RhclNpemUrICdweDsgIGhlaWdodDonICsgcy5zdGFyU2l6ZSArICdweDtcIj48c3ZnIHZlcnNpb249XCIxLjBcIiBjbGFzcz1cImpxLXN0YXItc3ZnXCIgc2hhcGUtcmVuZGVyaW5nPVwiZ2VvbWV0cmljUHJlY2lzaW9uXCIgeG1sbnM9XCJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2Z1wiICcgKyB0aGlzLmdldFN2Z0RpbWVuc2lvbnMocy5zdGFyU2hhcGUpICsgICcgc3Ryb2tlLXdpZHRoOicgKyBzLnN0cm9rZVdpZHRoICsgJ3B4O1wiIHhtbDpzcGFjZT1cInByZXNlcnZlXCI+PHN0eWxlIHR5cGU9XCJ0ZXh0L2Nzc1wiPi5zdmctZW1wdHktJyArIHRoaXMuX3VpZCArICd7ZmlsbDp1cmwoJyArIGJhc2VVcmwgKyAnIycgKyB0aGlzLl91aWQgKyAnX1NWR0lEXzFfKTt9LnN2Zy1ob3ZlcmVkLScgKyB0aGlzLl91aWQgKyAne2ZpbGw6dXJsKCcgKyBiYXNlVXJsICsgJyMnICsgdGhpcy5fdWlkICsgJ19TVkdJRF8yXyk7fS5zdmctYWN0aXZlLScgKyB0aGlzLl91aWQgKyAne2ZpbGw6dXJsKCcgKyBiYXNlVXJsICsgJyMnICsgdGhpcy5fdWlkICsgJ19TVkdJRF8zXyk7fS5zdmctcmF0ZWQtJyArIHRoaXMuX3VpZCArICd7ZmlsbDonICsgcy5yYXRlZENvbG9yICsgJzt9PC9zdHlsZT4nICtcclxuXHJcblx0XHRcdFx0XHR0aGlzLmdldExpbmVhckdyYWRpZW50KHRoaXMuX3VpZCArICdfU1ZHSURfMV8nLCBzLmVtcHR5Q29sb3IsIHMuZW1wdHlDb2xvciwgcy5zdGFyU2hhcGUpICtcclxuXHRcdFx0XHRcdHRoaXMuZ2V0TGluZWFyR3JhZGllbnQodGhpcy5fdWlkICsgJ19TVkdJRF8yXycsIHMuaG92ZXJDb2xvciwgcy5ob3ZlckNvbG9yLCBzLnN0YXJTaGFwZSkgK1xyXG5cdFx0XHRcdFx0dGhpcy5nZXRMaW5lYXJHcmFkaWVudCh0aGlzLl91aWQgKyAnX1NWR0lEXzNfJywgcy5zdGFyR3JhZGllbnQuc3RhcnQsIHMuc3RhckdyYWRpZW50LmVuZCwgcy5zdGFyU2hhcGUpICtcclxuXHRcdFx0XHRcdHRoaXMuZ2V0VmVjdG9yUGF0aCh0aGlzLl91aWQsIHtcclxuXHRcdFx0XHRcdFx0c3RhclNoYXBlOiBzLnN0YXJTaGFwZSxcclxuXHRcdFx0XHRcdFx0c3Ryb2tlV2lkdGg6IHMuc3Ryb2tlV2lkdGgsXHJcblx0XHRcdFx0XHRcdHN0cm9rZUNvbG9yOiBzLnN0cm9rZUNvbG9yXHJcblx0XHRcdFx0XHR9ICkgK1xyXG5cdFx0XHRcdFx0Jzwvc3ZnPjwvZGl2Pic7XHJcblxyXG5cdFx0XHRcdC8vIGluamVjdCBzdmcgbWFya3VwXHJcblx0XHRcdFx0dmFyIHN0YXJzTWFya3VwID0gJyc7XHJcblx0XHRcdFx0Zm9yKCB2YXIgaSA9IDA7IGkgPCBzLnRvdGFsU3RhcnM7IGkrKyl7XHJcblx0XHRcdFx0XHRzdGFyc01hcmt1cCArPSBzdGFyO1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0XHR0aGlzLiRlbC5hcHBlbmQoc3RhcnNNYXJrdXApO1xyXG5cdFx0XHRcdHRoaXMuJHN0YXJzID0gdGhpcy4kZWwuZmluZCgnLmpxLXN0YXInKTtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdGdldFZlY3RvclBhdGg6IGZ1bmN0aW9uKGlkLCBhdHRycyl7XHJcblx0XHRcdFx0cmV0dXJuIChhdHRycy5zdGFyU2hhcGUgPT09ICdyb3VuZGVkJykgP1xyXG5cdFx0XHRcdFx0dGhpcy5nZXRSb3VuZGVkVmVjdG9yUGF0aChpZCwgYXR0cnMpIDogdGhpcy5nZXRTcGlrZVZlY3RvclBhdGgoaWQsIGF0dHJzKTtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdGdldFNwaWtlVmVjdG9yUGF0aDogZnVuY3Rpb24oaWQsIGF0dHJzKXtcclxuXHRcdFx0XHRyZXR1cm4gJzxwb2x5Z29uIGRhdGEtc2lkZT1cImNlbnRlclwiIGNsYXNzPVwic3ZnLWVtcHR5LScgKyBpZCArICdcIiBwb2ludHM9XCIyODEuMSwxMjkuOCAzNjQsNTUuNyAyNTUuNSw0Ni44IDIxNCwtNTkgMTcyLjUsNDYuOCA2NCw1NS40IDE0Ni44LDEyOS43IDEyMS4xLDI0MSAyMTIuOSwxODEuMSAyMTMuOSwxODEgMzA2LjUsMjQxIFwiIHN0eWxlPVwiZmlsbDogdHJhbnNwYXJlbnQ7IHN0cm9rZTogJyArIGF0dHJzLnN0cm9rZUNvbG9yICsgJztcIiAvPicgK1xyXG5cdFx0XHRcdFx0Jzxwb2x5Z29uIGRhdGEtc2lkZT1cImxlZnRcIiBjbGFzcz1cInN2Zy1lbXB0eS0nICsgaWQgKyAnXCIgcG9pbnRzPVwiMjgxLjEsMTI5LjggMzY0LDU1LjcgMjU1LjUsNDYuOCAyMTQsLTU5IDE3Mi41LDQ2LjggNjQsNTUuNCAxNDYuOCwxMjkuNyAxMjEuMSwyNDEgMjEzLjksMTgxLjEgMjEzLjksMTgxIDMwNi41LDI0MSBcIiBzdHlsZT1cInN0cm9rZS1vcGFjaXR5OiAwO1wiIC8+JyArXHJcblx0XHRcdFx0XHQnPHBvbHlnb24gZGF0YS1zaWRlPVwicmlnaHRcIiBjbGFzcz1cInN2Zy1lbXB0eS0nICsgaWQgKyAnXCIgcG9pbnRzPVwiMzY0LDU1LjcgMjU1LjUsNDYuOCAyMTQsLTU5IDIxMy45LDE4MSAzMDYuNSwyNDEgMjgxLjEsMTI5LjggXCIgc3R5bGU9XCJzdHJva2Utb3BhY2l0eTogMDtcIiAvPic7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHRnZXRSb3VuZGVkVmVjdG9yUGF0aDogZnVuY3Rpb24oaWQsIGF0dHJzKXtcclxuXHRcdFx0XHR2YXIgZnVsbFBvaW50cyA9ICdNNTIwLjksMzM2LjVjLTMuOC0xMS44LTE0LjItMjAuNS0yNi41LTIyLjJsLTE0MC45LTIwLjVsLTYzLTEyNy43IGMtNS41LTExLjItMTYuOC0xOC4yLTI5LjMtMTguMmMtMTIuNSwwLTIzLjgsNy0yOS4zLDE4LjJsLTYzLDEyNy43TDI4LDMxNC4yQzE1LjcsMzE2LDUuNCwzMjQuNywxLjYsMzM2LjVTMSwzNjEuMyw5LjksMzcwIGwxMDIsOTkuNGwtMjQsMTQwLjNjLTIuMSwxMi4zLDIuOSwyNC42LDEzLDMyYzUuNyw0LjIsMTIuNCw2LjIsMTkuMiw2LjJjNS4yLDAsMTAuNS0xLjIsMTUuMi0zLjhsMTI2LTY2LjNsMTI2LDY2LjIgYzQuOCwyLjYsMTAsMy44LDE1LjIsMy44YzYuOCwwLDEzLjUtMi4xLDE5LjItNi4yYzEwLjEtNy4zLDE1LjEtMTkuNywxMy0zMmwtMjQtMTQwLjNsMTAyLTk5LjQgQzUyMS42LDM2MS4zLDUyNC44LDM0OC4zLDUyMC45LDMzNi41eic7XHJcblxyXG5cdFx0XHRcdHJldHVybiAnPHBhdGggZGF0YS1zaWRlPVwiY2VudGVyXCIgY2xhc3M9XCJzdmctZW1wdHktJyArIGlkICsgJ1wiIGQ9XCInICsgZnVsbFBvaW50cyArICdcIiBzdHlsZT1cInN0cm9rZTogJyArIGF0dHJzLnN0cm9rZUNvbG9yICsgJzsgZmlsbDogdHJhbnNwYXJlbnQ7IFwiIC8+PHBhdGggZGF0YS1zaWRlPVwicmlnaHRcIiBjbGFzcz1cInN2Zy1lbXB0eS0nICsgaWQgKyAnXCIgZD1cIicgKyBmdWxsUG9pbnRzICsgJ1wiIHN0eWxlPVwic3Ryb2tlLW9wYWNpdHk6IDA7XCIgLz48cGF0aCBkYXRhLXNpZGU9XCJsZWZ0XCIgY2xhc3M9XCJzdmctZW1wdHktJyArIGlkICsgJ1wiIGQ9XCJNMTIxLDY0OGMtNy4zLDAtMTQuMS0yLjItMTkuOC02LjRjLTEwLjQtNy42LTE1LjYtMjAuMy0xMy40LTMzbDI0LTEzOS45bC0xMDEuNi05OSBjLTkuMS04LjktMTIuNC0yMi40LTguNi0zNC41YzMuOS0xMi4xLDE0LjYtMjEuMSwyNy4yLTIzbDE0MC40LTIwLjRMMjMyLDE2NC42YzUuNy0xMS42LDE3LjMtMTguOCwzMC4yLTE2LjhjMC42LDAsMSwwLjQsMSwxIHY0MzAuMWMwLDAuNC0wLjIsMC43LTAuNSwwLjlsLTEyNiw2Ni4zQzEzMiw2NDYuNiwxMjYuNiw2NDgsMTIxLDY0OHpcIiBzdHlsZT1cInN0cm9rZTogJyArIGF0dHJzLnN0cm9rZUNvbG9yICsgJzsgc3Ryb2tlLW9wYWNpdHk6IDA7XCIgLz4nO1xyXG5cdFx0XHR9LFxyXG5cclxuXHRcdFx0Z2V0U3ZnRGltZW5zaW9uczogZnVuY3Rpb24oc3RhclNoYXBlKXtcclxuXHRcdFx0XHRyZXR1cm4gKHN0YXJTaGFwZSA9PT0gJ3JvdW5kZWQnKSA/ICd3aWR0aD1cIjU1MHB4XCIgaGVpZ2h0PVwiNTAwLjJweFwiIHZpZXdCb3g9XCIwIDE0Ni44IDU1MCA1MDAuMlwiIHN0eWxlPVwiZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1NTAgNTAwLjI7JyA6ICd4PVwiMHB4XCIgeT1cIjBweFwiIHdpZHRoPVwiMzA1cHhcIiBoZWlnaHQ9XCIzMDVweFwiIHZpZXdCb3g9XCI2MCAtNjIgMzA5IDMwOVwiIHN0eWxlPVwiZW5hYmxlLWJhY2tncm91bmQ6bmV3IDY0IC01OSAzMDUgMzA1Oyc7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHRnZXRMaW5lYXJHcmFkaWVudDogZnVuY3Rpb24oaWQsIHN0YXJ0Q29sb3IsIGVuZENvbG9yLCBzdGFyU2hhcGUpe1xyXG5cdFx0XHRcdHZhciBoZWlnaHQgPSAoc3RhclNoYXBlID09PSAncm91bmRlZCcpID8gNTAwIDogMjUwO1xyXG5cdFx0XHRcdHJldHVybiAnPGxpbmVhckdyYWRpZW50IGlkPVwiJyArIGlkICsgJ1wiIGdyYWRpZW50VW5pdHM9XCJ1c2VyU3BhY2VPblVzZVwiIHgxPVwiMFwiIHkxPVwiLTUwXCIgeDI9XCIwXCIgeTI9XCInICsgaGVpZ2h0ICsgJ1wiPjxzdG9wICBvZmZzZXQ9XCIwXCIgc3R5bGU9XCJzdG9wLWNvbG9yOicgKyBzdGFydENvbG9yICsgJ1wiLz48c3RvcCAgb2Zmc2V0PVwiMVwiIHN0eWxlPVwic3RvcC1jb2xvcjonICsgZW5kQ29sb3IgKyAnXCIvPiA8L2xpbmVhckdyYWRpZW50Pic7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHRleGVjdXRlQ2FsbGJhY2s6IGZ1bmN0aW9uKHJhdGluZywgJGVsKXtcclxuXHRcdFx0XHR2YXIgY2FsbGJhY2sgPSB0aGlzLnNldHRpbmdzLmNhbGxiYWNrO1xyXG5cdFx0XHRcdGNhbGxiYWNrKHJhdGluZywgJGVsKTtcclxuXHRcdFx0fVxyXG5cclxuXHRcdH07XHJcblxyXG5cdFx0dmFyIHB1YmxpY01ldGhvZHMgPSB7XHJcblxyXG5cdFx0XHR1bmxvYWQ6IGZ1bmN0aW9uKCkge1xyXG5cdFx0XHRcdHZhciBfbmFtZSA9ICdwbHVnaW5fJyArIHBsdWdpbk5hbWU7XHJcblx0XHRcdFx0dmFyICRlbCA9ICQodGhpcyk7XHJcblx0XHRcdFx0dmFyICRzdGFyU2V0ID0gJGVsLmRhdGEoX25hbWUpLiRzdGFycztcclxuXHRcdFx0XHQkc3RhclNldC5vZmYoKTtcclxuXHRcdFx0XHQkZWwucmVtb3ZlRGF0YShfbmFtZSkucmVtb3ZlKCk7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHRzZXRSYXRpbmc6IGZ1bmN0aW9uKHJhdGluZywgcm91bmQpIHtcclxuXHRcdFx0XHR2YXIgX25hbWUgPSAncGx1Z2luXycgKyBwbHVnaW5OYW1lO1xyXG5cdFx0XHRcdHZhciAkZWwgPSAkKHRoaXMpO1xyXG5cdFx0XHRcdHZhciAkcGx1Z2luID0gJGVsLmRhdGEoX25hbWUpO1xyXG5cdFx0XHRcdGlmKCByYXRpbmcgPiAkcGx1Z2luLnNldHRpbmdzLnRvdGFsU3RhcnMgfHwgcmF0aW5nIDwgMCApIHsgcmV0dXJuOyB9XHJcblx0XHRcdFx0aWYoIHJvdW5kICl7XHJcblx0XHRcdFx0XHRyYXRpbmcgPSBNYXRoLnJvdW5kKHJhdGluZyk7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHRcdCRwbHVnaW4uYXBwbHlSYXRpbmcocmF0aW5nKTtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdGdldFJhdGluZzogZnVuY3Rpb24oKSB7XHJcblx0XHRcdFx0dmFyIF9uYW1lID0gJ3BsdWdpbl8nICsgcGx1Z2luTmFtZTtcclxuXHRcdFx0XHR2YXIgJGVsID0gJCh0aGlzKTtcclxuXHRcdFx0XHR2YXIgJHN0YXJTZXQgPSAkZWwuZGF0YShfbmFtZSk7XHJcblx0XHRcdFx0cmV0dXJuICRzdGFyU2V0Ll9zdGF0ZS5yYXRpbmc7XHJcblx0XHRcdH0sXHJcblxyXG5cdFx0XHRyZXNpemU6IGZ1bmN0aW9uKG5ld1NpemUpIHtcclxuXHRcdFx0XHR2YXIgX25hbWUgPSAncGx1Z2luXycgKyBwbHVnaW5OYW1lO1xyXG5cdFx0XHRcdHZhciAkZWwgPSAkKHRoaXMpO1xyXG5cdFx0XHRcdHZhciAkc3RhclNldCA9ICRlbC5kYXRhKF9uYW1lKTtcclxuXHRcdFx0XHR2YXIgJHN0YXJzID0gJHN0YXJTZXQuJHN0YXJzO1xyXG5cclxuXHRcdFx0XHRpZihuZXdTaXplIDw9IDEgfHwgbmV3U2l6ZSA+IDIwMCkge1xyXG5cdFx0XHRcdFx0Y29uc29sZS5sb2coJ3N0YXIgc2l6ZSBvdXQgb2YgYm91bmRzJyk7XHJcblx0XHRcdFx0XHRyZXR1cm47XHJcblx0XHRcdFx0fVxyXG5cclxuXHRcdFx0XHQkc3RhcnMgPSBBcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbCgkc3RhcnMpO1xyXG5cdFx0XHRcdCRzdGFycy5mb3JFYWNoKGZ1bmN0aW9uKHN0YXIpe1xyXG5cdFx0XHRcdFx0JChzdGFyKS5jc3Moe1xyXG5cdFx0XHRcdFx0XHQnd2lkdGgnOiBuZXdTaXplICsgJ3B4JyxcclxuXHRcdFx0XHRcdFx0J2hlaWdodCc6IG5ld1NpemUgKyAncHgnXHJcblx0XHRcdFx0XHR9KTtcclxuXHRcdFx0XHR9KTtcclxuXHRcdFx0fSxcclxuXHJcblx0XHRcdHNldFJlYWRPbmx5OiBmdW5jdGlvbihmbGFnKSB7XHJcblx0XHRcdFx0dmFyIF9uYW1lID0gJ3BsdWdpbl8nICsgcGx1Z2luTmFtZTtcclxuXHRcdFx0XHR2YXIgJGVsID0gJCh0aGlzKTtcclxuXHRcdFx0XHR2YXIgJHBsdWdpbiA9ICRlbC5kYXRhKF9uYW1lKTtcclxuXHRcdFx0XHRpZihmbGFnID09PSB0cnVlKXtcclxuXHRcdFx0XHRcdCRwbHVnaW4uJHN0YXJzLm9mZignbW91c2VvdmVyIG1vdXNlb3V0IGNsaWNrJyk7XHJcblx0XHRcdFx0fSBlbHNlIHtcclxuXHRcdFx0XHRcdCRwbHVnaW4uc2V0dGluZ3MucmVhZE9ubHkgPSBmYWxzZTtcclxuXHRcdFx0XHRcdCRwbHVnaW4uYWRkTGlzdGVuZXJzKCk7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9XHJcblxyXG5cdFx0fTtcclxuXHJcblxyXG5cdFx0Ly8gQXZvaWQgUGx1Z2luLnByb3RvdHlwZSBjb25mbGljdHNcclxuXHRcdCQuZXh0ZW5kKFBsdWdpbi5wcm90b3R5cGUsIG1ldGhvZHMpO1xyXG5cclxuXHRcdCQuZm5bIHBsdWdpbk5hbWUgXSA9IGZ1bmN0aW9uICggb3B0aW9ucyApIHtcclxuXHJcblx0XHRcdC8vIGlmIG9wdGlvbnMgaXMgYSBwdWJsaWMgbWV0aG9kXHJcblx0XHRcdGlmKCAhJC5pc1BsYWluT2JqZWN0KG9wdGlvbnMpICl7XHJcblx0XHRcdFx0aWYoIHB1YmxpY01ldGhvZHMuaGFzT3duUHJvcGVydHkob3B0aW9ucykgKXtcclxuXHRcdFx0XHRcdHJldHVybiBwdWJsaWNNZXRob2RzW29wdGlvbnNdLmFwcGx5KHRoaXMsIEFycmF5LnByb3RvdHlwZS5zbGljZS5jYWxsKGFyZ3VtZW50cywgMSkpO1xyXG5cdFx0XHRcdH0gZWxzZSB7XHJcblx0XHRcdFx0XHQkLmVycm9yKCdNZXRob2QgJysgb3B0aW9ucyArJyBkb2VzIG5vdCBleGlzdCBvbiAnICsgcGx1Z2luTmFtZSArICcuanMnKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHJcblx0XHRcdHJldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKSB7XHJcblx0XHRcdFx0Ly8gcHJldmVudGluZyBhZ2FpbnN0IG11bHRpcGxlIGluc3RhbnRpYXRpb25zXHJcblx0XHRcdFx0aWYgKCAhJC5kYXRhKCB0aGlzLCAncGx1Z2luXycgKyBwbHVnaW5OYW1lICkgKSB7XHJcblx0XHRcdFx0XHQkLmRhdGEoIHRoaXMsICdwbHVnaW5fJyArIHBsdWdpbk5hbWUsIG5ldyBQbHVnaW4oIHRoaXMsIG9wdGlvbnMgKSApO1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSk7XHJcblx0XHR9O1xyXG5cclxuXHR9KSggalF1ZXJ5LCB3aW5kb3csIGRvY3VtZW50ICk7XHJcblxyXG5cclxuXHQkKFwiLm15LXJhdGluZ1wiKS5zdGFyUmF0aW5nKHtcclxuXHRcdGluaXRpYWxSYXRpbmc6ICQoXCIjcG90ZW50aWFsX2xldmVsXCIpLnZhbCgpIC8gMixcclxuXHRcdHN0cm9rZUNvbG9yOiAnZ29sZCcsXHJcblx0XHRzdHJva2VXaWR0aDogMTAsXHJcblx0XHRzdGFyU2l6ZTogMjUsXHJcblx0XHRyYXRlZENvbG9yOiAnZ29sZCcsXHJcblx0XHRjYWxsYmFjazogZnVuY3Rpb24gKGN1cnJlbnRSYXRpbmcsICRlbCkge1xyXG5cdFx0XHR2YXIgZGF0YSA9IHtcclxuXHRcdFx0XHRwb3RlbnRpYWxfbGV2ZWw6IGN1cnJlbnRSYXRpbmcgKiAyXHJcblx0XHRcdH07XHJcblx0XHRcdHZhciB1cmwgPSBcInBvdGVudGlhbC9cIiArICQoXCIjaWRDb21wYW55XCIpLnZhbCgpO1xyXG5cdFx0XHQkLnBvc3QodXJsLCBkYXRhLCBmdW5jdGlvbiAoZGF0YSkge1xyXG5cdFx0XHRcdGlmIChkYXRhLnJldG91ciA9PSB0cnVlKSB7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9KTtcclxuXHRcdH1cclxuXHR9KTtcclxuXHJcblx0JChkb2N1bWVudCkub24oJ2NsaWNrJywnLm15LXJhdGluZycsZnVuY3Rpb24gKCkge1xyXG5cdFx0Y29uc29sZS5sb2coJCh0aGlzKS5zdGFyUmF0aW5nKCdnZXRSYXRpbmcnKSk7XHJcblx0fSk7XHJcblxyXG4gICAgJChcIi5nZXN0aW9uX2Zvcm11bGFpcmUgPiAucm93ID4gZGl2XCIpLmFkZENsYXNzKFwiY29sLWxnLThcIik7XHJcbiAgICAkKFwiLmdlc3Rpb25fZm9ybXVsYWlyZSA+IC5yb3cgPiBwXCIpLmFkZENsYXNzKFwiY29sLWxnLTRcIik7XHJcblxyXG4gICAgJChcIi5nZXN0aW9uLWZvcm11bGFpcmUtY2hlY2tib3gtZGl2ID4gZGl2XCIpLmFkZENsYXNzKFwiY3VzdG9tLWNvbnRyb2wgY3VzdG9tLWNoZWNrYm94XCIpO1xyXG5cclxuICAgIC8vUGVybWV0IGRlIHJlbmRyZSBkeW5hbWlxdWUgbGEgc2VsZWN0aW9uIGRlcyBjaGVja2JveCBkYW5zIGxlIGZvcm11bGFpcmUgZCdvcMOpcmF0aW9uc1xyXG4gICAgJChcIi5nZXN0aW9uLWZvcm11bGFpcmUtY2hlY2tib3gtZGl2XCIpLm9uKFwiY2xpY2tcIiwgXCI6Y2hlY2tib3hcIiwgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIGlmICgkKHRoaXMpLmlzKFwiOmNoZWNrZWRcIikpIHtcclxuICAgICAgICAgICAgc3dpdGNoICgkKHRoaXMpLnZhbCgpKSB7XHJcbiAgICAgICAgICAgICAgICBjYXNlIFwiMlwiOlxyXG4gICAgICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkucHJldigpLmNoaWxkcmVuKFwiaW5wdXRcIikucHJvcChcImNoZWNrZWRcIiwgdHJ1ZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgYnJlYWs7XHJcbiAgICAgICAgICAgICAgICBjYXNlIFwiM1wiOlxyXG4gICAgICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkucHJldigpLmNoaWxkcmVuKFwiaW5wdXRcIikucHJvcChcImNoZWNrZWRcIiwgdHJ1ZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5wcmV2KCkucHJldigpLmNoaWxkcmVuKFwiaW5wdXRcIikucHJvcChcImNoZWNrZWRcIiwgdHJ1ZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgYnJlYWs7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgaWYgKCEkKHRoaXMpLmlzKFwiOmNoZWNrZWRcIikpIHtcclxuICAgICAgICAgICAgc3dpdGNoICgkKHRoaXMpLnZhbCgpKSB7XHJcbiAgICAgICAgICAgICAgICBjYXNlIFwiMlwiOlxyXG4gICAgICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkubmV4dCgpLmNoaWxkcmVuKFwiaW5wdXRcIikucHJvcChcImNoZWNrZWRcIiwgZmFsc2UpO1xyXG4gICAgICAgICAgICAgICAgICAgIGJyZWFrO1xyXG4gICAgICAgICAgICAgICAgY2FzZSBcIjFcIjpcclxuICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLm5leHQoKS5jaGlsZHJlbihcImlucHV0XCIpLnByb3AoXCJjaGVja2VkXCIsIGZhbHNlKTtcclxuICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLm5leHQoKS5uZXh0KCkuY2hpbGRyZW4oXCJpbnB1dFwiKS5wcm9wKFwiY2hlY2tlZFwiLCBmYWxzZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgYnJlYWs7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcblxyXG4gICAgfSlcclxuICAgIFxyXG4gICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cclxuICAgIC8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXHJcbn0gKTtcclxuIl0sInNvdXJjZVJvb3QiOiIifQ==