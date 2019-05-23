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
		$('[data-toggle="popover"]').popover({html:true,trigger: 'focus'})
	})

} );