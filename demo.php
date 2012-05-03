<?php

/*
 * BiziPorts API SDK Sample Use Cases
 * Version 1.0
 * Author: Chris Bake
 * Company: BakedFinn, LLC
 *
 */

// Require the BiziPorts SDK
require("biziports.class.php");

// Initialize The SDK Object
$API = new BiziPorts_API;

// Set Your BiziPorts Account Credentials
$API->setUsername("demo-account");
$API->setPassword("super-secret");

# Authorize Your Session
$API->auth();

# Test Login Status
if(!$api_loggedIn = $API->checkAPILogin()) die("Invalid Login");


# Check if a user is logged in
$user_loggedIn = $API->validateUser("johndoe", "secretpasswd");

# Query a Logged In Users' Previous Orders
$orders = $API->getUsersOrders($users_id);

# Logout Current User
$API->logoutUser();

# Logout current API User Session
$API->logout();

# Destroy SDK Object
unset($API);
