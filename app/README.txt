Estructura MVC de app/

controllers/  Un archivo por controlador. El nombre del archivo coincide con
              el de la clase (AuthController.php -> class AuthController).
              Reciben la petición, hablan con los models y eligen qué view
              devolver. No arman HTML acá.

models/       Acceso a datos (mysqli). Un archivo por entidad
              (UserModel.php -> class UserModel). No conocen HTML ni $_POST.

views/        Solo HTML/PHP de presentación. views/layout/header.php y
              footer.php son el shell compartido (doctype, <head>,
              apertura/cierre de <body>); las demás views los incluyen con
              require_once __DIR__ . '/../layout/header.php' (y footer.php)
              en vez de duplicar el <head> en cada archivo.

public/       Assets estáticos (css/, js/). Nada de PHP acá.

Todavía no hay front controller (router ?c=&a=): los controllers están
armados para ese patrón (ver los require_once y los header('Location: ...')
en AuthController), pero por ahora hay que invocarlos a mano hasta que se
sume ese router.
