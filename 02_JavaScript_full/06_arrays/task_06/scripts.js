'use strict';

/**
 * @param {number[]} arr
 * @return {number[]}
 */
function squareArray(arr) {
  // put your code here
  if (!Array.isArray(arr)) {
    return null;
  }
  let resultArray = [];
  for (let i = 0; i < arr.length; i += 1) {
    resultArray[i] = arr[i] * arr[i];
  }
  return resultArray;
}

// examples
squareArray([1, 10, 9, 11]); // ==> [1, 100, 81, 121]
squareArray([10, 0, -4]); // ==> [100, 0, 16]
squareArray([1]); // ==> [1]
