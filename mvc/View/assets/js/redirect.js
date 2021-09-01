function redirect_listeners(id, rota) {
  if (id != null) {
    for (let i = 0; i < id.length; i++) {

      document.getElementById(id[i]).addEventListener("click", function () {
        window.location.href = url + rota;
      });
    }
  } else {
    window.location.href = rota;
  }
}