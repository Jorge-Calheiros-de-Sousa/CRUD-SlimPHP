const show = {
  input: "",
  cont: 0,

  show(input) {
    this.input.setAttribute("type", "text");
  },
  hide(input) {
    this.input.setAttribute("type", "password");
  },
  init(input) {
    this.input = input
    if (this.cont == 0) {
      this.show();
      this.cont = 1;
    } else {
      this.hide();
      this.cont = 0;
    }
  }
}
function list_name_user(value) {
  let nome = document.getElementById("nome");
  let email = document.getElementById("email");

  if (nome != null) {
    nome.setAttribute("value", value.user);
  } else if (email != null) {
    email.setAttribute("value", value.email);
  }
}

function list_values_user(dados) {
  let user = document.getElementById("td_user");
  let email = document.getElementById("td_email");
  let password = document.getElementById("td_password");
  let btn_excluir = document.getElementById("excluir");
  let btn_logout = document.getElementById("logout");

  inser.inser(user, dados.user, {
    action: "onclick",
    fun: "redirect_listeners(null, 'editar-nome/')",
    txt: "Editar",
    class: "btn_editar"
  });

  inser.inser(email, dados.email, {
    action: "onclick",
    fun: "redirect_listeners(null, 'editar-email/')",
    txt: "Editar",
    class: "btn_editar"
  });

  inser.inser_password(password, {
    action: "onclick",
    fun: "redirect_listeners(null, 'editar-senha/')",
    txt: "Editar",
    class: "btn_editar"
  })

  btn_excluir.addEventListener("click", function () {
    destroy(dados.id);
  })

  logout("logout", "@token", null, url + "login/");
}

const inser = {
  btn: "",
  btni: "",
  input: "",
  i: "",


  inser_password(dad, btn) {

    this.btn = document.createElement("button");
    this.btn.setAttribute(btn.action, btn.fun);
    this.btn.setAttribute("class", btn.class);
    this.btn.innerText = btn.txt;
    dad.appendChild(this.btn);
  },
  inser(dad, value, btn) {
    dad.innerText = value;

    this.btn = document.createElement("button");
    this.btn.setAttribute(btn.action, btn.fun);
    this.btn.setAttribute("class", btn.class);
    this.btn.innerText = btn.txt;
    dad.appendChild(this.btn);
  }
}
function element_display(id, element, status) {
  document.getElementById(id).addEventListener("click", function () {
    element.style.display = status;
  })
}

function tbody_values(id, values) {
  tbody.init(id, values);
}

const tbody = {

  tb: "",
  tr: "",
  td: "",
  value: "",

  init(id, values) {
    this.tb = document.getElementById(id);
    this.value = values;

    this.tr = document.createElement("tr");

    this.inser_td_and_value();

    this.tb.appendChild(this.tr);
  },

  inser_td_and_value() {
    for (let i = 0; i < this.value.length; i++) {
      this.td = document.createElement("td");

      this.td.innerText = this.value[i];

      this.tr.appendChild(this.td);
    }
  },
}

function logout(id, name, token, rota) {
  document.getElementById(id).addEventListener("click", function () {
    if (name == null) {
      localStorage.setItem(name, null);
    } else {
      localStorage.setItem(name, token);
    }
    window.location.href = rota;
  })
}