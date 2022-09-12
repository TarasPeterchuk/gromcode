function removeDuplicates(array) {
  if (!Array.isArray(array)) {
    return null;
  }
  let newArr = [];

  for (let i = 0; i < array.length; i += 1) {
    let marker = 0;

    for (let j = 0; j < array.length; j += 1) {
      if (i === j) {
        continue;
      }
      if (array[i] === array[j]) {
        if (i > j) {
          marker = 1;
        }
      }
    }
    if (marker === 0) {
      newArr.push(array[i]);
    }
  }
  return newArr;
}
