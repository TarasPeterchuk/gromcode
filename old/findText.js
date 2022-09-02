function findText(text, find) {
  // put your code here
  return text.toLowerCase().includes(find.toLowerCase());
}

console.log(findText('JavaScript String toUpperCase', 'vaScript'));
