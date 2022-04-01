/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/manager.js":
/*!*********************************!*\
  !*** ./resources/js/manager.js ***!
  \*********************************/
/***/ (() => {

eval("window.addEventListener('DOMContentLoaded', function (event) {\n  /*!\r\n  * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)\r\n  * Copyright 2013-2021 Start Bootstrap\r\n  * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)\r\n  */\n  // Toggle the side navigation\n  var sidebarToggle = document.body.querySelector('#sidebarToggle');\n\n  if (sidebarToggle) {\n    // Uncomment Below to persist sidebar toggle between refreshes\n    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {\n    //     document.body.classList.toggle('sb-sidenav-toggled');\n    // }\n    sidebarToggle.addEventListener('click', function (event) {\n      event.preventDefault();\n      document.body.classList.toggle('sb-sidenav-toggled');\n      localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvbWFuYWdlci5qcz80ZTg1Il0sIm5hbWVzIjpbIndpbmRvdyIsImFkZEV2ZW50TGlzdGVuZXIiLCJldmVudCIsInNpZGViYXJUb2dnbGUiLCJkb2N1bWVudCIsImJvZHkiLCJxdWVyeVNlbGVjdG9yIiwicHJldmVudERlZmF1bHQiLCJjbGFzc0xpc3QiLCJ0b2dnbGUiLCJsb2NhbFN0b3JhZ2UiLCJzZXRJdGVtIiwiY29udGFpbnMiXSwibWFwcGluZ3MiOiJBQUFBQSxNQUFNLENBQUNDLGdCQUFQLENBQXdCLGtCQUF4QixFQUE0QyxVQUFBQyxLQUFLLEVBQUk7QUFDakQ7QUFDSjtBQUNBO0FBQ0E7QUFDQTtBQUVJO0FBQ0EsTUFBTUMsYUFBYSxHQUFHQyxRQUFRLENBQUNDLElBQVQsQ0FBY0MsYUFBZCxDQUE0QixnQkFBNUIsQ0FBdEI7O0FBQ0EsTUFBSUgsYUFBSixFQUFtQjtBQUNmO0FBQ0E7QUFDQTtBQUNBO0FBQ0FBLElBQUFBLGFBQWEsQ0FBQ0YsZ0JBQWQsQ0FBK0IsT0FBL0IsRUFBd0MsVUFBQUMsS0FBSyxFQUFJO0FBQzdDQSxNQUFBQSxLQUFLLENBQUNLLGNBQU47QUFDQUgsTUFBQUEsUUFBUSxDQUFDQyxJQUFULENBQWNHLFNBQWQsQ0FBd0JDLE1BQXhCLENBQStCLG9CQUEvQjtBQUNBQyxNQUFBQSxZQUFZLENBQUNDLE9BQWIsQ0FBcUIsbUJBQXJCLEVBQTBDUCxRQUFRLENBQUNDLElBQVQsQ0FBY0csU0FBZCxDQUF3QkksUUFBeEIsQ0FBaUMsb0JBQWpDLENBQTFDO0FBQ0gsS0FKRDtBQUtIO0FBQ0osQ0FwQkQiLCJzb3VyY2VzQ29udGVudCI6WyJ3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignRE9NQ29udGVudExvYWRlZCcsIGV2ZW50ID0+IHtcclxuICAgIC8qIVxyXG4gICAgKiBTdGFydCBCb290c3RyYXAgLSBTQiBBZG1pbiB2Ny4wLjQgKGh0dHBzOi8vc3RhcnRib290c3RyYXAuY29tL3RlbXBsYXRlL3NiLWFkbWluKVxyXG4gICAgKiBDb3B5cmlnaHQgMjAxMy0yMDIxIFN0YXJ0IEJvb3RzdHJhcFxyXG4gICAgKiBMaWNlbnNlZCB1bmRlciBNSVQgKGh0dHBzOi8vZ2l0aHViLmNvbS9TdGFydEJvb3RzdHJhcC9zdGFydGJvb3RzdHJhcC1zYi1hZG1pbi9ibG9iL21hc3Rlci9MSUNFTlNFKVxyXG4gICAgKi9cclxuXHJcbiAgICAvLyBUb2dnbGUgdGhlIHNpZGUgbmF2aWdhdGlvblxyXG4gICAgY29uc3Qgc2lkZWJhclRvZ2dsZSA9IGRvY3VtZW50LmJvZHkucXVlcnlTZWxlY3RvcignI3NpZGViYXJUb2dnbGUnKTtcclxuICAgIGlmIChzaWRlYmFyVG9nZ2xlKSB7XHJcbiAgICAgICAgLy8gVW5jb21tZW50IEJlbG93IHRvIHBlcnNpc3Qgc2lkZWJhciB0b2dnbGUgYmV0d2VlbiByZWZyZXNoZXNcclxuICAgICAgICAvLyBpZiAobG9jYWxTdG9yYWdlLmdldEl0ZW0oJ3NifHNpZGViYXItdG9nZ2xlJykgPT09ICd0cnVlJykge1xyXG4gICAgICAgIC8vICAgICBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC50b2dnbGUoJ3NiLXNpZGVuYXYtdG9nZ2xlZCcpO1xyXG4gICAgICAgIC8vIH1cclxuICAgICAgICBzaWRlYmFyVG9nZ2xlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZXZlbnQgPT4ge1xyXG4gICAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC50b2dnbGUoJ3NiLXNpZGVuYXYtdG9nZ2xlZCcpO1xyXG4gICAgICAgICAgICBsb2NhbFN0b3JhZ2Uuc2V0SXRlbSgnc2J8c2lkZWJhci10b2dnbGUnLCBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5jb250YWlucygnc2Itc2lkZW5hdi10b2dnbGVkJykpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG59KTsiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL21hbmFnZXIuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/manager.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/manager.js"]();
/******/ 	
/******/ })()
;