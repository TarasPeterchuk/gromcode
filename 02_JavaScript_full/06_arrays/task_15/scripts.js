'use strict';

/**
 * @param {number[]} arr
 * @param {number} num
 * @return {boolean}
 */
const includes = (arr, num) => {
  // put your code here
  let marker = false;
  for (let el of arr) {
    if (num === el) {
      marker = true;
    }
  }
  return marker;
};

// examples
includes([1, 4, 8, 3], 3); // ==> true
includes([1, 4, 8, 3], 5); // ==> false
