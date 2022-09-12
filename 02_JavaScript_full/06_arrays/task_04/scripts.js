'use strict';

/**
 * @param {number[]} numbers
 * @return {number[]}
 */
function swap(numbers) {
  // put your code here
  const [a, ...next] = numbers;
  return [...next, a];
}

/**
 * @param {number[]} numbers
 * @return {number[]}
 */
function swapManual(numbers) {
  // put your code here
  let newArray = [];
  for (let i = 0; i < numbers.length; i += 1) {
    newArray[i] = numbers[i];
  }
  const firts = newArray.shift();

  newArray.push(firts);
  return newArray;
}

// examples
swap([1, 10, 9, 11]); // ==> [10, 9, 11, 1]
swapManual([1, 10, 9, 11]); // ==> [10, 9, 11, 1]
