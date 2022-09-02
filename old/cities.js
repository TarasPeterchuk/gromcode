for (let i in players) {
    let objTemp = {};
    for (let key in players[i]) {
      if (key === 'name' || key === 'goals' || key === 'team') {
        objTemp[key] = players[i][key];
      }
    }
    result.push(objTemp);
  }
  return result;
}


 if (!(cityTemp in result)) {
      console.log('no!' + cityTemp);
      //result['city'] = result['city'] + 1 || 1;
      result['${cityTemp}'] = 2;
    } else {
      console.log('YES!' + cityTemp);
      'use strict';

/**
 * @param {object[]} users
 * @return {object}
 */
function usersCountByCity(users) {
  // put your code here
  let result = {};

  for (let key in users) {
    result[users[key]['city']] = result[users[key]['city']] + 1 || 1;
  }
  return result;
}

// examples
const users = [
  {
    id: 888,
    name: 'Denis',
    age: 44,
    city: 'Kyiv',
  },
  {
    id: 333,
    name: 'Alex',
    age: 33,
    city: 'Lviv',
  },
  {
    id: 392,
    name: 'Nastya',
    age: 22,
    city: 'Kyiv',
  },
  {
    id: 123,
    name: 'Violetta',
    age: 15,
    city: 'Odesa',
  },
  {
    id: 640,
    name: 'Mykola',
    age: 31,
    city: 'Lviv',
  },
];

console.log(usersCountByCity(users)); // ===> { 'Kyiv': 2, 'Lviv': 2, 'Odesa': 1 }

      // result.cityTemp = cityTemp;
    }



    'use strict';

/**
 * @param {object[]} users
 * @param  {string} name
 * @return {object[]}
 */
function findUsersByName(users, name) {
  // put your code here
  let result = [];

  for (let i in users) {
    if (users[i]['name'] === name) {
      result.push(users[i]);
    }
  }
  return result;
}

/**
 * @param {object[]} users
 * @param  {string} str
 * @return {object[]}
 */
function findUsersByString(users, str) {
  // put your code here
  let result = [];
  for (let i in users) {
    if (users[i]['name'].includes(str)) {
      result.push(users[i]);
    }
  }
  return result;
}

// examples
const users = [
  {
    id: 101,
    name: 'Denis',
    city: 'Kyiv',
  },
  {
    id: 102,
    name: 'Alexandr',
    city: 'Lviv',
  },
  {
    id: 103,
    name: 'Nastya',
    city: 'Kyiv',
  },
  {
    id: 104,
    name: 'Violetta',
    city: 'Odesa',
  },
  {
    id: 105,
    name: 'Mykola',
    city: 'Lviv',
  },
  {
    id: 106,
    name: 'Denis',
    city: 'Lviv',
  },
  {
    id: 107,
    name: 'Andrey',
    city: 'Odesa',
  },
  {
    id: 108,
    name: 'Alexey',
    city: 'Dnipro',
  },
];

console.log(findUsersByName(users, 'Denis')); // ===> [ { id: 101, name: 'Denis', city: 'Kyiv' }, { id: 106, name: 'Denis', city: 'Lviv' } ]
console.log(findUsersByName(users, 'Andrey')); // ===> [ { id: 107, name: 'Andrey', city: 'Odesa' } ]
console.log(findUsersByName(users, 'Anna')); // ===> [ ]

console.log(findUsersByString(users, 'Al')); // ===> [ { id: 102, name: 'Alexandr', city: 'Lviv' }, { id: 108, name: 'Alexey', city: 'Dnipro' } ]
console.log(findUsersByString(users, 't')); // ===> [ { id: 103, name: 'Nastya', city: 'Kyiv' }, { id: 104, name: 'Violetta', city: 'Odesa' } ]
console.log(findUsersByString(users, 'Vik')); // ===> [ ]

console.log(findUsersByString(users, 'm')); // ===> [ ]
// explanation: letter 'm' is not included in any user name, 'Mykola' includes 'M' not 'm', so it is not added to the result
