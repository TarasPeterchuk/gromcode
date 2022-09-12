let sum = 0;
for (let i = 0; i <= 1000; i += 1) {
  if (i % 2 !== 0) {
    console.log('Found');
    sum += i;
  }
}
if (sum * 5 > 5000) {
  console.log('Bigger');
} else if (sum * 5 === 5000) {
  console.log('equal');
} else {
  console.log('Smaller');
}
