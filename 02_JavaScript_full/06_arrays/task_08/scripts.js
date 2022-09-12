'use strict';

/**
 * @param {number[]} arr
 * @param {number} delta
 * @return {number[]}
 */
const increaseEvenEl = (arr, delta) => {
  // put your code here
  if (!Array.isArray(arr)) {
    return null;
  }
  let resultArray = [];
  for (let i = 0; i < arr.length; i += 1) {
    if (arr[i] % 2 === 0) {
      resultArray[i] = arr[i] + delta;
    } else {
      resultArray[i] = arr[i];
    }
  }
  return resultArray;
};

// examples
increaseEvenEl([2, 5, 6, 8, 11, 9, 4], 20); // ===> [22, 5, 26, 28, 11, 9, 24]
increaseEvenEl([7, 11, 1], 10); // ===> [7, 11, 1]
increaseEvenEl([], 120); // ===> []
