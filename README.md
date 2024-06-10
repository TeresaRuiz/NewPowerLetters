# NewPowerLetters
<!-- no hacer caso -->
*Estandares usados en php*:
Organización del código: El código está organizado en bloques de acciones separados por comentarios, lo que facilita la comprensión y el mantenimiento del código.

Uso de clases y métodos: Se utiliza la programación orientada a objetos, donde se definen clases como PedidoData y métodos para realizar acciones como createDetail, readDetail, updateDetail, etc.

Manejo de sesiones: Se utiliza session_start() para iniciar o reanudar una sesión, y se verifica si hay una sesión iniciada para permitir ciertas acciones.

Validación de datos: Se utiliza un método llamado Validator::validateForm() para validar los datos recibidos a través de $_POST, lo que ayuda a prevenir posibles vulnerabilidades de seguridad.

Mensajes de error y excepciones: Se proporcionan mensajes de error claros para informar al usuario sobre problemas que puedan surgir durante la ejecución del script. Además, se manejan excepciones a través de la clase Database, lo que mejora la robustez del código.


*Estandares usados en js*

Uso de constantes: Se utilizan constantes para almacenar rutas de la API, referencias a elementos DOM y el modal, lo que facilita la reutilización y la comprensión del código.

Manejo de eventos: Se utiliza el método addEventListener() para manejar eventos como la carga del documento (DOMContentLoaded) y el envío de formularios. Esto sigue el paradigma de programación basado en eventos común en JavaScript.

Uso de funciones asincrónicas: Se emplean funciones asincrónicas (async function) para realizar operaciones que involucran llamadas a la API y esperas de respuesta. Esto permite que el código JavaScript siga ejecutándose mientras se espera una respuesta del servidor.

Modularidad: Se define una variedad de funciones para realizar tareas específicas, como abrir y cerrar el modal, mostrar detalles del carrito de compras, enviar formularios, etc. Esto mejora la legibilidad y la mantenibilidad del código al dividirlo en unidades lógicas más pequeñas.

Manejo de errores y mensajes de alerta: Se utiliza una función sweetAlert() para mostrar mensajes de éxito o error al usuario, lo que mejora la experiencia del usuario y proporciona retroalimentación clara sobre el resultado de las operaciones.

Interacción con el DOM: Se manipula el DOM para actualizar elementos HTML con datos dinámicos obtenidos de la API, como la tabla de detalles del carrito de compras y el total a pagar.

*Estandares usados en html*
Estructura básica HTML5: El documento comienza con <!DOCTYPE html> seguido de las etiquetas <html>, <head> y <body>, que siguen las convenciones de HTML5.

Metaetiquetas: Se incluyen metaetiquetas para especificar la codificación (charset) y la vista del dispositivo (viewport), lo que ayuda a garantizar una correcta representación y comportamiento en diferentes dispositivos y navegadores.

Enlaces a recursos externos: Se enlazan archivos CSS y JavaScript externos utilizando las etiquetas <link> y <script>, respectivamente. Esto permite mantener el código HTML más limpio y modular, facilitando su mantenimiento.

Estilos en línea y en hojas de estilo: Aunque hay estilos en línea en algunas partes del documento HTML, también se enlazan hojas de estilo externas para mantener la separación entre la estructura del documento y su presentación.

Uso de clases y estilos CSS personalizados: Se definen clases CSS personalizadas para estilizar elementos HTML, lo que promueve la reutilización y la coherencia en el diseño.

Semántica HTML: Se utilizan elementos semánticos HTML5 como <header>, <main>, <section>, <table>, <form>, <p>, <button>, etc., lo que mejora la accesibilidad y la comprensión del contenido por parte de los motores de búsqueda y los lectores de pantalla.

JavaScript integrado: Se incluyen scripts JavaScript directamente en el documento HTML utilizando la etiqueta <script>. Sin embargo, también se enlazan archivos JavaScript externos para mantener el código más modular y organizado.

Comentarios descriptivos: Se utilizan comentarios HTML y CSS para proporcionar información adicional sobre la estructura y el propósito de diferentes partes del código, lo que facilita su comprensión y mantenimiento.


