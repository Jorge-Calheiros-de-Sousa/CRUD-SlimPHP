var url = window.location.href;
var host = url;

function getRoutes() {
  return {
    users: host + "api/v1/users"
  }
}
const routes = getRoutes();