(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["myTemplate"],{

/***/ "./assets/css/sb-admin-2.css":
/*!***********************************!*\
  !*** ./assets/css/sb-admin-2.css ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/js/mytemplate.js":
/*!*********************************!*\
  !*** ./assets/js/mytemplate.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ../css/sb-admin-2.css */ "./assets/css/sb-admin-2.css");

__webpack_require__(/*! ../js/sb-admin-2.js */ "./assets/js/sb-admin-2.js");

/***/ }),

/***/ "./assets/js/sb-admin-2.js":
/*!*********************************!*\
  !*** ./assets/js/sb-admin-2.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  "use strict"; // Start of use strict
  // Toggle the side navigation

  $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");

    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    }

    ;
  });
  /*$( "#sidebarToggle, #sidebarToggleTop" ).click(function() {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });*/
  // Close any open menu accordions when window is resized below 768px

  $(window).resize(function () {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    }

    ;
  }); // Prevent the content wrapper from scrolling when the fixed side navigation hovered over

  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  }); // Scroll to top button appear

  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();

    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  }); // Smooth scrolling using jQuery easing

  $(document).on('click', 'a.scroll-to-top', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });
})(jQuery); // End of use strict

/***/ })

},[["./assets/js/mytemplate.js","runtime"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL3NiLWFkbWluLTIuY3NzPzJmYjciLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL215dGVtcGxhdGUuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3NiLWFkbWluLTIuanMiXSwibmFtZXMiOlsicmVxdWlyZSIsIiQiLCJvbiIsImUiLCJ0b2dnbGVDbGFzcyIsImhhc0NsYXNzIiwiY29sbGFwc2UiLCJ3aW5kb3ciLCJyZXNpemUiLCJ3aWR0aCIsImUwIiwib3JpZ2luYWxFdmVudCIsImRlbHRhIiwid2hlZWxEZWx0YSIsImRldGFpbCIsInNjcm9sbFRvcCIsInByZXZlbnREZWZhdWx0IiwiZG9jdW1lbnQiLCJzY3JvbGxEaXN0YW5jZSIsImZhZGVJbiIsImZhZGVPdXQiLCIkYW5jaG9yIiwic3RvcCIsImFuaW1hdGUiLCJhdHRyIiwib2Zmc2V0IiwidG9wIiwialF1ZXJ5Il0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7QUFBQSx1Qzs7Ozs7Ozs7Ozs7QUNBQUEsbUJBQU8sQ0FBQywwREFBRCxDQUFQOztBQUVBQSxtQkFBTyxDQUFDLHNEQUFELENBQVAsQzs7Ozs7Ozs7Ozs7QUNGQSxDQUFDLFVBQVNDLENBQVQsRUFBWTtBQUNYLGVBRFcsQ0FDRztBQUVkOztBQUNBQSxHQUFDLENBQUMsbUNBQUQsQ0FBRCxDQUF1Q0MsRUFBdkMsQ0FBMEMsT0FBMUMsRUFBbUQsVUFBU0MsQ0FBVCxFQUFZO0FBQzdERixLQUFDLENBQUMsTUFBRCxDQUFELENBQVVHLFdBQVYsQ0FBc0IsaUJBQXRCO0FBQ0FILEtBQUMsQ0FBQyxVQUFELENBQUQsQ0FBY0csV0FBZCxDQUEwQixTQUExQjs7QUFDQSxRQUFJSCxDQUFDLENBQUMsVUFBRCxDQUFELENBQWNJLFFBQWQsQ0FBdUIsU0FBdkIsQ0FBSixFQUF1QztBQUNyQ0osT0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JLLFFBQXhCLENBQWlDLE1BQWpDO0FBQ0Q7O0FBQUE7QUFDRixHQU5EO0FBT0E7Ozs7Ozs7QUFRQTs7QUFDQUwsR0FBQyxDQUFDTSxNQUFELENBQUQsQ0FBVUMsTUFBVixDQUFpQixZQUFXO0FBQzFCLFFBQUlQLENBQUMsQ0FBQ00sTUFBRCxDQUFELENBQVVFLEtBQVYsS0FBb0IsR0FBeEIsRUFBNkI7QUFDM0JSLE9BQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCSyxRQUF4QixDQUFpQyxNQUFqQztBQUNEOztBQUFBO0FBQ0YsR0FKRCxFQXBCVyxDQTBCWDs7QUFDQUwsR0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkJDLEVBQTdCLENBQWdDLGlDQUFoQyxFQUFtRSxVQUFTQyxDQUFULEVBQVk7QUFDN0UsUUFBSUYsQ0FBQyxDQUFDTSxNQUFELENBQUQsQ0FBVUUsS0FBVixLQUFvQixHQUF4QixFQUE2QjtBQUMzQixVQUFJQyxFQUFFLEdBQUdQLENBQUMsQ0FBQ1EsYUFBWDtBQUFBLFVBQ0VDLEtBQUssR0FBR0YsRUFBRSxDQUFDRyxVQUFILElBQWlCLENBQUNILEVBQUUsQ0FBQ0ksTUFEL0I7QUFFQSxXQUFLQyxTQUFMLElBQWtCLENBQUNILEtBQUssR0FBRyxDQUFSLEdBQVksQ0FBWixHQUFnQixDQUFDLENBQWxCLElBQXVCLEVBQXpDO0FBQ0FULE9BQUMsQ0FBQ2EsY0FBRjtBQUNEO0FBQ0YsR0FQRCxFQTNCVyxDQW9DWDs7QUFDQWYsR0FBQyxDQUFDZ0IsUUFBRCxDQUFELENBQVlmLEVBQVosQ0FBZSxRQUFmLEVBQXlCLFlBQVc7QUFDbEMsUUFBSWdCLGNBQWMsR0FBR2pCLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUWMsU0FBUixFQUFyQjs7QUFDQSxRQUFJRyxjQUFjLEdBQUcsR0FBckIsRUFBMEI7QUFDeEJqQixPQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQmtCLE1BQXBCO0FBQ0QsS0FGRCxNQUVPO0FBQ0xsQixPQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQm1CLE9BQXBCO0FBQ0Q7QUFDRixHQVBELEVBckNXLENBOENYOztBQUNBbkIsR0FBQyxDQUFDZ0IsUUFBRCxDQUFELENBQVlmLEVBQVosQ0FBZSxPQUFmLEVBQXdCLGlCQUF4QixFQUEyQyxVQUFTQyxDQUFULEVBQVk7QUFDckQsUUFBSWtCLE9BQU8sR0FBR3BCLENBQUMsQ0FBQyxJQUFELENBQWY7QUFDQUEsS0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQnFCLElBQWhCLEdBQXVCQyxPQUF2QixDQUErQjtBQUM3QlIsZUFBUyxFQUFHZCxDQUFDLENBQUNvQixPQUFPLENBQUNHLElBQVIsQ0FBYSxNQUFiLENBQUQsQ0FBRCxDQUF3QkMsTUFBeEIsR0FBaUNDO0FBRGhCLEtBQS9CLEVBRUcsSUFGSCxFQUVTLGVBRlQ7QUFHQXZCLEtBQUMsQ0FBQ2EsY0FBRjtBQUNELEdBTkQ7QUFRRCxDQXZERCxFQXVER1csTUF2REgsRSxDQXVEWSxvQiIsImZpbGUiOiJteVRlbXBsYXRlLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luIiwicmVxdWlyZSgnLi4vY3NzL3NiLWFkbWluLTIuY3NzJyk7XHJcblxyXG5yZXF1aXJlKCcuLi9qcy9zYi1hZG1pbi0yLmpzJyk7IiwiKGZ1bmN0aW9uKCQpIHtcclxuICBcInVzZSBzdHJpY3RcIjsgLy8gU3RhcnQgb2YgdXNlIHN0cmljdFxyXG5cclxuICAvLyBUb2dnbGUgdGhlIHNpZGUgbmF2aWdhdGlvblxyXG4gICQoXCIjc2lkZWJhclRvZ2dsZSwgI3NpZGViYXJUb2dnbGVUb3BcIikub24oJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgJChcImJvZHlcIikudG9nZ2xlQ2xhc3MoXCJzaWRlYmFyLXRvZ2dsZWRcIik7XHJcbiAgICAkKFwiLnNpZGViYXJcIikudG9nZ2xlQ2xhc3MoXCJ0b2dnbGVkXCIpO1xyXG4gICAgaWYgKCQoXCIuc2lkZWJhclwiKS5oYXNDbGFzcyhcInRvZ2dsZWRcIikpIHtcclxuICAgICAgJCgnLnNpZGViYXIgLmNvbGxhcHNlJykuY29sbGFwc2UoJ2hpZGUnKTtcclxuICAgIH07XHJcbiAgfSk7XHJcbiAgLyokKCBcIiNzaWRlYmFyVG9nZ2xlLCAjc2lkZWJhclRvZ2dsZVRvcFwiICkuY2xpY2soZnVuY3Rpb24oKSB7XHJcbiAgICAkKFwiYm9keVwiKS50b2dnbGVDbGFzcyhcInNpZGViYXItdG9nZ2xlZFwiKTtcclxuICAgICQoXCIuc2lkZWJhclwiKS50b2dnbGVDbGFzcyhcInRvZ2dsZWRcIik7XHJcbiAgICBpZiAoJChcIi5zaWRlYmFyXCIpLmhhc0NsYXNzKFwidG9nZ2xlZFwiKSkge1xyXG4gICAgICAkKCcuc2lkZWJhciAuY29sbGFwc2UnKS5jb2xsYXBzZSgnaGlkZScpO1xyXG4gICAgfTtcclxuICB9KTsqL1xyXG5cclxuICAvLyBDbG9zZSBhbnkgb3BlbiBtZW51IGFjY29yZGlvbnMgd2hlbiB3aW5kb3cgaXMgcmVzaXplZCBiZWxvdyA3NjhweFxyXG4gICQod2luZG93KS5yZXNpemUoZnVuY3Rpb24oKSB7XHJcbiAgICBpZiAoJCh3aW5kb3cpLndpZHRoKCkgPCA3NjgpIHtcclxuICAgICAgJCgnLnNpZGViYXIgLmNvbGxhcHNlJykuY29sbGFwc2UoJ2hpZGUnKTtcclxuICAgIH07XHJcbiAgfSk7XHJcblxyXG4gIC8vIFByZXZlbnQgdGhlIGNvbnRlbnQgd3JhcHBlciBmcm9tIHNjcm9sbGluZyB3aGVuIHRoZSBmaXhlZCBzaWRlIG5hdmlnYXRpb24gaG92ZXJlZCBvdmVyXHJcbiAgJCgnYm9keS5maXhlZC1uYXYgLnNpZGViYXInKS5vbignbW91c2V3aGVlbCBET01Nb3VzZVNjcm9sbCB3aGVlbCcsIGZ1bmN0aW9uKGUpIHtcclxuICAgIGlmICgkKHdpbmRvdykud2lkdGgoKSA+IDc2OCkge1xyXG4gICAgICB2YXIgZTAgPSBlLm9yaWdpbmFsRXZlbnQsXHJcbiAgICAgICAgZGVsdGEgPSBlMC53aGVlbERlbHRhIHx8IC1lMC5kZXRhaWw7XHJcbiAgICAgIHRoaXMuc2Nyb2xsVG9wICs9IChkZWx0YSA8IDAgPyAxIDogLTEpICogMzA7XHJcbiAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgIH1cclxuICB9KTtcclxuXHJcbiAgLy8gU2Nyb2xsIHRvIHRvcCBidXR0b24gYXBwZWFyXHJcbiAgJChkb2N1bWVudCkub24oJ3Njcm9sbCcsIGZ1bmN0aW9uKCkge1xyXG4gICAgdmFyIHNjcm9sbERpc3RhbmNlID0gJCh0aGlzKS5zY3JvbGxUb3AoKTtcclxuICAgIGlmIChzY3JvbGxEaXN0YW5jZSA+IDEwMCkge1xyXG4gICAgICAkKCcuc2Nyb2xsLXRvLXRvcCcpLmZhZGVJbigpO1xyXG4gICAgfSBlbHNlIHtcclxuICAgICAgJCgnLnNjcm9sbC10by10b3AnKS5mYWRlT3V0KCk7XHJcbiAgICB9XHJcbiAgfSk7XHJcblxyXG4gIC8vIFNtb290aCBzY3JvbGxpbmcgdXNpbmcgalF1ZXJ5IGVhc2luZ1xyXG4gICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICdhLnNjcm9sbC10by10b3AnLCBmdW5jdGlvbihlKSB7XHJcbiAgICB2YXIgJGFuY2hvciA9ICQodGhpcyk7XHJcbiAgICAkKCdodG1sLCBib2R5Jykuc3RvcCgpLmFuaW1hdGUoe1xyXG4gICAgICBzY3JvbGxUb3A6ICgkKCRhbmNob3IuYXR0cignaHJlZicpKS5vZmZzZXQoKS50b3ApXHJcbiAgICB9LCAxMDAwLCAnZWFzZUluT3V0RXhwbycpO1xyXG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gIH0pO1xyXG5cclxufSkoalF1ZXJ5KTsgLy8gRW5kIG9mIHVzZSBzdHJpY3RcclxuIl0sInNvdXJjZVJvb3QiOiIifQ==