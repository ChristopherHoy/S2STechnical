
# Design Considerations:
* **The use of Laravel:**
I chose to use Laravel for the project because this is what I am used to, and I quite enjoy working with it. Additionally, I believe that Laravel scales well and is very simple to use and maintain.
* **MVC Design Pattern:**
Laravel is built to follow the MVC pattern, and using it with the application streamlines the application build process. Additionally, this pattern is well-defined and easy to follow, so it keeps the code base neat and consistent. It keeps the different components separate: models manage the databases and controllers manage the requests and responses. There is, however, no "view" in this project as it is a JSON REST API.
* **Rewriting the error handler:**
I have rewritten the default Laravel error handler to return JSON error messages instead of the default HTML response. This ensures that all errors are handled the same and return a JSON object with error details and a status code.
* **Response Objects:**
I have created response objects to handle the responses. This increases the structure of the API and keeps the responses predictable.
* **Validatable:**
I have created a custom request object that is used in all the controllers. This increases the details on the error and helps maintain the structure of the code.
* **The use of MySQL**: Most of my experience has been with MySQL. It is easy to install and use, It is a robust, fast and highly scalable database with additional security features such as encryption and authentication plugins.

# Setup:
* See SETUP.md for setup instructions
