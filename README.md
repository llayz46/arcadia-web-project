# Arcadia

![Static Badge](https://img.shields.io/badge/MADES_WITH-MYSQL-%234479a1?style=for-the-badge&labelColor=%236ca4cc&link=llayz.fr) ![Static Badge](https://img.shields.io/badge/MADES_WITH-PHP-%2345a4b8?style=for-the-badge&labelColor=%2338c1d0&link=llayz.fr) ![Static Badge](https://img.shields.io/badge/MADES_WITH-BOOTSTRAP_5-%238511fa?style=for-the-badge&labelColor=%23a652f9&link=llayz.fr)

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

1.  **Clone the repository:** Clone the ADEFINIR repository from GitHub to your local machine:

    - Open your terminal or command prompt and use the following command to clone the Arcadia repository:

        ```
        git clone https://github.com/llayz46/arcadia-web-project.git
        ```

1.  **Create a local domain:** Create a domain for running the project locally:

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

2.  **Adding Virtual Host on your Apache Server**

    ### WAMP:

    3.1. **Open the httpd-vhosts.conf file:** Navigate to the httpd-vhosts.conf file located at `C:\wamp64\bin\apache\apache2.4.58\conf\extra\httpd-vhosts.conf`.

    3.2. **Edit the hosts file:** Open the hosts file with a text editor that has administrative privileges.

    3.3. **Adapt and add the following configuration:** Adapt the following configuration and add it to tell your Apache server where to point:

        <VirtualHost *:80>
            DocumentRoot "C:\wamp64\www\my_project"
            ServerName myproject.local
        </VirtualHost>

    ### XAMPP:

    3.1. **Open the httpd-vhosts.conf file:** Navigate to the httpd-vhosts.conf file located at `C:\xampp\apache\conf\extra\httpd-vhosts.conf`.

    3.2. **Edit the hosts file:** Open the hosts file with a text editor that has administrative privileges.

    3.3. **Adapt and add the following configuration:** Adapt the following configuration and add it to tell your Apache server where to point:

        <VirtualHost *:80>
            DocumentRoot "C:\xampp\htdocs\my_project"
            ServerName myproject.local
        </VirtualHost>

3.  **Install PHP extensions:**

    4.1. **Extension directory:** In first you'll to open the extension directory of your local server.

    ### WAMP:

    On wamp, you'll find the extension directory at `C:\wamp64\bin\php\<your_php_version>\ext`.

    ### XAMPP:

    On xampp, you'll find the extension directory at `C:\xampp\php\ext`.

    4.2. **MongoDB extension:** Download the MongoDB PHP extension for your PHP version from this link : `https://github.com/mongodb/mongo-php-driver/releases/tag/1.19.0`. Once you downloaded, drag the `php_mongodb.dll` file into the extension directory.

    4.3. **Activate the extensions:** Edit `php.ini` extension my adding this line : 
    - extension=php_mongodb.dll

    ### WAMP:

    On xampp, the php.ini file is located at : `C:\wamp64\bin\php\<your_php_version>`

    ### XAMPP:

    On xampp, the php.ini file is located at : `C:\xampp\php\php.ini`

4.  **Create the relational database**

    5.1. **Go to phpMyAdmin:** Ensure your local server is running, then open your web browser and enter the following URL : `localhost/phpmyadmin/`. Log in to access your phpMyAdmin panel.

    5.2. **Create a new database:** On the left panel, click on "New database" and enter a name for your database.

    5.3. **Import data:** Once you created the database, in the top menu, click on "Import", then import the file `arcadia.sql` from the project.

5.  **Create the non relational database**

    6.1. **Install MongoDB:** In your web browser, navigate to this URL : `https://www.mongodb.com/try/download/community` and download MongoDB for your operating system by following the instructions on the website. Please don't forget to install MongoDB Compass during the installation.

    6.2. **Create a new database & collection:** Connect to the localhost and then click on create Database. Enter a database and collection name.

6.  **Install SplideJS dependency**

    - **Terminal command:** Run the following command in your terminal : 

        npm install @splidejs/splide

7.  **Install Composer dependencies**

    8.1. **Create composer.json file:** At the root of the project, create a composer.json file and write this: 

        {
            "require": {
                "mongodb/mongodb": "^1.17",
                "azure/storage-blob": "dev-master"
            }
        }

    8.2. **Install the dependencies:** In your terminal run the following command and follow the composer instructions :

        composer install

8.  **Modify the config:**

    - **Open and edit the config.php file:** In `lib/config.php` file, make all the necessary modifications.

## Deployment

How to launch project

## Built with

- [WAMP](https://www.wampserver.com/) - Dependency Management
- [VSCode](https://code.visualstudio.com/) - Integrated Development Environment
- [Bootstrap5](https://getbootstrap.com/) - CSS Framework (front-end)

## Authors

- **layz** _alias_ [@llayz46](https://github.com/llayz46)
