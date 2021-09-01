function makeRequest(URL, metodo, data, header) {
  return axios({
    method: metodo,
    url: URL,
    ...data,
    ...header
  });
}