const getSubArray = (arr, numberOfElements) => {
  // put your code here
  let resultArray = [];
  for (let i = 0; i < numberOfElements; i += 1) {
    resultArray.push(arr[i]);
  }
  return resultArray;
};
