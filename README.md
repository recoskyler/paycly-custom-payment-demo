# PayCly custom payment form demo

## Requirements

- PHP and Apache2/Nginx server, or VS Code with Docker/[Dev Containers extension](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)
- Patience

## Setup

### Traditional - using Apache2

1. Clone the repo to a directory where Apache2 can access
2. Create a new config file `/etc/apache2/sites-available/paycly.conf`
3. Paste the following inside the newly created config file, save and exit. You can also copy and paste the `.devcontainer/src/000-default.conf` file contents.

    ```conf
    ServerName localhost
    ErrorLog    /dev/stderr
    CustomLog   /dev/stdout combined
    TransferLog /dev/stdout

    # Expose minimal details in server header
    ServerTokens ProductOnly

    # Apache security settings HSTS, CSP, X-XSS-Protection, X-Frame-Options, X-Content-Type-Options, Referrer-Policy
    # See: https://webdock.io/en/docs/how-guides/security-guides/how-to-configure-security-headers-in-nginx-and-apache
    Header set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
    Header set X-XSS-Protection "1; mode=block"
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set Referrer-Policy "strict-origin"

    <VirtualHost *:80>
        DocumentRoot "/workspaces/vape-imperial"

        ServerName localhost
        DirectoryIndex index.php index.html

        <Directory "/workspaces/vape-imperial" >
            Options Indexes FollowSymLinks Includes execCGI
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
    ```

4. Disable any other sites which are using `localhost:80`. You can use `a2dissite CONFIG_NAME` command to do this.
5. Enable the new config using `a2ensite paycly.conf`
6. Create and fill the `.env` file: `cp sample.env .env`

### Modern - Dev Containers

**You should stop Nginx/Apache2 before this step, or disable any websites/processes that use `localhost:80` as it will prevent the container from starting successfully due to the port conflict**

1. Clone the repo
2. Open the newly cloned directory in VS Code
3. Install the [Dev Containers extension](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) extension, and Docker if you have not already
4. Click the **><** button on the bottom-left corner of the window
5. Choose the **Reopen in Container** option from the menu which opened
6. Wait until the container is set up
7. Create and fill the `.env` file: `cp sample.env .env`

## Usage

1. Open <http://localhost:80> on your browser. All fields will be pre-filled for your convenience. **Reference number** and the **bill amount** are randomly generated on page load.
2. Click **PAY NOW** and wait. This step will take a while due to the 💩 API
3. When the **3D Secure** page opens, enter `123456`. Type the numbers slowly as their UI is also 💩
4. You will see the **Payment Failed** page. If you read the *Reason* below, it will say `Test Transaction succeeded, we do not charge any fees for testing transaction`.
5. Click **Back to Merchant** button to see the SUCCESS page with all the info returned from the API

## About

By [recoskyler](https://github.com/recoskyler) - 2024
