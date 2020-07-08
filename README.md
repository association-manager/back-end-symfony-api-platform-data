
##Installation

To install all packages
````bash
composer install
````

##For Environmental Variable

### Mysql in local System
Copy and paste .env file as .env.local as change credential of your database 

### Generate the SSH keys:

In below configuration system request you to enter pass phrase key
for that please copy JWT_PASSPHRASE from .env.local file

For this step, launch the terminal (for windows)
````bash
mkdir config\jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
````
 
For this step, launch the terminal (for mac or linux)
````bash
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
````

### Add the Google DNS to use gmail same as .env in your .env.local:
###> symfony/mailer ###
MAILER_DSN=gmail://asso.manage@gmail.com:dslmkubjzqnqkyoj@localhost
###< symfony/mailer ###

### Look at the Controller folder to see our different possible routes for connection with the session for the Advertisement Management only :
###> symfony/controller ###
src/Controller/xxx...Controllers.php
###> symfony/controller ###

### To seed the data for fist time in your system
````bash
composer run load-data
````

### To Execute test
- Need to install phpdbg in your system
````bash
composer run test
````
- To can find the coverage report in var/log/index.html
