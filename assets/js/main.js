$(document).ready( function () {
	$("#search-filter").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#field-filter tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });

    //exporte les données sélectionnées
	var $table = $('#table');
	$(function () {
	    $('#toolbar').find('select').change(function () {
	        $table.bootstrapTable('refreshOptions', {
	            exportDataType: $(this).val(),
	        });
	    });
	})

	var trBoldBlue = $("table");

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
} );