/* eslint-disable no-restricted-syntax */
'use strict';

/**
 * @param {number[]} arr
 * @return {number}
 */
function getSum(arr) {
  // put your code here
  if (!Array.isArray(arr)) {
    return null;
  }
  let sumArray = 0;
  for (let element of arr) {
    sumArray += element;
  }
  // for (let i = 0; i < arr.length; i += 1) {
  //   sumArray += arr[i];
  // }
  return sumArray;
}

// examples
getSum([1, 10, -10, 4]); // ==> 5
getSum([1]); // ==> 1
getSum([-8, 8]); // ==> 0
getSum(10, 12, 14); // ==> null
