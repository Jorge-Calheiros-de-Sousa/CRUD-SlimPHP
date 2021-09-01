function header() {
  if (localStorage.getItem('@token') == "null") {
    window.location.href = url + "login/"
  }

  if (localStorage.getItem('@token') == null) {
    window.location.href = url + "login/"
  }
  const header = {
    'Authorization': "Bearer " + localStorage.getItem('@token')
  }

  return header;
}

function headerAdmin() {

  if (localStorage.getItem('@adm') == "null") {
    window.location.href = url + "adm/"
  }

  if (localStorage.getItem("@adm") == null) {
    window.location.href = url + "adm/"
  }
  const header = {
    'Authorization': "Bearer " + localStorage.getItem('@adm')
  }

  return header;
}