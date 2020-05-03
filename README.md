"# bankEndSymfonyAM" 

###Installation

To install all packages
````bash
composer install
````

##For Environmental Variable

# Mysql in local System
Copy and paste .env file as .env.local as change credential of your database 

# To seed the data for fist time in your system
````bash
composer run load-data
````

## To Execute test
- Need to install phpdbg in your system
````bash
composer run test
````
- To can find the coverage report in var/log/index.html
