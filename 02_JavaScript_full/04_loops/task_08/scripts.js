let sum = 0;
for (let i = 0; i <= 1000; i += 1) {
  sum += i;
}

console.log(Math.floor(sum / 1234) > sum % 1234);
