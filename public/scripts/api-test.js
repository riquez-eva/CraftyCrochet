fetch('https://127.0.0.1:8000/api', {
  method: 'GET',
  headers: {
    'Authorization': 'Bearer TON_TOKEN_ICI',
    'Content-Type': 'application/json'
  }
})
.then(res => {
  console.log('Status HTTP:', res.status);
  return res.json();
})
.then(data => console.log('Données API:', data))
.catch(err => console.error('Erreur:', err));
