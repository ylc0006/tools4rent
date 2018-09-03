# tools4rent

A hypothetical national chain of tool rental stores, “Tools-4-Rent!”, has decided to try out a new online tools rental service for its Customers. They’ve already done an informal survey of their regular rental Customers and determined that the majority of them would be interested in online inventory and reservation services. At the same time, Tools-4-Rent! has decided to upgrade their entire paper record based tools rental service to improve efficiency in tracking a larger inventory. This project is the information management system that supports some of the services involved in the tools rental service.

## Overview

* tools4rent is a relational database management system.
* Detail of the database spec can be found within spec portfolio.
* Overview structure of tools4rent DB such as Information Flow Diagram, Enhanced Entity-Relation Diagram (EER) and EER to Relational Mapping can be found within structure porfolio.


## Installing

1. Download Bitnami (version 7.1) from following link: 
```
https://bitnami.com/stack/mamp for mac
https://bitnami.com/stack/wamp for windows
https://bitnami.com/stack/lamp for linux
```
2. Install Bitnami. During installation, it is required to set root account password.

3. Download the tools4rent repo and unzip folder into C:\Bitnami\wampstack-7.0.11-0\apache2\htdocs\

4. Launch Bitnami

5. Under Bitnami control panel, click Manage Servers Tab, and make sure MySQL Database and Apache Web Server are both running. If not, click restart button.

6. Under Bitnami control panel, click Welcome Tab, and then click Open phpMyadmin button. 

7. Enter the password for root user. Then you will enter phpMyAdmin web based utility.

8. Add a new username: "gatechUser" with password “gatech123” under phpMyAdmin User accounts tab.

9. Import SQL schema. Under import tab, choose following file and press go button.
```
C:\Bitnami\wampstack-7.0.11-0\apache2\htdocs\tools4rent\script\sql\schema.sql
```
10. Import dummy data. Under import tab, chooe following file and press go button.
```
C:\Bitnami\wampstack-7.0.11-0\apache2\htdocs\tools4rent\script\sql\dummy.sql
```
11. Restart your Apache server under Bitnami control panel: (here alternative http port 8080 is used)

12. http port can be configured under Manage Servers by selecting Apache Web Server, then click Configure button.

13. Launch the URL to initiate tools4rent login page. 
```
http://localhost:8080/tools4rent/script/login.php
```

## Running 

tools4rent can be login as clerk or customer.

### Clerk view
1. An example clerk ID is CS6400@tools4rent.com, with 0000 as password. 
2. After login, the system will prompt user to rest the password and login again. 
3. Clerk has the options to operate "Pick up Reservations", "Drop off Reservations", "Add New Tools", and "Generate Reports". (Detail of each functions can be found under spec/Tools-4-Rent!_Fall2017_FINAL)

### Customer view
1. An example customer ID is ylc0006@gmail.com, with 1234 as password. 
2. If the custoemr ID and password is not witin the existing database, system will prompt Customer Registration Form.
3. Customer has the options to operate "View Profile", "Check Tool Availbility", and "Make Reservation". (Detail of each functions can be found under spec/Tools-4-Rent!_Fall2017_FINAL)

## Authors

* **Chen, Yan-lin** - [Github](https://github.com/ylc0006/)
* **Suryabudi, Anthony**
* **Yu, Zhikang**

## Acknowledgments

* Georgia Tech CS6400 DB Sys Concepts& Design

