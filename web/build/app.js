(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./node_modules/materialize/index.js":
/*!*******************************************!*\
  !*** ./node_modules/materialize/index.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = function materialize(list, key, value) {
  var ret = {};

  if (list) Array.prototype.forEach.call(list, function(item) {
    ret[item[key||'name']] = item[value||'value'];
  });

  return ret;
};


/***/ }),

/***/ "./web/assets/js/app.js":
/*!******************************!*\
  !*** ./web/assets/js/app.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ../scss/app.scss */ "./web/assets/scss/app.scss");

__webpack_require__(/*! materialize */ "./node_modules/materialize/index.js");

/***/ }),

/***/ "./web/assets/scss/app.scss":
/*!**********************************!*\
  !*** ./web/assets/scss/app.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ })

},[["./web/assets/js/app.js","runtime"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvbWF0ZXJpYWxpemUvaW5kZXguanMiLCJ3ZWJwYWNrOi8vLy4vd2ViL2Fzc2V0cy9qcy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vd2ViL2Fzc2V0cy9zY3NzL2FwcC5zY3NzPzllZGEiXSwibmFtZXMiOlsicmVxdWlyZSJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7O0FBQUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0EsR0FBRzs7QUFFSDtBQUNBOzs7Ozs7Ozs7Ozs7QUNSQUEsbUJBQU8sQ0FBQyxvREFBRCxDQUFQOztBQUNBQSxtQkFBTyxDQUFDLHdEQUFELENBQVAsQzs7Ozs7Ozs7Ozs7QUNEQSx1QyIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uIG1hdGVyaWFsaXplKGxpc3QsIGtleSwgdmFsdWUpIHtcbiAgdmFyIHJldCA9IHt9O1xuXG4gIGlmIChsaXN0KSBBcnJheS5wcm90b3R5cGUuZm9yRWFjaC5jYWxsKGxpc3QsIGZ1bmN0aW9uKGl0ZW0pIHtcbiAgICByZXRbaXRlbVtrZXl8fCduYW1lJ11dID0gaXRlbVt2YWx1ZXx8J3ZhbHVlJ107XG4gIH0pO1xuXG4gIHJldHVybiByZXQ7XG59O1xuIiwicmVxdWlyZSgnLi4vc2Nzcy9hcHAuc2NzcycpO1xucmVxdWlyZSgnbWF0ZXJpYWxpemUnKTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW4iXSwic291cmNlUm9vdCI6IiJ9