/**
 * @param {number} num
 * @return {undefined}
 */
function getPrimes(num) {
  // put your code here

  for (let i = 2; i <= num; i++) {
    let flag = 0;

    for (let j = 2; j < i; j++) {
      if (i % j == 0) {
        flag = 1;
        break;
      }
    }

    if (i > 1 && flag == 0) {
      console.log(i);
    }
  }
}

console.log(getPrimes(3));
