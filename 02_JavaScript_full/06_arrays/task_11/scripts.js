function checker(arr) {
  if (!Array.isArray(arr)) {
    return null;
  }
  let maxVal = arr[0];
  let minVal = arr[0];
  for (let el of arr) {
    if (maxVal < el) {
      maxVal = el;
    }
    if (minVal > el) {
      minVal = el;
    }
  }
  return minVal + maxVal > 1000;
}
