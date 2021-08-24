function destroy(id) {
  makeRequest(routes.users + "/" + id, 'DELETE')
    .then(function (response) {
      if (response.status == 204) {
        alert("Usuário excluido com sucesso");
      }
      window.location.reload(1)
    }).catch(function () {
      console.log("erro");
    })
}
function Getuser(id) {
  makeRequest(routes.users + "/" + id, 'GET')
    .then(function (response) {
      change_input(response.data[0]);
    }).catch(function (response) {
      console.log(response);
    })
}

window.onload = function list() {
  makeRequest(routes.users, "GET")
    .then(function (response) {
      let tb = document.getElementById('tb');
      let size = Object.keys(response.data);
      for (let i = 0; i < size.length; i++) {
        tr = document.createElement("tr");
        tds.InserTD_name(tr, response.data[size[i]].name);
        tds.InserTD_year(tr, response.data[size[i]].year_old);
        tds.InserTD_btn(tr, response.data[size[i]].id);
        tb.appendChild(tr);
      }
    }).catch(function (response) {
      console.log(response);
    })
}
function create(params) {
  makeRequest(routes.users, 'POST', { data: params })
    .then(function (response) {
      if (response.status == 201) {
        alert("Usuário cadastrado com sucesso");
      }
      window.location.reload(1)
    }).catch(function () {
      console.log("erro");
    })
}
function update(params, id) {
  makeRequest(routes.users + "/" + id, 'PUT', { data: params })
    .then(function (response) {
      if (response.status == 202) {
        alert("Usuário editado com sucesso");
      }
      window.location.reload(1)
    }).catch(function () {
      console.log("erro");
    })
}