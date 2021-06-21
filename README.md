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

## For our project specific needs

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

# Projects: Introduction
We are going to create a blog where we are going to manage different type of users, and usual blog applications, like posting or commenting an article. 
Here is the CDM for our project:  
![image](https://user-images.githubusercontent.com/61125395/122682218-7336d500-d1f8-11eb-8645-eca4623cf50e.png)


# Project: Creation and Management

1 Create a new project using symfony CLI
  - For our porject  
```console
symfony new Simplon-Project9-Symfony5.3-Blog --version=5.3 --full
```
![image](https://user-images.githubusercontent.com/61125395/122682357-20a9e880-d1f9-11eb-8abb-38c98d738f2e.png)  
if the project was correctly created you have to see this page at "https://localhost:8000/":  
![image](https://user-images.githubusercontent.com/61125395/122682955-995e7400-d1fc-11eb-9f8c-7d04e67cefc6.png)


Some other methods to create projects:  
  - Create a project using maintained branch  
```console
symfony new <project_name> --full
```
  - Create a project using LTS (Long Term Support)  
```console
symfony new <project_name> --version=lts
```
  - Create a project using developement version  
```console
symfony new <project_name> --version=next
```
  - Create symfony demo project to have an example
```console
symfony new <project_name> --demo
```

3. Setting up an Existing Symfony Project

```console
git clone <project_git_path>
cd <project_name>/
composer install
```

4. Running Symfony Applications

```console
cd <project_name>/
symfony server:start
```

# Project: Database  
1. Once the project is created, we need to create our database to manager our project, so we are going to create it using PhpMyAdmin:   
![image](https://user-images.githubusercontent.com/61125395/122682636-f822ee00-d1fa-11eb-9b35-1493700ae617.png)  
2. One the database is created, we need to update the file ".env" to change database access credentials (for real project we need to create a file ".env.local" where we will
add credential informations, but for our example, project will be on our local machine, and all credentials are defined by default), we changed only the value for "DATABASE_URL" for the moment, by adding SQL database access credentials:   
```apacheconf
# In all environments, the following files are loaded if they exist,
# the latter taking precedence over the former:
#
#  * .env                contains default values for the environment variables needed by the app
#  * .env.local          uncommitted file with local overrides
#  * .env.$APP_ENV       committed environment-specific defaults
#  * .env.$APP_ENV.local uncommitted environment-specific overrides
#
# Real environment variables win over .env files.
#
# DO NOT DEFINE PRODUCTION SECRETS IN THIS FILE NOR IN ANY OTHER COMMITTED FILES.
#
# Run "composer dump-env prod" to compile .env files for production use (requires symfony/flex >=1.2).
# https://symfony.com/doc/current/best_practices.html#use-environment-variables-for-infrastructure-configuration

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=6cb870044dfe547bec11f70bd9022d68
###< symfony/framework-bundle ###

###> symfony/mailer ###
# MAILER_DSN=smtp://localhost
###< symfony/mailer ###

###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
#
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
DATABASE_URL="mysql://root:@127.0.0.1:3306/simplon-project9-symfony5.3-Blog?serverVersion=5.7"
# DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
###< doctrine/doctrine-bundle ###
```



# Project: About Routes

1. Create controller using maker  
```console
php bin/console make:controller
```
Specifiy the name you want for the controller, for our project we are going to create first of all, 2 controllers, one to manage posts, and another one to manage pages
  ![image](https://user-images.githubusercontent.com/61125395/122682413-79798100-d1f9-11eb-8d6f-cbcac0181c54.png)   
  And we can see that 2 files were created, the controller("src/Controller/<Name>Controller.php") and the view("templates/<name>/index.html.twig")  
  We can check thoses files, for example the ones for posts:  
  The Controller:  
  ```php
  <?php

  namespace App\Controller;

  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  class PostController extends AbstractController
  {
      /**
       * @Route("/post", name="post")
       */
      public function index(): Response
      {
          return $this->render('post/index.html.twig', [
              'controller_name' => 'PostController',
          ]);
      }
  }
  ```  
  The View:  
  ```php
  {% extends 'base.html.twig' %}

  {% block title %}Hello PostController!{% endblock %}

  {% block body %}
  <style>
      .example-wrapper { margin: 1em auto; max-width: 800px; width: 95%; font: 18px/1.5 sans-serif; }
      .example-wrapper code { background: #F5F5F5; padding: 2px 6px; }
  </style>

  <div class="example-wrapper">
      <h1>Hello {{ controller_name }}! ✅</h1>

      This friendly message is coming from:
      <ul>
          <li>Your controller at <code><a href="{{ '/mnt/c/wamp64/www/simplon/symfony/Simplon-Project9-Symfony5.3-Blog/src/Controller/PostController.php'|file_link(0) }}">src/Controller/PostController.php</a></code></li>
          <li>Your template at <code><a href="{{ '/mnt/c/wamp64/www/simplon/symfony/Simplon-Project9-Symfony5.3-Blog/templates/post/index.html.twig'|file_link(0) }}">templates/post/index.html.twig</a></code></li>
      </ul>
  </div>
  {% endblock %}
  ```
  We can check the page using the defined route, in our post controller, this is "/post", so we need to go from our browser here "https://localhost:8000/post"  
  ![image](https://user-images.githubusercontent.com/61125395/122682831-00c7f400-d1fc-11eb-93e5-16c2d051b670.png)


2. Change that files to have 2 routes to manage posts, one to have all posts, and another one to manage one post. Same for pages, we need to have one page to manage about, and another one to manage contact page. So we are going change controllers and views to have what we need.

  - PostController.php:  
  We are going change created file by updated necessary codes, we add 2 methods into that controller, one to access to "home" which will be our home page,  and another one to access to "view" which will access to specific post by using method "GET" to get post ID. You can notice that I also changed value of "controller_name" into the render, inject 2 different strings to see the changes. For views, for the moment I simply changed "index.html.twig" as "home.html.twig" and I copied the same file as "view.html.twig", we will update them with necessary HTML code later.
  ```php
  <?php

  namespace App\Controller;

  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;

  class PostController extends AbstractController
  {
      /**
       * @Route("/", name="home")
       */
      public function home(): Response
      {
          return $this->render('post/home.html.twig', [
              'controller_name' => 'PostController, in view home',
          ]);
      }

      /**
       * @Route("/post/{id}", name="post_view", methods={"GET"}, requirements={"id"="\d+"})
       */
      public function view(): Response
      {
          return $this->render('post/view.html.twig', [
              'controller_name' => 'PostController, in view view',
          ]);
      }
  }
  ```
  We have 2 different ways to check parameters given in methods:  
    - in the controller user "Dump and Die" => "dd(<parameter>)  
    - in the view use "{{ dump(<parameter>) }}"  
  we can check that updates using our browser and trying to access to our page.  
  For "home" you just need to go "https://localhost:8000/" because we have defined "/" in our route path in that method.  
  ![image](https://user-images.githubusercontent.com/61125395/122683453-9618b780-d1ff-11eb-8ee5-21cc119be649.png)  
  For "view" you need to go to path like "https://localhost:8000/post/25" because we have defined "/post/{id}" in our route path in that method.  
  ![image](https://user-images.githubusercontent.com/61125395/122688103-96727c00-d21a-11eb-9fa2-e864ebe7362e.png)  
  
  - PageController.php: 
  We are going to do the same work than "post", we will have 2 methods, one to access to about page, and another one to access to contact page. Same thing for views, we have to   rename "index.html.twig" in page repo as "about.html.twig" and copy this same as "contact.html.twig". 
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
              'controller_name' => 'PageController about',
          ]);
      }

      /**
       * @Route("/contact", name="page_contact")
       */
      public function contact(): Response
      {
          return $this->render('page/contact.html.twig', [
              'controller_name' => 'PageController contact',
          ]);
      }
  }
  ```
  we can check that updates using our browser and trying to access to our page.  
  For "about" you just need to go to "https://localhost:8000/about/".  
  ![image](https://user-images.githubusercontent.com/61125395/122688483-b0ad5980-d21c-11eb-9a58-97c98769674d.png)  
  For "contact" you need to go to "https://localhost:8000/contact/".  
  ![image](https://user-images.githubusercontent.com/61125395/122688499-d175af00-d21c-11eb-9051-1bcbfd100964.png)


# Project: Front End Integration

1. Download a Theme and integrate it into the project: https://startbootstrap.com/theme/clean-blog
![image](https://user-images.githubusercontent.com/61125395/122299821-c78f3b80-cefe-11eb-857e-7c966a2549a2.png)  
We can see that this theme has some static html pages with his CSS, JS and assets  
![image](https://user-images.githubusercontent.com/61125395/122688573-5eb90380-d21d-11eb-99de-2d632a0a89fa.png)

2. Let's copy part by part into our project:
  - into "public" directory of our project, copy all directires from the theme in specific directory called "clean":  
  ![image](https://user-images.githubusercontent.com/61125395/122688652-cc652f80-d21d-11eb-925f-7d11e42be4e2.png)  
  - into "src/templates" copy the file "base.html.twig" as "clean.html.twig"  
  ![image](https://user-images.githubusercontent.com/61125395/122688678-0b938080-d21e-11eb-9f02-90cf6c9fdea7.png)  
  - copy all content from "index.html" to "clean.html.twig"  and take care to change relative paths with using functions "asset" of symfony, function asset means everything from   "public" directory, like "js/scripts.js" to "{{ asset('clean/js/scripts.js') }}"  
  - look in details the new file "clean.twig.html" and update everything.
    - in \<head\> part, update "\<title\>" part by "<title>{% block title %}Title by Default{% endblock %}</title>" to have possibility to manage the page title in each views.
    - in \<head\> part, update some relative paths usings "asset"  
    - in \<body\> part, update "\<h1\>" part in "\<header\>" part by "<h1>{{block('title') }}</h1>", function "block" is used to get a specific pre-defined "block".  
    - in \<body\> part, update "\<span\>" part in "\<header\>" part by "<span class="subheading">{% block sub %}sub by default{% endblock %}</span>".  
    - in \<body\> part, upate menu in \<nav\> part by using route names defined in controller, like "href="index.html"" to "href={{ path('post_home') }}"  
    - in \<body\> part, remove all "main content" beacause this part will be updated by controllers depending of where we will be, to manage that add {% block body %}{% endblock %} instead of that main content.
    - in \<body\> part, keep the other parts like it is, just take care to change relative paths using "asset".  
  - Now for all views in templates, just copy this and update parts in "block" body as needed for each views:  
  ```php
  {% extends 'clean.html.twig' %}
  
  {% block title %}depends of views{% endblock %}

  {% block h1 %}Page depends of views{% endblock %}

  {% block sub %}sub depends of views{% endblock %}

  {% block body %}

  <!-- Main Content depends of views -->
   
  {% endblock %}
  ```   
  - Let's check one by one our updates in the browser:  
    - Home:  
    ![image](https://user-images.githubusercontent.com/61125395/122689409-a7bf8680-d222-11eb-997e-3bd1ae4e6ed6.png)  
    - About:  
    ![image](https://user-images.githubusercontent.com/61125395/122689422-b443df00-d222-11eb-892c-a5750a8b18b5.png)  
    - Post:  
    ![image](https://user-images.githubusercontent.com/61125395/122689431-c32a9180-d222-11eb-9533-4d97a885edfb.png)
    - Contact:  
    ![image](https://user-images.githubusercontent.com/61125395/122689437-cc1b6300-d222-11eb-870c-80f9916a3635.png)


# Project: User Management  
1. To check some user actions we will need an SMTP server and mail box, for developement there are some useful tools for that, for our needs we are going to use "MailHog", official git repo "https://github.com/mailhog/MailHog".  
  - For Ubuntu users, you need to install it like that:  
  ```console
  sudo apt-get -y install golang-go
  go get github.com/mailhog/MailHog
  ```  
  - To launch MailHog just do from your terminal  
  ```console
  ~/go/bin/MailHog
  ```
  - You need to see the follwing mailbox at adress "http://localhost:8025/":  
  ![image](https://user-images.githubusercontent.com/61125395/122689561-d7bb5980-d223-11eb-9896-4defb946cfc0.png)

2. In your config file ".env", you need to update the MAILER_DSN:  
  ```apacheconf
  ###> symfony/mailer ###
  MAILER_DSN=smtp://localhost:1025
  ###< symfony/mailer ###
  ```

3. Let's create user entity using the maker, answer questions like the screenshot, all values in "[value]" are by default, just press enter if you agree with that value.    
  ```console
  php bin/console make:user
  ```  
![image](https://user-images.githubusercontent.com/61125395/122689699-f837e380-d224-11eb-9402-fc49beea3480.png)
  We can see that "User" entity and "UserRepository" are created and updated, let's check that enity and do some corrections if necessary (usually not needed)  

4. Let's Create the migration file to generate table in our SQL database:  
  ```console
  php bin/console make:migration
  ```
  ![image](https://user-images.githubusercontent.com/61125395/122689843-e7d43880-d225-11eb-93a7-53893aab794b.png)  
  let's check that created file to be ensure what is going to happend in our database.  

5. Let's launch the migration to create the table into our database:  
  ```console
  php bin/console doctrine:migrations:migrate
  ```
  ![image](https://user-images.githubusercontent.com/61125395/122689884-38e42c80-d226-11eb-8699-b64a046035be.png)  
  You have to see the created table into your database:  
  ![image](https://user-images.githubusercontent.com/61125395/122689921-53b6a100-d226-11eb-8df8-e5573612d908.png)  
  There is also another table to control migrations.  


# Project: Authentification System  
1. Create authentification system using the maker:  
```console
php bin/console make:auth
```
Answer questions like snapshot below   
![image](https://user-images.githubusercontent.com/61125395/122696676-ee71a880-d243-11eb-9ab1-6552d64afb0b.png)  
We can notice that some files like the controller and templates have been created  
And update file "src\Security\UserAuthenticator.php" as belown, change the redirection to "home" page   
```php
public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
{
    if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
        return new RedirectResponse($targetPath);
    }

    // For example:
    return new RedirectResponse($this->urlGenerator->generate('home'));
    // throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
}
```

# Project: User Registration  
1. Create User registration using the maker  
```console
php bin/console make:registration-form
```
Answer question like snapshot  
![image](https://user-images.githubusercontent.com/61125395/122697078-d77f8600-d244-11eb-87b1-f60a660938f2.png)  
![image](https://user-images.githubusercontent.com/61125395/122697101-e9f9bf80-d244-11eb-90ba-a2bd0a95d10a.png)  
We can notice that user files were updated and some new files have been created  
We have also some guideline for next steps  

2. Follwing next steps, we need to install a missing bundle  
```console
composer require symfonycasts/verify-email-bundle
```
![image](https://user-images.githubusercontent.com/61125395/122697398-87ed8a00-d245-11eb-95d9-fdf1c14cfec4.png)  
Once this bundle is correctly installed we need to update the "TODO" part in "src/Controller/RegistrationController.php" to redirect in correct page "home" once email will be verified.  
And we need to add message flash in our model ("src/templates/clean.html.twig" after "\<header\>" section  
```twig
{% for flashError in app.flashes('verify_email_error') %}
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="alert alert-danger" role="alert">{{ flashError }}</div>
                </div>
            </div>
        </div>
    </main>
{% endfor %}

{% for flashSuccess in app.flashes('success') %}
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="alert alert-success" role="alert">{{ flashSuccess }}</div>
                </div>
            </div>
        </div>
    </main>
{% endfor %}
```

3. We need to Run "php bin/console make:migration" to generate a migration for the newly added User::isVerified property  
![image](https://user-images.githubusercontent.com/61125395/122698293-51187380-d247-11eb-8780-aa4d7340f832.png)  

4. Then check the created migration file and perfom the migration  
![image](https://user-images.githubusercontent.com/61125395/122698365-79a06d80-d247-11eb-96d2-fded81c7b6da.png)  
We can in our database, table "user", a new attribut "is_verified" has been created  
![image](https://user-images.githubusercontent.com/61125395/122698470-a785b200-d247-11eb-86dc-48cbdc222809.png)








