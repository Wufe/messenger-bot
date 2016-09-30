/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	eval("\"use strict\";\nvar React = __webpack_require__(1);\nvar ReactDOM = __webpack_require__(2);\nvar App_1 = __webpack_require__(3);\nReactDOM.render(React.createElement(App_1.default, {compiler: \"TypeScript\", framework: \"React\"}), document.getElementById(\"app\"));\n\n\n/*****************\n ** WEBPACK FOOTER\n ** ./src/frontend/index.tsx\n ** module id = 0\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///./src/frontend/index.tsx?");

/***/ },
/* 1 */
/***/ function(module, exports) {

	eval("module.exports = React;\n\n/*****************\n ** WEBPACK FOOTER\n ** external \"React\"\n ** module id = 1\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///external_%22React%22?");

/***/ },
/* 2 */
/***/ function(module, exports) {

	eval("module.exports = ReactDOM;\n\n/*****************\n ** WEBPACK FOOTER\n ** external \"ReactDOM\"\n ** module id = 2\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///external_%22ReactDOM%22?");

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	eval("\"use strict\";\nvar __extends = (this && this.__extends) || function (d, b) {\n    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];\n    function __() { this.constructor = d; }\n    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());\n};\nvar React = __webpack_require__(1);\nvar App = (function (_super) {\n    __extends(App, _super);\n    function App() {\n        _super.apply(this, arguments);\n    }\n    App.prototype.render = function () {\n        return (React.createElement(\"h1\", null, \n            \"Hello from \", \n            this.props.compiler, \n            \" and \", \n            this.props.framework, \n            \"!\"));\n    };\n    return App;\n}(React.Component));\nObject.defineProperty(exports, \"__esModule\", { value: true });\nexports.default = App;\n\n\n/*****************\n ** WEBPACK FOOTER\n ** ./src/frontend/App.tsx\n ** module id = 3\n ** module chunks = 0\n **/\n//# sourceURL=webpack:///./src/frontend/App.tsx?");

/***/ }
/******/ ]);