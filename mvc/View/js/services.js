xhr = new XMLHttpRequest;
function destroy(id) {
  const params = {
    ID: id
  }
  makeRequest(routes.users, 'delete', { params: params })
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
  const params = {
    ID: id
  }
  makeRequest(routes.users, 'get', { params: params })
    .then(function (response) {
      change_input(response.data[0]);
    }).catch(function (response) {
      console.log(response);
    })
}
window.onload = function list() {
  xhr.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        let tb = document.getElementById('tb');
        if (xhr.responseText == "") {

        } else {
          var array = JSON.parse(xhr.responseText);
          for (let i = 0; i < array.length; i++) {
            tr = document.createElement("tr");
            tds.InserTD_name(tr, array[i]['name_user']);
            tds.InserTD_year(tr, array[i]['yearOld_user']);
            tds.InserTD_btn(tr, array[i]['id']);
            tb.appendChild(tr);
          }
        }
      } else if (xhr.status == 400) {
        console.log("file or resource not found");
      }
    };
  }
  xhr.open('get', routes.users, true);
  xhr.send();
}
function create(params) {
  makeRequest(routes.users, 'post', { data: params })
    .then(function (response) {
      if (response.status == 201) {
        alert("Usuário cadastrado com sucesso");
      }
      window.location.reload(1);
    }).catch(function () {
      console.log("erro");
    })
}
function update(params, id) {
  makeRequest(routes.users + "?ID=" + id, 'put', { data: params })
    .then(function (response) {
      if (response.status == 202) {
        alert("Usuário editado com sucesso");
      }
      window.location.reload(1);
    }).catch(function () {
      console.log("erro");
    })
}