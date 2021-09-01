function validar_cadastro() {
  let name = document.getElementById("Name");
  let email = document.getElementById("Email");
  let senha = document.getElementById("Senha");
  let repsenha = document.getElementById("RepSenha");
  if (name.value == "" || name.value.length < 2) {
    alert("Preencha o campo de nome corretamenteo");
    return false;
  } else if (email.value == "" || email.value.length < 2) {
    alert("Preencha o campo de email corretamenteo");
    return false;
  } else if (senha.value.length < 5) {
    alert("A senha deve conter 5 ou mais caracteres");
    return false;
  } else if (senha.value != repsenha.value) {
    alert("As senhas não corresondem ");
    return false;
  }
  const dados = {
    nome: name.value,
    email: email.value,
    senha: senha.value
  }

  create(dados);
  return false;
}

function validar_login() {
  let name = document.getElementById("Name");
  let senha = document.getElementById("Senha");

  if (name.value == "" || name.value.length < 2) {
    alert("Preencha o campo de nome corretamenteo");
    return false;
  } else if (senha.value.length < 5) {
    alert("A senha deve conter 5 ou mais caracteres");
    return false;
  }

  const dados = {
    nome: name.value,
    senha: senha.value
  }
  login(dados);
  return false;
}

function validar_login_adm() {
  let name = document.getElementById("Name");
  let senha = document.getElementById("Senha");


  if (name.value == "" || name.value.length < 2) {
    alert("Preencha o campo de nome corretamenteo");
    return false;
  } else if (senha.value.length < 5) {
    alert("A senha deve conter 5 ou mais caracteres");
    return false;
  }
  const dados = {
    nome: name.value,
    senha: senha.value
  }

  loginAdmin(dados);

  return false;
}

function validar_nome_editar() {
  let name = document.getElementById("nome");
  let pass = document.getElementById("senha");

  if (name.value == "" || name.value.length < 2) {
    alert("Preencha o campo de nome corretamente");
    return false;
  } else if (pass.value == "" || pass.value.length < 5) {
    alert("Senha incorreta");
    return false;
  } else {
    const dados = {
      nome: name.value,
      senha: pass.value,
    }
    editar_nome(dados);
  }

  return false;
}

function validar_email_editar() {
  let email = document.getElementById("email");
  let pass = document.getElementById("senha");

  if (email.value == "" || email.value.length < 2) {
    alert("Preencha o campo de email corretamente");
    return false;
  } else if (pass.value == "" || pass.value.length < 5) {
    alert("Senha incorreta");
    return false;
  } else {
    const dados = {
      email: email.value,
      senha: pass.value,
    }
    editar_email(dados);
  }
  return false;
}

function validar_senha_editar() {
  let senha = document.getElementById("senhaNova");
  let pass = document.getElementById("senha");

  if (senha.value == "" || senha.value.length < 5) {
    alert("Insira uma senha cinco ou mais caracteres");
    return false;
  } else if (pass.value == "" || pass.value.length < 5) {
    alert("Senha incorreta");
    return false;
  } else {
    const dados = {
      senhaNova: senha.value,
      senha: pass.value,
    }
    editar_senha(dados);
  }

  return false;
}