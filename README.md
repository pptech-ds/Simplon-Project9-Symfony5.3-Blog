# Install For Ubuntu Users

## Install PHP (5.6, 7.x, 8.0) on Ubuntu Using PPA

1. First start by adding Ondřej Surý PPA to install different versions of PHP – PHP 5.6, PHP 7.x, and PHP 8.0 on the Ubuntu system.

```console
sudo apt install python-software-properties
sudo add-apt-repository ppa:ondrej/php
```

2. Next, update the system as follows.

```console
sudo apt-get update
```

3. Now install different supported versions of PHP as follows. For Apache Web Server (example here for 7.4)

```console
sudo apt install php7.4
```

4. To install any PHP modules, simply specify the PHP version and use the auto-completion functionality (tab) to view all modules as follows.

```console
sudo apt install php7.4(tab)
```

5. Finally, verify your default PHP version used on your system like this.

```console
php -v
```

6. You can set the default PHP version to be used on the system with the update-alternatives command, after setting it, check the PHP version to confirm as follows.

```console
sudo update-alternatives --set php /usr/bin/php5.6
```

7. To set the PHP version that will work with the Apache web server, use the commands below. First, disable the current version with the a2dismod command and then enable the one you want with the a2enmod command.

```console
sudo a2dismod php7.4
```

```console
sudo a2enmod php7.4
```

8. After switching from one version to another, you can find your PHP configuration file, by running the command below.

```console
sudo update-alternatives --set php /usr/bin/php7.4
php -i | grep "Loaded Configuration File"
```

## Install composer

All details in [this page](https://getcomposer.org/download/)  
Move into a temporary directory and the following command lines:

```console
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
composer self-update
```

## Install Symfony

All details in [this page](https://symfony.com/download)

1. Move into a temporary directory and the following command lines:

```console
wget https://get.symfony.com/cli/installer -O - | bash
```

2. Add Symfony command into your env (for our needs choose the 3rd choice):

- Use it as a local file:

  ```console
  /home/pras/.symfony/bin/symfony
  ```

- Or add the following line to your shell configuration file:

  ```console
  export PATH="$HOME/.symfony/bin:$PATH"
  ```

- Or install it globally on your system:
  ```console
  mv /home/pras/.symfony/bin/symfony /usr/local/bin/symfony
  ```

## For our specific needs

1. update and upgrade your env:

```console
sudo apt-get update
sudo apt-get upgrade
```

2. get you php version

```console
php -v
```

3. add missing modules (change X depending of your PHP version), for example here "PHP 7.4.20 (cli)"

```console
sudo apt-get install php7.4-sqlite3
sudo apt-get install php7.4-mbstring
sudo apt-get install php7.4-mysql
```

# Projects

1. Create a new project using symfony CLI

```console
symfony new my_project_name --version=next --full
```

2. Create symfony demo project to have an example

```console
symfony new my_project_name --demo
```

3. Setting up an Existing Symfony Project

```console
cd projects/
git clone ...
cd my-project/
composer install
```

4. Running Symfony Applications

```console
cd my-project/
symfony server:start
```

# Download theme to integrate into symfony projects

1. Theme to use: https://startbootstrap.com/theme/clean-blog
![image](https://user-images.githubusercontent.com/61125395/122299821-c78f3b80-cefe-11eb-857e-7c966a2549a2.png)  

2. Let's make 2 controllers to manage posts and pages  
Into post controller we can have one method to show all posts and another one to show one specific post, and into
page controller we can have one method to manage about page and another one to manage contact page.  
To create controllers, into your shell:  
```php
php bin/console make:controller
```
and choose, **Page** and **Post** as names with keeping Upper Case for first letter, class standard definition naming convention.  

3. The maker will create controllers and views  
We can create necessary routes, we decided to have 2 routes for **Post** 
```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="post_home")
     */
    public function home(): Response
    {
        return $this->render('post/index.html.twig', [
            'bg_image' => 'home-bg.jpg', 
        ]);
    }

     /**
     * @Route("/post/{id}", name="post_view", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function view($id): Response
    {
        return $this->render('post/view.html.twig', [
            'post' => [
                'title' => 'Le titre de l\'article',
                'content' => 'Le super contenu de notre article'
            ],
            'bg_image' => 'post-bg.jpg', 
        ]);
    }
}
```
and also 2 routes for **Page**
```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/about", name="page_about")
     */
    public function about(): Response
    {
        return $this->render('page/about.html.twig', [
            'page_title' => 'About',
            'bg_image' => 'about-bg.jpg', 
        ]);
    }

    /**
     * @Route("/contact", name="page_contact")
     */
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig', [
            'page_title' => 'Contact',
            'bg_image' => 'contact-bg.jpg', 
        ]);
    }
}
```



