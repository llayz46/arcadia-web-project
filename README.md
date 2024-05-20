# Arcadia

![Static Badge](https://img.shields.io/badge/MADES_WITH-MYSQL-%234479a1?style=for-the-badge&labelColor=%236ca4cc&link=llayz.fr) ![Static Badge](https://img.shields.io/badge/MADES_WITH-MONGODB-%2300ED64?style=for-the-badge&labelColor=0DAA4F&link=llayz.fr) ![Static Badge](https://img.shields.io/badge/MADES_WITH-PHP-%2345a4b8?style=for-the-badge&labelColor=%2338c1d0&link=llayz.fr) 

Arcadia is a web application designed for zoo management. It provides an intuitive interface for managing various aspects such as services, habitats, animals and more.

## Getting Started

To get started with Arcadia, follow these steps:

### Prerequisites

Before diving into Arcadia, ensure you meet the following requirements :

- A local server such as WAMP, XAMPP, or equivalent.
- PHP 8 or higher installed on your system.
- GIT.
- NPM.
- Composer.

### Installation

Follow these steps to install and set up Arcadia on your development environment:

1.  **Clone the repository:** Clone the repository from GitHub to your local machine:

    - Open your terminal or command prompt and use the following command to clone the Arcadia repository:

        ```
        git clone https://github.com/llayz46/arcadia-web-project.git
        ```

2.  **Create a local domain:** Create a domain for running the project locally:

    ### Windows:

    2.1. **Open the hosts file:** Navigate to the hosts file located at `C:\Windows\System32\drivers\etc\hosts`.

    2.2. **Edit the hosts file:** Open the hosts file with a text editor that has administrative privileges.

    2.3. **Add a new line:** Add the following line to define your local domain:

        127.0.0.1 myproject.local

        Replace `myproject.local` with the desired domain name for your project.

    2.4. **Save the hosts file:** After adding the new line, save the hosts file.

    2.5. **Flush DNS cache (optional):** To ensure immediate effect, flush the DNS cache by opening Command Prompt as administrator and running:

        ipconfig /flushdns

    ### macOS and Linux:

    For macOS and Linux distributions, you can achieve the same result by following similar steps. Here's a general guide:

    2.1. **Open the hosts file:** Navigate to the hosts file located at `/etc/hosts`.

    2.2. **Edit the hosts file:** Open the hosts file with a text editor with administrative privileges.

    2.3. **Add a new line:** Add the following line to define your local domain:

        127.0.0.1 myproject.local

        Replace `myproject.local` with the desired domain name for your project.

    2.4. **Save the hosts file:** After adding the new line, save the hosts file.

3.  **Adding Virtual Host on your Apache Server**

    ### WAMP:

    3.1. **Open the httpd-vhosts.conf file:** Navigate to the httpd-vhosts.conf file located at `C:\wamp64\bin\apache\<apache_version>\conf\extra\httpd-vhosts.conf`.

    3.2. **Edit the hosts file:** Open the hosts file with a text editor that has administrative privileges.

    3.3. **Adapt and add the following configuration:** Adapt the following configuration and add it to tell your Apache server where to point:

        <VirtualHost *:80>
            DocumentRoot "C:\wamp64\www\my_project"
            ServerName myproject.local
        </VirtualHost>

    3.4. **Error Forbidden 403 (optional):** If you encounter the 403 Forbidden error, you can try to open the httpd.conf file at `C:\wamp64\bin\apache\<apache_version>\conf\httpd.conf` and replace "require local" on line 268 and 311 by "require all granted".

    ### XAMPP:

    3.1. **Open the httpd-vhosts.conf file:** Navigate to the httpd-vhosts.conf file located at `C:\xampp\apache\conf\extra\httpd-vhosts.conf`.

    3.2. **Edit the hosts file:** Open the hosts file with a text editor that has administrative privileges.

    3.3. **Adapt and add the following configuration:** Adapt the following configuration and add it to tell your Apache server where to point:

        <VirtualHost *:80>
            DocumentRoot "C:\xampp\htdocs\my_project"
            ServerName myproject.local
        </VirtualHost>

    3.4. **Error Forbidden 403 (optional):** If you encounter the 403 Forbidden error, you can try to open the httpd.conf file at `C:\xampp\apache\conf\httpd.conf` and replace "require local" on line 268 and 311 by "require all granted".

4.  **Install PHP extensions:**

    4.1. **Extension directory:** In first you'll to open the extension directory of your local server.

    4.2. **MongoDB extension:** Download the MongoDB PHP extension for your PHP version from this link : `https://github.com/mongodb/mongo-php-driver/releases/tag/1.19.0`. Once you downloaded, drag the `php_mongodb.dll` file into the extension directory.

    4.3. **Activate the extensions:** Edit `php.ini` extension my adding this line : 
    - extension=php_mongodb.dll

    ### WAMP:

    On wamp, you'll find the extension directory at `C:\wamp64\bin\php\<your_php_version>\ext` and the php.ini file is located at : `C:\wamp64\bin\php\<your_php_version>`.

    ### XAMPP:

    On xampp, you'll find the extension directory at `C:\xampp\php\ext` and the php.ini file is located at : `C:\xampp\php\php.ini`.

6.  **Create the relational database**

    5.1. **Go to phpMyAdmin:** Ensure your local server is running, then open your web browser and enter the following URL : `localhost/phpmyadmin/`. Log in to access your phpMyAdmin panel.

    5.2. **Create a new database:** On the left panel, click on "New database" and enter a name for your database.

    5.3. **Import data:** Once you created the database, in the top menu, click on "Import", then import the file `arcadia.sql` from the project.

7.  **Create the non relational database**

    6.1. **Install MongoDB:** In your web browser, navigate to this URL : `https://www.mongodb.com/try/download/community` and download MongoDB for your operating system by following the instructions on the website. Please don't forget to install MongoDB Compass during the installation.

    6.2. **Create a new database & collection:** Connect to the localhost and then click on create Database. Enter a database and collection name.

8.  **Install SplideJS dependency**

    - **Terminal command:** Run the following command in your terminal : 

        ```
        npm install @splidejs/splide
        ```

9.  **Install Composer dependencies**

    8.1. **Create composer.json file:** At the root of the project, create a composer.json file and write this: 

        {
            "require": {
                "mongodb/mongodb": "^1.17",
                "azure/storage-blob": "dev-master"
            }
        }

    8.2. **Install the dependencies:** In your terminal run the following command and follow the composer instructions :

    composer install

11.  **Modify the config:**

- **Open and edit the config.php file:** In `lib/config.php` file, make all the necessary modifications.

11.  **Users:**

- **Admin account:** user@test.fr:test
- **Veterinaire account:** veto@veto.fr:test
- **Employe account:** employe@employe.fr:test

## Deployment

How to launch project

## Built with

- [WAMP](https://www.wampserver.com/) - Local server
- [VSCode](https://code.visualstudio.com/) - Integrated Development Environment
- [PHP](https://www.php.net/) - Programmation langage (back-end)
- [MySQL](https://www.mysql.com/fr/) - Relational Database Management System (RDBMS)
- [MongoDB](https://www.mongodb.com/fr-fr) - NoSQL Database Management System (DBMS)
- [Heroku](https://www.heroku.com/) - Cloud platform for web deployment
- [AzureBlob](https://azure.microsoft.com/fr-fr/) - Online file storage

## Authors

- **layz** _alias_ [@llayz46](https://github.com/llayz46)
