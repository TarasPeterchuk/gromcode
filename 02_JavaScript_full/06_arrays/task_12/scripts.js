function sortAsc(array) {
  const [...all] = array;
  const newArr = [...all];
  let done = false;
  while (!done) {
    done = true;
    for (let i = 1; i < newArr.length; i += 1) {
      if (newArr[i - 1] > newArr[i]) {
        done = false;
        let tmp = newArr[i - 1];
        newArr[i - 1] = newArr[i];
        newArr[i] = tmp;
      }
    }
  }

  return newArr;
}

function sortDesc(array) {
  const [...all] = array;
  const newArr = [...all];
  let done = false;
  while (!done) {
    done = true;
    for (let i = 1; i < newArr.length; i += 1) {
      if (newArr[i - 1] > newArr[i]) {
        done = false;
        let tmp = newArr[i - 1];
        newArr[i - 1] = newArr[i];
        newArr[i] = tmp;
      }
    }
  }

  let reverse = [];
  for (let i = newArr.length - 1; i >= 0; i -= 1) {
    reverse.push(newArr[i]);
  }

  return reverse;
}
