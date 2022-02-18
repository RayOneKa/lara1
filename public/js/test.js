/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/test.js":
/*!******************************!*\
  !*** ./resources/js/test.js ***!
  \******************************/
/***/ (function() {

var _this = this;

// const answer = prompt('2 + 2?')
var answer = '4';

switch (answer) {
  case '4':
    {
      console.log('правильно!');
      break;
    }

  case '3':
    {
      console.log('правильный ответ больше!');
      break;
    }

  case '5':
    {
      console.log('правильный ответ меньше!');
      break;
    }

  default:
    {
      console.log('неправильно!');
      break;
    }
}

console.log(varExample);
var varExample = 'какое-то значение';
sayHello();

function sayHello() {
  console.log('Hello, world!');
}

function sum(a) {
  var b = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
  // if (b === undefined) {
  //     b = 0
  // }
  console.log(a + b);
} // sum(1)


var fName = 'Rail';

function sayHi() {
  var fName = 'Petr';
  console.log(fName);
}

sayHi();
console.log(fName);

function returnExample(a, b) {
  return a * b;
}

var res = returnExample(2, 3);
console.log('res = ', res);

function noReturnExample() {
  var a = 1;
  var b = 2;
  var c = a + b;
}

res = noReturnExample();
console.log('res = ', res);

function emptyReturnExample() {
  console.log('вызвали функцию emptyReturnExample');
  return;
  return true;
}

console.log(emptyReturnExample());
console.log('funcExpr', funcExpr);

var funcExpr = function funcExpr() {
  console.log('это пример function expression');
};

console.log(funcExpr);
funcExpr();

function callBackExample(access, accept, decline) {
  if (access) {
    accept();
  } else {
    decline();
  }
}

var accept = function accept() {
  alert('доступ предоставлен!');
};

var decline = function decline() {
  alert('доступ запрещен!');
};

callBackExample(true, accept, decline);

var arrowFunc = function arrowFunc(a, b, c) {
  return a + b + c;
};

console.log('arrowFunc', arrowFunc(1, 2, 3));

var multiLineArrowFunc = function multiLineArrowFunc(a, b) {
  var res = a + b;
  res *= 2;
  return res;
};

console.log('multiLineArrowFunc', multiLineArrowFunc(2, 2));
console.log(Math.pow(27, 1 / 3));
var user = {
  name: 'John',
  age: 34,
  sayHello: function sayHello() {
    console.log("Hello, my name is ".concat(this.name));
  },
  sayHi: function sayHi() {
    console.log("Hello, my name is ".concat(_this.name));
  },
  array: [[1, 2, 3], 1, 2, 3, 4, 5, 6, 7, 8],
  custom: {
    first: {
      a: 1,
      b: 2
    },
    second: 2
  }
};
console.log(user.name);
delete user.age;
console.log(user);
user.age = 29;
console.log(user);

for (var key in user) {
  console.log("".concat(key, ": ").concat(user[key]));
}

user.sayHello();
console.log('-----------------');
var person = Object.assign({}, user);
person.name = 'Keanu';
person.sayHello();
user.sayHello();
person.sayHi();
user.sayHi();
console.log(person);
fetch('/api/user').then(function (response) {
  return response.json();
}).then(function (user) {
  return console.log(user);
});
$.ajax({
  url: '/api/categories/get',
  dataType: 'json',
  succes: function succes(response) {
    console.log(response);
  }
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/test.js"]();
/******/ 	
/******/ })()
;