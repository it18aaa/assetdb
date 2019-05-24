<?php
/// user an autoloader!!

require('config/paths.php');
require('config/database.php');
require('config/ldap.php');
require('config/encryption.php');

require('libs/user.php');
require('libs/session.php');
require('libs/encryption.php');
require('libs/ldapWrapper.php');
require('libs/database.php');
require('libs/bootstrap.php');
require('libs/view.php');
require('libs/controller.php');
require('libs/model.php');
require('models/Person.php');
require('models/Loan.php');
require('models/Asset.php');



$app = new Bootstrap();

 