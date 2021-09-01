var url = "URL";
var host = url;

function getRoutes() {
  return {
    users: host + "api/v1/users",
    auth: host + "api/v1/auth"
  }
}
const routes = getRoutes();