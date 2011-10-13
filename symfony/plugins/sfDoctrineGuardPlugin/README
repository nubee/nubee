# sfGuardDoctrine plugin (for symfony 1.4) #

The `sfDoctrineGuardPlugin` is a symfony plugin that provides authentication and
authorization features above and beyond the standard security features of symfony.

It gives you the model (user, group and permission objects) and the modules
(backend and frontend) to secure your symfony application in a minute in
a configurable plugin.

Beginning with version 5.0.0 (the 1.4 stable branch), `sfDoctrineGuardPlugin` also 
provides the option of applying for an account through the site (this is disabled
by default), and the ability to reset your password if you have forgotten it. 
For security, password reset requires that you know the email address associated with the
account and be able to receive mail there. However applying for an account does not yet require receiving
an email message in 5.0.0.

The 5.x series can require significant migration effort when moving from earlier releases. See the Upgrade section for more information.

## Installation ##

  * Install the plugin (via a package)

        symfony plugin:install sfDoctrineGuardPlugin

  * Install the plugin (via a Subversion checkout)
  
        svn co http://svn.symfony-project.com/plugins/sfDoctrineGuardPlugin/trunk plugins/sfDoctrineGuardPlugin

  * Activate the plugin in the `config/ProjectConfiguration.class.php`
  
        [php]
        class ProjectConfiguration extends sfProjectConfiguration
        {
          public function setup()
          {
            $this->enablePlugins(array(
              'sfDoctrinePlugin', 
              'sfDoctrineGuardPlugin',
              '...'
            ));
          }
        }

  * Rebuild your model

        symfony doctrine:build-model
        symfony doctrine:build-sql

  * Update you database tables by starting from scratch (it will delete all
    the existing tables, then re-create them):

        symfony doctrine:insert-sql

    or do everything with one command

        symfony doctrine-build-all-reload frontend

    or you can just create the new tables by using the generated SQL
    statements in `data/sql/plugins.sfGuardAuth.lib.model.schema.sql`

  * Load default fixtures (optional - it creates a superadmin user)

        mkdir data/fixtures/
        cp plugins/sfDoctrineGuardPlugin/data/fixtures/fixtures.yml.sample data/fixtures/sfGuard.yml

        symfony doctrine:data-load frontend # replace frontend with the name of one of your application

  * Enable one or more modules in your `settings.yml` (optional)
    * For your backend application:  sfGuardUser, sfGuardGroup, sfGuardPermission

              all:
                .settings:
                  enabled_modules:      [default, sfGuardGroup, sfGuardUser, sfGuardPermission]

		PLEASE NOTE: these modules are NOT SECURED by default, because we can't guess what you want your policies to be. Please read the "Secure your application" section below.

    * For your frontend application: sfGuardAuth

              all:
                .settings:
                  enabled_modules:      [default, sfGuardAuth]

    Do not secure `sfGuardAuth`, it is the module that allows the user to log in.

  * Clear you cache

        symfony cc

  * Optionally add the "Remember Me" filter to `filters.yml` above the security filter:

        [yml]
        remember_me:
          class: sfGuardRememberMeFilter

        security: ~

### Upgrading ###

The 5.0.x series adds several new tables, adds columns to existing tables and changes the names of all of the relations in the schema. 

This requires changes of two kinds: database schema changes and, in some cases, changes to your code. We'll look at each of these issues in turn.

#### Updating your Schema ####

There are three basic changes in the schema: 

  * All primary key ID columns have been changed to 8-byte integers
  * New columns in the `sfGuardUser` table, which now contains `first_name`, `last_name` and `email_address` information
  * A new `sfGuardForgotPassword` table used to verify password reset requests and account creation requests

##### Upgrading to 8 Byte Integers #####

It would be handy to use Doctrine's `generate-migrations-diff` task to update the schema, but unfortunately while it is a powerful tool it cannot figure out how to change the ID columns to 8 bytes without foreign key errors. You can write a migration yourself or just use SQL ALTER TABLE statements. If you choose to do so, you will need to drop the foreign key indexes first (never the columns of course, just the indexes), alter the ID column types, and then create the foreign key indexes again. We recommend locking the database while doing so.

You can also leave the types of the IDs alone in your existing database. That is a great deal easier. If you choose this approach, make sure you create the new `sfGuardForgotPassword` table with 4-byte integers, just like your old tables, as explained below.

##### Adding the New Columns #####

There are three new columns in the `sf_guard_user` table. You can add these with the following SQL statements:

		ALTER TABLE sf_guard_user ADD COLUMN first_name varchar(255) DEFAULT NULL;
		ALTER TABLE sf_guard_user ADD COLUMN last_name varchar(255) DEFAULT NULL;
		ALTER TABLE sf_guard_user ADD COLUMN email_address varchar(255) DEFAULT '';

Next you should specify that the email address must be unique. This poses a problem if your users do not currently have an email address field at all in your existing system (for instance, you have no profile table, or there is no email address in it). You can work around it this way as a temporary solution:

		UPDATE sf_guard_user SET email_address = username;

This ensures a unique setting although it does not actually provide a useful email address. If you have a profile table with email addresses, a better idea is to import your email addresses from there:

    UPDATE sf_guard_user,sf_guard_profile SET sf_guard_user.email_address = sf_guard_profile.email_address WHERE sf_guard_user.id = sf_guard_profile.id;

Now you are ready to index the column and make it unique:

    ALTER TABLE sf_guard_user ADD UNIQUE KEY `email_address` (`email_address`);

##### Adding the sfGuardForgotPassword table #####

You can do this with the following SQL code.

If you wish to stick with 4-byte IDs:

    CREATE TABLE sf_guard_forgot_password (id INT AUTO_INCREMENT, user_id INT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;

If you have upgraded your IDs:

		CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;

#### Updating your Code ####

*If you have not migrated your database schema yet, DO THAT FIRST (see above).* Otherwise you lose the option of using Doctrine migrations.

After updating your schema you will also need to update your code to account for the changes.

First rebuild your model, form and filter base classes. This will not damage any custom code in your own model classes, as long as you followed standard practice and left the `Base` classes alone:

		./symfony doctrine:build --all-classes

Second, check your Doctrine code for places where you use the relations that are defined for `sfGuardUser`, `sfGuardGroup`, etc. The names of these relations have been changed for convenience and to follow Symfony best practices. 

The most frequently used relations that have changed are:

$group->users is now $group->Users (uppercase)
$group->permissions is now $group->Permissions (uppercase)
$user->groups is now $user->Groups (uppercase)
$user->permissions is now $user->Permissions (uppercase)

The less commonly used relations on `sfGuardUserPermission` and `sfGuardGroupPermission` have changed as well. They are capitalized and they do not have an `sfGuard` prefix. Those who sometimes write custom queries to locate users with particular privileges need to be aware of this.

### Secure your application ###

To secure a symfony application:

  * Enable the module `sfGuardAuth` in `settings.yml`

        all:
          .settings:
            enabled_modules: [..., sfGuardAuth]

  * Change the default login and secure modules in `settings.yml`

        login_module:           sfGuardAuth
        login_action:           signin
        
        secure_module:          sfGuardAuth
        secure_action:          secure

  * Change the parent class in `myUser.class.php`

        class myUser extends sfGuardSecurityUser
        {
        }

  * Optionally add the following routing rules to `routing.yml`

        sf_guard_signin:
          url:   /login
          param: { module: sfGuardAuth, action: signin }
        
        sf_guard_signout:
          url:   /logout
          param: { module: sfGuardAuth, action: signout }
        
        sf_guard_register:
          url:   /register
          param: { module: sfGuardRegister, action: index }

        sf_guard_forgot_password:
          url:   /forgot_password
          param: { module: sfGuardForgotPassword, action: index }

        sf_guard_forgot_password_change:
          url:   /forgot_password/:unique_key
          class: sfDoctrineRoute
          options: { model: sfGuardForgotPassword, type: object }
          param: { module: sfGuardForgotPassword, action: change }
          requirements:
            sf_method: [get, post]

    You can customize the `url` parameter of each route.
    N.B.: You must have a `@homepage` routing rule (used when a user sign out)

    These routes are automatically registered by the plugin if the module `sfGuardAuth`
    is enabled unless you defined `sf_guard_plugin_routes_register` to false
    in the `app.yml` configuration file:

        all:
          sf_guard_plugin:
            routes_register: false

  * Secure some modules or your entire application in `security.yml`

        default:
          is_secure: true

  * You're done. Now, if you try to access a secure page, you will be redirected
    to the login page.
    If you have loaded the default fixture file, try to login with `admin` as
    username and `admin` as password.

  * If you do NOT secure your entire site by default, then make sure you DO secure the `sfGuardUser`, `sfGuardGroup` and `sfGuardPermission` modules in particular! Otherwise anonymous users can create users, groups and permissions at any time. This is a common oversight on `sfDoctrineGuardPlugin` sites.

## Manage your users, permissions and groups ##

To be able to manage your users, permissions and groups, `sfDoctrineGuardPlugin` comes
with 3 modules that can be integrated in your backend application.
These modules are auto-generated thanks to the symfony admin generator.

  * Enable the modules in `settings.yml`

        all:
          .settings:
            enabled_modules: [..., sfGuardGroup, sfGuardPermission, sfGuardUser]

  * Remember to secure these modules via `security.yml` if you are not securing your entire site. Otherwise anonymous users can create and delete users

  * Access the modules with the default route:

    http://www.example.com/backend.php/sfGuardUser

## Applying for Accounts ##

Some site administrators will wish to allow members of the public to apply for accounts. Beginning in 5.0.0 this feature is available in `sfDoctrineGuardPlugin`.

To enable the feature you must enable the `sfGuardRegister` module, then provide users with a link to the `sfGuardRegister/index` action.

[TODO: flesh this out further]
[TODO: document the forgot password feature]

## Customize sfGuardAuth module templates ##

By default, `sfGuardAuth` module comes with 2 very simple templates:

  * `signinSuccess.php`
  * `secureSuccess.php`

If you want to customize one of these templates:

  * Create a `sfGuardAuth` module in your application (don't use the
    `init-module` task, just create a `sfGuardAuth` directory)

  * Create a template with the name of the template you want to customize in
    the `sfGuardAuth/templates` directory

  * symfony now renders your template instead of the default one

## Customize `sfGuardAuth` module actions ##

If you want to customize or add methods to the sfGuardAuth:

  * Create a `sfGuardAuth` module in your application

  * Create an `actions.class.php` file in your `actions` directory that inherit
    from `BasesfGuardAuthActions` (don't forget to include the `BasesfGuardAuthActions`
    as it can't be autoloaded by symfony)

        <?php
    
        require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');
    
        class sfGuardAuthActions extends BasesfGuardAuthActions
        {
          public function executeNewAction()
          {
            return $this->renderText('This is a new sfGuardAuth action.');
          }
        }

## `sfGuardSecurityUser` class ##

This class inherits from Symfony's `sfBasicSecurityUser` class and is
used for the `user` object in your symfony application.
(Remember that you changed the `myUser` base class earlier.)

To access it, you can use the standard `$this->getUser()` in your actions
or `$sf_user` in your templates.

`sfGuardSecurityUser` adds some useful methods:

  * `signIn()` and `signOut()` methods
  * `getGuardUser()`, which returns the `sfGuardUser` object
  * a bunch of proxy methods to access directly the `sfGuardUser` object

For example, to get the current username:

    $this->getUser()->getGuardUser()->getUsername()

    // or via the proxy method
    $this->getUser()->getUsername()

## Superadmin ("super administrator") flag ##

To prevent chicken and egg problems, `sfDoctrineGuardPlugin` has the concept of a "superadmin." A user that is a superadmin
 bypasses all credential checks.

The superadmin flag cannot be set via the `sfGuardUser` admin module, you must set the flag
directly in the database or use the provided Symfony task:

    symfony guard:promote admin

## Validators ##

`sfDoctrineGuardPlugin` comes with a validator that you can use in your modules:
`sfGuardUserValidator`.

This validator is used by the `sfGuardAuth` module to validate the username and
password before signing the user in.

## Check the user password with an external method ##

If you don't want to store the password in the database because you already
have a LDAP server, a .htaccess file or if you store your passwords in another
table, you can provide your own `checkPassword` callable (static method or
function) in `app.yml`:

    all:
      sf_guard_plugin:
        check_password_callable: [MyLDAPClass, checkPassword]

When symfony will call the `$this->getUser()->checkPassword()` method, it will
call your method or function. Your function must takes 2 parameters, the first
one is the username and the second one is the password. It must return true
or false. Here is a template for such a function:

    function checkLDAPPassword($username, $password)
    {
      $user = LDAP::getUser($username);
      if ($user->checkPassword($password))
      {
        return true;
      }
      else
      {
        return false;
      }
    }

## Change the algorithm used to store passwords ##

By default, passwords are stored as a `sha1()` hash. But you can change this
with any callable in `app.yml`:

    all:
      sf_guard_plugin:
        algorithm_callable: [MyCryptoClass, MyCryptoMethod]

or:

    all:
      sf_guard_plugin:
        algorithm_callable: md5

As the algorithm is stored for each user, you can change your mind later
without the need to regenerate all passwords for the current users.

## Change the name or expiration period of the "Remember Me" cookie ##

By default, the "Remember Me" feature creates a cookie named `sfRemember`
that will last 15 days.  You can change this behavior in `app.yml`:

    all:
      sf_guard_plugin:
         remember_key_expiration_age:  2592000   # 30 days in seconds
         remember_cookie_name:         myAppRememberMe

## Customize `sfGuardAuth` redirect handling ##

It is possible to redirect the user to his profile after a successful login, or
to a particular page on logout.

You can change the redirect settings in `app.yml`:

    all:
      sf_guard_plugin:
        success_signin_url:      @my_route?param=value # the plugin uses the referer as default
        success_signout_url:     module/action         # the plugin uses the referer as default
