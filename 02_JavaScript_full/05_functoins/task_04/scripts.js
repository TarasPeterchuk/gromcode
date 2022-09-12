function getSum(start, end) {
  let result = 0;
  for (let i = start; i <= end; i += 1) {
    if (i % 2 === 0) {
      result += i;
    }
  }
  return result;
}
