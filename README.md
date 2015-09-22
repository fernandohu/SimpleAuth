# SimpleAuth
This project can be used to help create a login system in websites.

## Features

* Simple to use
* Namespace support: you can use it with multiple projects at the same time. Using different keys will guarantee the values does not mix between sites - setNamespace(), getNamespace().
* Custom save handler: you can use custom save handlers to override Php's default session file handler - setCustomSaveHandler().
* Login and logout: use these methods to login and logout users from your website - login(), logout().
* Login verification: use this method to verify if the user is logged in or out - isLogged().
* Read and write user data: you can set and retrieve session data - getData(), setData(), getValue(), setValue().
* Session regeneration: you can regenerate the session id to keep the site secure - changeSessionId(), getSessionId().
* Custom session name: You can change PHP's default session variable name (PHPSESSID) - setSessionName(), getSessionName().
* 100% Compatible with PHP's session: you can still use the Php's session built in functions while using this class.

## Example

To run the example do the following:

a) Open the terminal and go to /examp le folder

b) Run a webserver with the command:

<code>php -S localhost:8088</code>

c) Open the example in a web browser: http://localhost:8088

d) Use 'login' and 'logout' buttons.

e) When logged in, refresh the page to see that the user session is kept between requests.
