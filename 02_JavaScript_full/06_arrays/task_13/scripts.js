function withdraw(clients, balances, client, amount) {
  let clientIndex;
  for (let i = 0; i < clients.length; i += 1) {
    if (client === clients[i]) {
      clientIndex = i;
    }
  }
  if (balances[clientIndex] >= amount) {
    balances[clientIndex] -= amount;
    return balances[clientIndex];
  } else {
    return -1;
  }
}
