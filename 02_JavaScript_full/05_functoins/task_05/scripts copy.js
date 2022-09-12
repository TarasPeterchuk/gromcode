/**
 * @param {number} num
 * @return {undefined}
 */
function checking(iterator) {
  for (let j = 2; j <= Math.sqrt(iterator); j += 1) {
    if (iterator % j === 0) {
      break;
    }
    console.log(iterator);
  }
}

function getPrimes(num) {
  // put your code here

  for (let i = 2; i <= num; i += 1) {
    checking(i);
  }
}

console.log(getPrimes(100));
