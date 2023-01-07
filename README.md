# Project Database Application Management - E3T
Team IT1A / Period 2

## Project Description
This project was commissioned by EvenTTalentT, a new event- and talent-management agency, in cooperation with the Municipality of Emmen, to realize an information system that helps in the promotion of new events and the recruitment of new talents.  

E3T is an organization focused on event management, and they have expressed a motivation to facilitate new events in the Emmen area, their profile also includes private events like weddings or birthday parties. The other branch of the agency is the tasked with the discovery and recruitment of talented individuals, providing them with a contract and leasing them to their own, or third-party events as performers. 

## Team members:
* Bohdan Zakusylo - Team Leader
* Ada Bilici - Secretary
* Michael Ehiosumwen - Quality Control Checker
* Peter Rubint - Server Manager
* Gerald Atumah - Team Member
* Ioan Mich - Team Member

## Running
### Software
* **XAMPP**
    - `htdoc` directory
* **Docker**
    - open Command Prompt and run `docker-compose up` while in the root directory of this project. The port 80 will be exposed and accessible via the browser (http://localhost:80/).
* **WAMP**
    - store files in the `WWW` directory
* **phpMyAdmin**
    - access to database
### Reference software documentation
* [XAMPP](https://www.apachefriends.org/docs/)
* [Docker](https://docs.docker.com/)
* [WAMP](https://www.wampserver.com/en/category/documentation-en/)
* [phpMyAdmin](https://www.phpmyadmin.net/docs/)

## Structure
```
.idea
    README.md
    .gitgnore
    E3T.iml
    dataSources.xml
    modules.xml
    php.xml
    vcs.xml
    .DS_Store
    .env
    .swp
    custom.php.ini
    docker-compose.yaml
    nginx.conf
    nginx.dockerfile

src
    calendar.php
    edit-profile.php
    admin-dashboard.php
    admin-login.php
    contact-us.php
    events.php
    index.php
    login.php
    process-login.php
    talent-dashboard.php
    talents.php
    change-password.php
    confirmation.php
    event-info.php
    process-login.php
    request-process.php
    requests.php
    manage_events.php
    profile-img.php

css
    admin-dashboard.css
    admin-login.css
    contact-us.css
    edit-profile.css
    events.css
    global.css
    index.css
    login.css
    portfolio.css
    style.css
    swiper-bundle.min.css
    talent-dashboard.css
    talents.css
    change-password.css
    confiramtion.css
    event-info.css
    requests.css

img
    logo.png
    banner.png
    favicon.ico

js
    script.js
    swiper-bundle.min.js

database
    E3T.sql

components
    header.php
    footer.php
    db_connection.php
    portfolio.php

```

## Build with

### Programming languages
* PHP
* HTML/CSS
* JavaScript

### Server Environment
* [Proxmox Virtual Environment](https://www.proxmox.com/en/)
* **Windows Server**
    - DHCP
    - Active Directory
* **Ubuntu Server**
    - Linux
    - Apache
    - MySQL
    - PHP
* **pfSense Firewall**
* **Windows 10 Client**
* **NGINX**

## Copyright
 © 2023 E3T, Inc. All rights reserved.