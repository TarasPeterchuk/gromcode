'use strict';

/**
 * @param {number[]} arr
 * @return {boolean}
 */
const checkSum = (arr) => {
  // put your code here
  if (!Array.isArray(arr)) {
    return null;
  }
  let sum = 0;
  for (let el of arr) {
    sum += el;
  }
  return sum > 100;
};

// examples
checkSum([10, 10, 10]); // ===> false
checkSum([10, 99, 1]); // ===> true
checkSum([-6, -3, 200]); // ===> true
