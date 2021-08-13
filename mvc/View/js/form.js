function validation(type, id) {
  let name = document.getElementById('name');
  let yearOld = document.getElementById('year');
  if (name.value == "" || name.value.length < 2) {
    alert("Preencha o campo de nome corretamente");
    return false;
  } else if (yearOld.value < 0 || yearOld.value > 120 || yearOld.value.length == 0) {
    alert("Preencha o campo de idade corretamente");
    return false;
  } else {
    if (type == "c" && id == 0) {
      const params = {
        ID: 0,
        Name: name.value,
        YearOld: yearOld.value
      }
      create(params);
    } else {
      const params = {
        Name: name.value,
        YearOld: yearOld.value
      }
      update(params, id);
    }
  }
  return false;
}
function change_Function_of_Form(id, type) {
  if (type == "update") {
    document.getElementById('form').setAttribute("onsubmit", "return validation('u'," + id + ")");
  }
}
function change_input(dados) {
  let nome = document.getElementById('name');
  let year = document.getElementById('year');
  let h1 = document.getElementById('title');
  let submit = document.getElementById('submit');
  nome.value = dados.name;
  year.value = dados.year_old;
  h1.innerHTML = "Editar usuario";
  submit.value = "Editar";
  change_Function_of_Form(dados.id, "update");
}