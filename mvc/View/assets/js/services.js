function create(params) {
  makeRequest(routes.auth + "/cadastrar/", 'POST', { data: params })
    .then(function (response) {
      if (response.status == 201) {
        alert("Cadastro feito com sucesso");
        window.location.href = url + "login/";
      } else {
        console.log(response);
      }
    }).catch(function (response) {
      alert("Erro ao seu cadastrar tente denovo");
      window.location.href = url + "cadastro/";
    })
}
function login(params) {
  makeRequest(routes.auth, 'POST', { data: params })
    .then(function (response) {
      if (response.status == 200) {
        localStorage.setItem('@token', response.data.token);
        window.location.href = url;
      }
    }).catch(function (response) {
      localStorage.setItem("@token", null);
      alert("Usuário ou senha incorretos, tente novamente");
    })
}
function loginAdmin(params) {
  makeRequest(routes.auth + "/adm/", "POST", { data: params })
    .then(function (response) {
      localStorage.setItem('@adm', response.data.token);
      window.location.href = url + "adm/home/";
    }).catch(function (response) {
      localStorage.setItem("@token", null);
      alert("Usuário ou senha incorretos, tente novamente");
    })
}
function list() {
  makeRequest(routes.users + "/all", "GET", { headers: headerAdmin() })
    .then(function (response) {
      let size = Object.keys(response.data);
      for (let i = 0; i < size.length; i++) {
        tbody_values("tbody", [response.data[size[i]].user, response.data[size[i]].email]);
      }
    }).catch(function (response) {
      console.log(response);
    })
}
function destroy(id) {
  makeRequest(routes.users + "/" + id, 'DELETE', { headers: header() })
    .then(function (response) {
      if (response.status == 204) {
        alert("Usuário excluido com sucesso");
        localStorage.setItem('@token', null);
        window.location.href = url + "login/";
      }
    }).catch(function () {
      console.log("erro");
    })
}
function get_jwt() {
  return makeRequest(routes.users, 'GET', { headers: header() });
}
function editar_nome(dados) {
  get_jwt().then(function (response) {
    let user = JSON.parse(response.data.jwt[0]).user;

    makeRequest(routes.users + "/" + user, "GET", { headers: header() })
      .then(function (response) {
        let id = response.data[0].id;
        if (id) {
          makeRequest(routes.users + "/editar-nome/" + id, "PUT", { data: dados }, { headers: header() })
            .then(function (response) {
              if (response.status == 202) {
                alert("Nome editado");
                login(dados);
              }
            }).catch(function (response) {
              alert("Senha incorreta, ou o nome já esta sendo usado, tente denovo");
            })
        }
      })
  }).catch(function (response) {
    console.log(response);
  })
}
function editar_email(dados) {
  get_jwt().then(function (response) {
    let user = JSON.parse(response.data.jwt[0]).user;

    makeRequest(routes.users + "/" + user, "GET", { headers: header() })
      .then(function (response) {
        let id = response.data[0].id;
        if (id) {
          makeRequest(routes.users + "/editar-email/" + id, "PUT", { data: dados }, { headers: header() })
            .then(function (response) {
              if (response.status == 202) {
                const login_data = {
                  nome: user,
                  senha: dados.senha
                }
                alert("Email editado")
                login(login_data);
              }
            }).catch(function (response) {
              alert("Senha incorreta");
            })
        }
      }).catch(function (response) {
        console.log(response);
      })
  })
}
function editar_senha(dados) {
  get_jwt()
    .then(function (response) {
      let user = JSON.parse(response.data.jwt[0]).user;

      makeRequest(routes.users + "/" + user, "GET", { headers: header() })
        .then(function (response) {
          let id = response.data[0].id;
          if (id) {
            makeRequest(routes.users + "/editar-senha/" + id, "PUT", { data: dados }, { headers: header() })
              .then(function (response) {
                const login_data = {
                  nome: user,
                  senha: dados.senhaNova
                }
                alert("Senha editada");
                login(login_data);
              }).catch(function (response) {
                console.log(response.status);
              })
          }
        }).catch(function (response) {
          alert("Senha incorreta");
        })
    }).catch(function (response) {
      console.log(response);
    })
}
function show_user() {
  if (header().Authorization != "Bearer null") {
    get_jwt().then(function (response) {
      let user = JSON.parse(response.data.jwt[0]).user;

      makeRequest(routes.users + "/" + user, "GET", { headers: header() })
        .then(function (response) {
          list_values_user(response.data[0]);
        })
    })
  }
}
function list_user_edit() {
  get_jwt().then(function (response) {
    let user = JSON.parse(response.data.jwt[0]).user;

    makeRequest(routes.users + "/" + user, 'GET', { headers: header() })
      .then(function (response) {
        list_name_user(response.data[0]);
      }).catch(function (response) {
        console.log(response);
      })
  })
}