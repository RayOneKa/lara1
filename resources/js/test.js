// const answer = prompt('2 + 2?')
const answer = '4'

switch (answer) {
    case '4': {
        console.log('правильно!')
        break
    }
    case '3': {
        console.log('правильный ответ больше!')
        break
    }
    case '5': {
        console.log('правильный ответ меньше!')
        break
    }
    default: {
        console.log('неправильно!')
        break
    }
}

console.log(varExample)

const varExample = 'какое-то значение'

sayHello()

function sayHello () {
    console.log('Hello, world!')
}

function sum (a, b = 0) {
    // if (b === undefined) {
    //     b = 0
    // }
    console.log(a + b)
}

// sum(1)

let fName = 'Rail'

function sayHi () {
    const fName = 'Petr'
    console.log(fName)
}

sayHi()
console.log(fName)

function returnExample (a, b) {
    return a * b
}

let res = returnExample(2, 3)
console.log('res = ', res)

function noReturnExample () {
    let a = 1
    let b = 2
    let c = a + b
}

res = noReturnExample()
console.log('res = ', res)

function emptyReturnExample () {
    console.log('вызвали функцию emptyReturnExample')
    return

    return true
}

console.log(emptyReturnExample())

console.log('funcExpr', funcExpr)


let funcExpr = function () {
    console.log('это пример function expression')
}

console.log(funcExpr)
funcExpr()


function callBackExample (access, accept, decline) {
    if (access) {
        accept()
    } else {
        decline()
    }
}

const accept = function () {
    alert('доступ предоставлен!')
}

const decline = function () {
    alert('доступ запрещен!')
}


callBackExample(true, accept, decline)

const arrowFunc = (a, b, c) => a + b + c

console.log('arrowFunc', arrowFunc(1, 2, 3))

const multiLineArrowFunc = (a, b) => {
    let res = a + b
    res *= 2
    return res
}

console.log('multiLineArrowFunc', multiLineArrowFunc(2, 2))

console.log(Math.pow(27, 1/3))

let user = {
    name: 'John',
    age: 34,
    sayHello: function () {
        console.log(`Hello, my name is ${this.name}`)
    },
    sayHi: () => {
        console.log(`Hello, my name is ${this.name}`)
    },
    array: [[1, 2, 3], 1, 2, 3, 4, 5, 6, 7, 8],
    custom: {
        first:  {
            a: 1,
            b: 2
        },
        second: 2
    }
}

console.log(user.name)

delete user.age

console.log(user)

user.age = 29

console.log(user)

for (let key in user) {
    console.log(`${key}: ${user[key]}`)
}

user.sayHello()

console.log('-----------------')

let person = Object.assign({}, user)
person.name = 'Keanu'

person.sayHello()
user.sayHello()
person.sayHi()
user.sayHi()

console.log(person)

fetch('/api/user')
  .then(response => response.json())
  .then(user => console.log(user))


$.ajax({
    url: '/api/categories/get',
    dataType: 'json',
    succes: function (response) {
        console.log(response)
    }
})