$(document).ready( function () {
	$("#search-filter").on("keyup", function() {

	    var value = $(this).val().toLowerCase();
	    $("#myTableBody tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
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
	$( "tbody td" ).click(function() {
		var UrlLink = $(this).find("a").attr('href');
		$(location).attr('href', UrlLink);
	})

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
	$("[data-toggle=tooltip]").tooltip();
	// --------------------------------------------------------------

	$.fn.pageMe = function(opts){
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

		if (typeof settings.childSelector!="undefined") {
			children = listElement.find(settings.childSelector);
		}

		if (typeof settings.pagerSelector!="undefined") {
			pager = $(settings.pagerSelector);
		}

		var numItems = children.length;
		var numPages = Math.ceil(numItems/perPage);

		pager.data("curr",0);

		if (settings.showPrevNext){
			$('<li class="page-item prev-page"><a href="#" class="prev-link"><i class="fas fa-arrow-left"></i></a></li>').appendTo(pager);
		}

		var curr = 0;
		while(numPages > curr && (settings.hidePageNumbers==false)){
			$('<li class="page-item"><a href="#" class="link-page">'+(curr+1)+'</a></li>').appendTo(pager);
			curr++;
		}

		if (settings.showPrevNext){
			$('<li class="page-item next-page"><a href="#" class="next-link"><i class="fas fa-arrow-right"></i></a></li>').appendTo(pager);
		}

		var nbPage = $(".pager li").length - 2;

		pager.find('.link-page:first').addClass('active');
		/*pager.find('.prev-link').hide();*/
		pager.find('.prev-link').addClass("prev-link-diseable");
		//pager.find('.prev-link').removeClass("prev-link");
		if (numPages<=1) {
			/*pager.find('.next-link').hide();*/
			pager.find('.next-link').addClass("next-link-diseable");
			pager.find('.next-link').removeClass("next-link");
		}

		if (nbPage === 2) {
			$(".table-after-pagination").addClass("table-after-pagination-2-width");
			$(".table-after-pagination").removeClass("table-after-pagination-3-width");
			$(".table-after-pagination").removeClass("table-after-pagination-4-width");
			$(".table-after-pagination").removeClass("table-after-pagination-5-width");
		}
		else if (nbPage === 3) {
			$(".table-after-pagination").addClass("table-after-pagination-3-width");
			$(".table-after-pagination").removeClass("table-after-pagination-2-width");
			$(".table-after-pagination").removeClass("table-after-pagination-4-width");
			$(".table-after-pagination").removeClass("table-after-pagination-5-width");
		}
		else if (nbPage === 4) {
			$(".table-after-pagination").addClass("table-after-pagination-4-width");
			$(".table-after-pagination").removeClass("table-after-pagination-2-width");
			$(".table-after-pagination").removeClass("table-after-pagination-3-width");
			$(".table-after-pagination").removeClass("table-after-pagination-5-width");
		}
		else if (nbPage === 5) {
			$(".table-after-pagination").addClass("table-after-pagination-5-width");
			$(".table-after-pagination").removeClass("table-after-pagination-2-width");
			$(".table-after-pagination").removeClass("table-after-pagination-3-width");
			$(".table-after-pagination").removeClass("table-after-pagination-4-width");
		}

		pager.children().eq(1).addClass("active");

		children.hide();
		children.slice(0, perPage).show();

		pager.find('li .link-page').click(function(){
			var clickedPage = $(this).html().valueOf()-1;
			goTo(clickedPage,perPage);
			return false;
		});
		pager.find('li .prev-link').click(function(){
			previous();
			return false;
		});
		pager.find('li .next-link').click(function(){
			next();
			return false;
		});

		function previous(){
			var goToPage = parseInt(pager.data("curr")) - 1;
			goTo(goToPage);
		}

		function next(){
			goToPage = parseInt(pager.data("curr")) + 1;
			goTo(goToPage);
		}

		function goTo(page){
			var startAt = page * perPage,
				endOn = startAt + perPage;

			children.css('display','none').slice(startAt, endOn).show();

			if (page>=1) {
				/*pager.find('.prev-link').show();*/
				pager.find('.prev-link-diseable').addClass("prev-link");
				pager.find('.prev-link-diseable').removeClass("prev-link-diseable");
			}
			else {
				/*pager.find('.prev-link').hide();*/
				pager.find('.prev-link').addClass("prev-link-diseable");
				pager.find('.prev-link').removeClass("prev-link");
			}

			if (page<(numPages-1)) {
				/*pager.find('.next-link').show();*/
				pager.find('.next-link-diseable').addClass("next-link");
				pager.find('.next-link-diseable').removeClass("next-link-diseable");
			}
			else {
				/*pager.find('.next-link').hide();*/
				pager.find('.next-link').addClass("next-link-diseable");
				pager.find('.next-link').removeClass("next-link");
			}

			pager.data("curr",page);
			pager.children().removeClass("active");
			pager.children().eq(page+1).addClass("active");
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

	$('#myTableBody').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:5});
	$(function () {

		$('[data-toggle="popover"]').popover({html:true,trigger: 'hover'})
	})
  
	// ---------- Opération -------------
	// --------------------------------------------------------------

	/*
 *  jQuery StarRatingSvg v1.2.0
 *
 *  http://github.com/nashio/star-rating-svg
 *  Author: Ignacio Chavez
 *  hello@ignaciochavez.com
 *  Licensed under MIT
 */

	;(function ( $, window, document, undefined ) {

		'use strict';

		// Create the defaults once
		var pluginName = 'starRating';
		var noop = function(){};
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
		};

		// The actual plugin constructor
		var Plugin = function( element, options ) {
			var _rating;
			var newRating;
			var roundFn;

			this.element = element;
			this.$el = $(element);
			this.settings = $.extend( {}, defaults, options );

			// grab rating if defined on the element
			_rating = this.$el.data('rating') || this.settings.initialRating;

			// round to the nearest half
			roundFn = this.settings.forceRoundUp ? Math.ceil : Math.round;
			newRating = (roundFn( _rating * 2 ) / 2).toFixed(1);
			this._state = {
				rating: newRating
			};

			// create unique id for stars
			this._uid = Math.floor( Math.random() * 999 );

			// override gradient if not used
			if( !options.starGradient && !this.settings.useGradient ){
				this.settings.starGradient.start = this.settings.starGradient.end = this.settings.activeColor;
			}

			this._defaults = defaults;
			this._name = pluginName;
			this.init();
		};

		var methods = {
			init: function () {
				this.renderMarkup();
				this.addListeners();
				this.initRating();
			},

			addListeners: function(){
				if( this.settings.readOnly ){ return; }
				this.$stars.on('mouseover', this.hoverRating.bind(this));
				this.$stars.on('mouseout', this.restoreState.bind(this));
				this.$stars.on('click', this.handleRating.bind(this));
			},

			// apply styles to hovered stars
			hoverRating: function(e){
				var index = this.getIndex(e);
				this.paintStars(index, 'hovered');
				this.settings.onHover(index + 1, this._state.rating, this.$el);
			},

			// clicked on a rate, apply style and state
			handleRating: function(e){
				var index = this.getIndex(e);
				var rating = index + 1;

				this.applyRating(rating, this.$el);
				this.executeCallback( rating, this.$el );

				if(this.settings.disableAfterRate){
					this.$stars.off();
				}
			},

			applyRating: function(rating){
				var index = rating - 1;
				// paint selected and remove hovered color
				this.paintStars(index, 'rated');
				this._state.rating = index + 1;
				this._state.rated = true;
			},

			restoreState: function(e){
				var index = this.getIndex(e);
				var rating = this._state.rating || -1;
				// determine star color depending on manually rated
				var colorType = this._state.rated ? 'rated' : 'active';
				this.paintStars(rating - 1, colorType);
				this.settings.onLeave(index + 1, this._state.rating, this.$el);
			},

			getIndex: function(e){
				var $target = $(e.currentTarget);
				var width = $target.width();
				var side = $(e.target).attr('data-side');
				var minRating = this.settings.minRating;

				// hovered outside the star, calculate by pixel instead
				side = (!side) ? this.getOffsetByPixel(e, $target, width) : side;
				side = (this.settings.useFullStars) ? 'right' : side ;

				// get index for half or whole star
				var index = $target.index() - ((side === 'left') ? 0.5 : 0);

				// pointer is way to the left, rating should be none
				index = ( index < 0.5 && (e.offsetX < width / 4) ) ? -1 : index;

				// force minimum rating
				index = ( minRating && minRating <= this.settings.totalStars && index < minRating ) ? minRating - 1 : index;
				return index;
			},

			getOffsetByPixel: function(e, $target, width){
				var leftX = e.pageX - $target.offset().left;
				return ( leftX <= (width / 2) && !this.settings.useFullStars) ? 'left' : 'right';
			},

			initRating: function(){
				this.paintStars(this._state.rating - 1, 'active');
			},

			paintStars: function(endIndex, stateClass){
				var $polygonLeft;
				var $polygonRight;
				var leftClass;
				var rightClass;

				$.each(this.$stars, function(index, star){
					$polygonLeft = $(star).find('[data-side="left"]');
					$polygonRight = $(star).find('[data-side="right"]');
					leftClass = rightClass = (index <= endIndex) ? stateClass : 'empty';

					// has another half rating, add half star
					leftClass = ( index - endIndex === 0.5 ) ? stateClass : leftClass;

					$polygonLeft.attr('class', 'svg-'  + leftClass + '-' + this._uid);
					$polygonRight.attr('class', 'svg-'  + rightClass + '-' + this._uid);

				}.bind(this));
			},

			renderMarkup: function () {
				var s = this.settings;
				var baseUrl = s.baseUrl ? location.href.split('#')[0] : '';

				// inject an svg manually to have control over attributes
				var star = '<div class="jq-star" style="width:' + s.starSize+ 'px;  height:' + s.starSize + 'px;"><svg version="1.0" class="jq-star-svg" shape-rendering="geometricPrecision" xmlns="http://www.w3.org/2000/svg" ' + this.getSvgDimensions(s.starShape) +  ' stroke-width:' + s.strokeWidth + 'px;" xml:space="preserve"><style type="text/css">.svg-empty-' + this._uid + '{fill:url(' + baseUrl + '#' + this._uid + '_SVGID_1_);}.svg-hovered-' + this._uid + '{fill:url(' + baseUrl + '#' + this._uid + '_SVGID_2_);}.svg-active-' + this._uid + '{fill:url(' + baseUrl + '#' + this._uid + '_SVGID_3_);}.svg-rated-' + this._uid + '{fill:' + s.ratedColor + ';}</style>' +

					this.getLinearGradient(this._uid + '_SVGID_1_', s.emptyColor, s.emptyColor, s.starShape) +
					this.getLinearGradient(this._uid + '_SVGID_2_', s.hoverColor, s.hoverColor, s.starShape) +
					this.getLinearGradient(this._uid + '_SVGID_3_', s.starGradient.start, s.starGradient.end, s.starShape) +
					this.getVectorPath(this._uid, {
						starShape: s.starShape,
						strokeWidth: s.strokeWidth,
						strokeColor: s.strokeColor
					} ) +
					'</svg></div>';

				// inject svg markup
				var starsMarkup = '';
				for( var i = 0; i < s.totalStars; i++){
					starsMarkup += star;
				}
				this.$el.append(starsMarkup);
				this.$stars = this.$el.find('.jq-star');
			},

			getVectorPath: function(id, attrs){
				return (attrs.starShape === 'rounded') ?
					this.getRoundedVectorPath(id, attrs) : this.getSpikeVectorPath(id, attrs);
			},

			getSpikeVectorPath: function(id, attrs){
				return '<polygon data-side="center" class="svg-empty-' + id + '" points="281.1,129.8 364,55.7 255.5,46.8 214,-59 172.5,46.8 64,55.4 146.8,129.7 121.1,241 212.9,181.1 213.9,181 306.5,241 " style="fill: transparent; stroke: ' + attrs.strokeColor + ';" />' +
					'<polygon data-side="left" class="svg-empty-' + id + '" points="281.1,129.8 364,55.7 255.5,46.8 214,-59 172.5,46.8 64,55.4 146.8,129.7 121.1,241 213.9,181.1 213.9,181 306.5,241 " style="stroke-opacity: 0;" />' +
					'<polygon data-side="right" class="svg-empty-' + id + '" points="364,55.7 255.5,46.8 214,-59 213.9,181 306.5,241 281.1,129.8 " style="stroke-opacity: 0;" />';
			},

			getRoundedVectorPath: function(id, attrs){
				var fullPoints = 'M520.9,336.5c-3.8-11.8-14.2-20.5-26.5-22.2l-140.9-20.5l-63-127.7 c-5.5-11.2-16.8-18.2-29.3-18.2c-12.5,0-23.8,7-29.3,18.2l-63,127.7L28,314.2C15.7,316,5.4,324.7,1.6,336.5S1,361.3,9.9,370 l102,99.4l-24,140.3c-2.1,12.3,2.9,24.6,13,32c5.7,4.2,12.4,6.2,19.2,6.2c5.2,0,10.5-1.2,15.2-3.8l126-66.3l126,66.2 c4.8,2.6,10,3.8,15.2,3.8c6.8,0,13.5-2.1,19.2-6.2c10.1-7.3,15.1-19.7,13-32l-24-140.3l102-99.4 C521.6,361.3,524.8,348.3,520.9,336.5z';

				return '<path data-side="center" class="svg-empty-' + id + '" d="' + fullPoints + '" style="stroke: ' + attrs.strokeColor + '; fill: transparent; " /><path data-side="right" class="svg-empty-' + id + '" d="' + fullPoints + '" style="stroke-opacity: 0;" /><path data-side="left" class="svg-empty-' + id + '" d="M121,648c-7.3,0-14.1-2.2-19.8-6.4c-10.4-7.6-15.6-20.3-13.4-33l24-139.9l-101.6-99 c-9.1-8.9-12.4-22.4-8.6-34.5c3.9-12.1,14.6-21.1,27.2-23l140.4-20.4L232,164.6c5.7-11.6,17.3-18.8,30.2-16.8c0.6,0,1,0.4,1,1 v430.1c0,0.4-0.2,0.7-0.5,0.9l-126,66.3C132,646.6,126.6,648,121,648z" style="stroke: ' + attrs.strokeColor + '; stroke-opacity: 0;" />';
			},

			getSvgDimensions: function(starShape){
				return (starShape === 'rounded') ? 'width="550px" height="500.2px" viewBox="0 146.8 550 500.2" style="enable-background:new 0 0 550 500.2;' : 'x="0px" y="0px" width="305px" height="305px" viewBox="60 -62 309 309" style="enable-background:new 64 -59 305 305;';
			},

			getLinearGradient: function(id, startColor, endColor, starShape){
				var height = (starShape === 'rounded') ? 500 : 250;
				return '<linearGradient id="' + id + '" gradientUnits="userSpaceOnUse" x1="0" y1="-50" x2="0" y2="' + height + '"><stop  offset="0" style="stop-color:' + startColor + '"/><stop  offset="1" style="stop-color:' + endColor + '"/> </linearGradient>';
			},

			executeCallback: function(rating, $el){
				var callback = this.settings.callback;
				callback(rating, $el);
			}

		};

		var publicMethods = {

			unload: function() {
				var _name = 'plugin_' + pluginName;
				var $el = $(this);
				var $starSet = $el.data(_name).$stars;
				$starSet.off();
				$el.removeData(_name).remove();
			},

			setRating: function(rating, round) {
				var _name = 'plugin_' + pluginName;
				var $el = $(this);
				var $plugin = $el.data(_name);
				if( rating > $plugin.settings.totalStars || rating < 0 ) { return; }
				if( round ){
					rating = Math.round(rating);
				}
				$plugin.applyRating(rating);
			},

			getRating: function() {
				var _name = 'plugin_' + pluginName;
				var $el = $(this);
				var $starSet = $el.data(_name);
				return $starSet._state.rating;
			},

			resize: function(newSize) {
				var _name = 'plugin_' + pluginName;
				var $el = $(this);
				var $starSet = $el.data(_name);
				var $stars = $starSet.$stars;

				if(newSize <= 1 || newSize > 200) {
					console.log('star size out of bounds');
					return;
				}

				$stars = Array.prototype.slice.call($stars);
				$stars.forEach(function(star){
					$(star).css({
						'width': newSize + 'px',
						'height': newSize + 'px'
					});
				});
			},

			setReadOnly: function(flag) {
				var _name = 'plugin_' + pluginName;
				var $el = $(this);
				var $plugin = $el.data(_name);
				if(flag === true){
					$plugin.$stars.off('mouseover mouseout click');
				} else {
					$plugin.settings.readOnly = false;
					$plugin.addListeners();
				}
			}

		};


		// Avoid Plugin.prototype conflicts
		$.extend(Plugin.prototype, methods);

		$.fn[ pluginName ] = function ( options ) {

			// if options is a public method
			if( !$.isPlainObject(options) ){
				if( publicMethods.hasOwnProperty(options) ){
					return publicMethods[options].apply(this, Array.prototype.slice.call(arguments, 1));
				} else {
					$.error('Method '+ options +' does not exist on ' + pluginName + '.js');
				}
			}

			return this.each(function() {
				// preventing against multiple instantiations
				if ( !$.data( this, 'plugin_' + pluginName ) ) {
					$.data( this, 'plugin_' + pluginName, new Plugin( this, options ) );
				}
			});
		};

	})( jQuery, window, document );


	$(".my-rating").starRating({
		initialRating: $("#potential_level").val() / 2,
		strokeColor: 'gold',
		strokeWidth: 10,
		starSize: 25,
		ratedColor: 'gold',
		callback: function (currentRating, $el) {
			var data = {
				potential_level: currentRating * 2
			};
			var url = "potential/" + $("#idCompany").val();
			$.post(url, data, function (data) {
				if (data.retour == true) {
				}
			});
		}
	});

	$(document).on('click','.my-rating',function () {
		console.log($(this).starRating('getRating'));
	});

    $(".gestion_formulaire > .row > div").addClass("col-lg-8");
    $(".gestion_formulaire > .row > p").addClass("col-lg-4");

    $(".gestion-formulaire-checkbox-div > div").addClass("custom-control custom-checkbox");

    //Permet de rendre dynamique la selection des checkbox dans le formulaire d'opérations
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

    })
    
    // --------------------------------------------------------------
    // --------------------------------------------------------------
} );
