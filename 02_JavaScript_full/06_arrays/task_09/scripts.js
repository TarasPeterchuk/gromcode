const reverseArray = (arr) => {
  if (!Array.isArray(arr)) {
    return null;
  }
  let newArry = [];
  for (let i = arr.length - 1; i >= 0; i -= 1) {
    newArry.push(arr[i]);
  }
  return newArry;
};
