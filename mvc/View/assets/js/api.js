function makeRequest(URL, metodo, dados) {
  return axios({
    method: metodo,
    url: URL,
    ...dados
  });
}