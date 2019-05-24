<?php
require_once('darksources_api.php');

// New API
$ds = new DarkSources_API();
$ds->auth('');

// Set API debug output to error_log
#$ds->debug(True);
#$ds->dev(True);

// Public API (allowed per IP limits for open development. For queries over the daily IP limit an API key can be used.)

// Simple password lookup
/*
Description: This call pulls basic information for a password.
When to use: When general information is required for a password
API URL: https://api.darksources.com/v1/pr/

Required fields:
	* password - This can either be the plain text password or a SHA512 hashed version of the password

Optional fields:
	* api_key - Your API key from your access subscription

Output:

Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [password] => ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413
            [password_rank] => 1
            [password_leaks] => 18787815
        )

)

Data Fields:
	* password - The SHA512 hash of the submitted password
	* password_rank - This is the ranking of the password where 1 is the most common used password
	* password_leaks - This is the number of e-mail addresses that have this password associated

API Function:
$ds->password_rank_lookup(password);
*/

echo("Password Rank Lookup\n");
print_r($ds->password_rank_lookup('ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413'));


// Simple e-mail lookup
/*
Description: This call pulls basic information is required for an e-mail address.
When to use: Useful to verfy if an e-mail address exists in our database.
API URL: https://api.darksources.com/v1/el/

Required fields:
	* email - The plain text or SHA1 hash of the e-mail address to be looked up
	* password - This can either be the plain text password or a SHA512 hashed version of the password

Optional fields:
	* api_key - Your API key from your access subscription

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [email] => f4b0ace4e24d84fef265f4ca7242562bdfeb8937
            [email_known] => 1
            [source_count] => 25
        )

)

Data Fields:
	* email - The SHA1 hash of the e-mail address queried
	* email_known - 1 means the address is known to our database while 0 means there wasn't a match
	* source_count - The number of data sources that contained this address

API Function:
$ds->email_lookup(email);
*/

echo("\nE-Mail Lookup:\n");
print_r($ds->email_lookup('foo@foo.com'));

// Domain lookup
/*
Description: This call pulls information on a domain name.
When to use: Useful for understanding the impact against the users of companies, governments etc
API URL: https://api.darksources.com/v1/dr/

Required fields:
	* domain - THe domain to query

Optional fields:
	* api_key - Your API key from your access subscription

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [domain] => gmail.com
            [domain_rank] => 3
            [domain_count] => 264271723
        )

)

Data Fields:
	* domain - The domain submitted to query
	* domain_rank - The ranking of the domain by the number of addresses within our database. 1 has the most number of e-mails
	* domain_count - The number of e-mail addresses within our database for this domain

API Function:
$ds->domain_rank_lookup(domain);
*/


echo("\nDomain Lookup:\n");
print_r($ds->domain_rank_lookup('gmail.com'));

// Private API (an API key is required to access)
// If you would like to gain an API key please register at https://billing.darksources.com/signup 

// Full Password Lookup
/*
Description: This call pulls full password risk information. Unlike the free version of this call this includes recent usage activiy of the password for users on other sites.
When to use:  When just a password needs to be checked without an e-mail address (ie: login & password on logins, registrations, and password change attempts)
API URL: https://api.darksources.com/v1/pro_pl/

Required fields:
	* password - This can either be the plain text password or a SHA512 hashed version of the password

Optional fields:
	* api_key - Your API key from your access subscription

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [password] => ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413
            [password_rank] => 1
            [password_leaks] => 18787815
            [p_queries] => Array
                (
                    [0] => 2018-10-08 06:24:23.171119-07
                )

        )

)

Data Fields:
	* password - The SHA512 hash of the submitted password
	* password_rank - This is the ranking of the password where 1 is the most common used password
	* password_leaks - This is the number of e-mail addresses that have this password associated
	* p_queries - The latest date the password was submitted from another customer

API Function:
$ds->full_password_lookup(password);
*/


echo ("\nFull Password Lookup(Pro):\n");
print_r($ds->full_password_lookup('ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413'));


// Full E-mail Lookup (pro)
/*
Description: This call checks an e-mail against the database providing a full report on the content of an e-mail's profile.
When to use: For risk intelligence assessments and user alerts. 
API URL: https://api.darksources.com/v1/pro_el/

Required fields:
	* api_key - Your API key from your access subscription
	* email - The plain text or SHA1 hash of the e-mail address to be looked up

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [email] => f4b0ace4e24d84fef265f4ca7242562bdfeb8937
            [email_known] => 1
            [name] => 1
            [gender] => 1
            [car_make] => 1
            [car_model] => 1
            [ssn] => 1
            [num_of_kids] => 0
            [dob] => 1
            [passwords] => 51
            [phone_numbers] => 3
            [employers] => 3
            [sources] => 30
            [logins] => 81
            [password_hints] => 0
            [websites] => 2
            [ip_addresses] => 44
            [addresses] => 67
            [jobs] => 1
            [ad_interests] => 1
            [known_hacked_accounts] => 1
            [known_languages] => 0
            [known_cell_phone_hardware] => 0
            [phone_coordinates] => 0
            [trump_voter_likeliness] => 43%
            [gmail_gcmid] => 0
            [sex_preference] => 1
            [dating_limits] => 1
            [attracted_to] => 1
            [dating_status] => 1
            [race] => 1
            [height] => 1
            [weight] => 1
            [eye_color] => 1
            [hair_color] => 1
            [skype_id] => 0
            [msn_id] => 1
            [instagram_id] => 0
            [linkedin_id] => 0
            [google_id] => 0
            [facebook_id] => 1
            [youtube_id] => 1
            [twitter_id] => 1
        )

)

Data Fields:
	* email - The SHA1 hash of the e-mail address queried
	* email_known - 1 means the address is known to our database while 0 means there wasn't a match
	* name - 1 means a name was saved to profile while 0 means it's empty
	* gender - 1 means the person's gender was saved to profile while 0 means it's empty
	* car_make - 1 means a car maker was saved to profile while 0 means it's empty
	* car_model - 1 means a car model was saved to profile while 0 means it's empty
	* ssn - 1 means a social security number  was saved to profile while 0 means it's empty
	* num_of_kids - The number of kids the saved to the profile
	* dob - 1 means a a date of birth was saved to profile while 0 means it's empty
	* passwords - The number of passwords saved to the profile
	* phone_numbers - The number of phone numbers saved to the profile
	* employers - The number of employers saved to the profile
	* sources - The number of data sources adding data to the profile
	* logins - The number of logins saved to the profile
	* password_hints - The number of password hints saved to the profile
	* websites - The number of websites used or belongs to the user
	* ip_addresses - The number of ip addresses saved to the profile
	* addresses - The number of addresses saved to the profile
	* jobs - The number of jobs saved to the profile
	* ad_interests - The number of kids the saved to the profile
	* hacked_accounts - The number of hacked accounts (ie Hulu, Netflix, Steam etc) saved to the profile
	* languages - The languages the person is known to use
	* cell_phone_hardware - The number of cell phones saved to the profile
	* phone_coordinates - The number of cell phone coordinates saved to the profile
	* trump_voter_likeliness - This represents a number from 0 to 100 (100 being the most likely) of how the person was likely to have voted for Trump in 2016
	* gmail_gcmid - 1 means the GMail/Google payment ID was saved to profile while 0 means it's empty
	* sex_preference - 1 means the sexual preference was saved to profile while 0 means it's empty
	* dating_limits - 1 means the person's dating limits were saved to profile while 0 means it's empty
	* attracted_to - 1 means what the person is sexually attracted to is saved was saved to profile while 0 means it's empty
	* dating_status - 1 means a dating status was saved to profile while 0 means it's empty
	* race - 1 means human race was saved to profile while 0 means it's empty
	* height - 1 means body height was saved to profile while 0 means it's empty
	* weight - 1 means body weight was saved to profile while 0 means it's empty
	* eye_color - 1 means eye color  was saved to profile while 0 means it's empty
	* hair_color - 1 means hair color  was saved to profile while 0 means it's empty
	* skype_id - 1 means a Skype ID was saved to profile while 0 means it's empty
	* msn_id - 1 means a MSN ID was saved to profile while 0 means it's empty
	* instagram_id - 1 means a Instagram ID was saved to profile while 0 means it's empty
	* linkedin_id - 1 means a LinkedIN ID was saved to profile while 0 means it's empty
	* google_id - 1 means a Gmail/Google+ ID was saved to profile while 0 means it's empty
	* facebook_id - 1 means a Facebook ID was saved to profile while 0 means it's empty
	* youtube_id - 1 means a YouTube ID was saved to profile while 0 means it's empty
	* twitter_id - 1 means a Twitter ID was saved to profile while 0 means it's empty

API Function:
$ds->full_email_password_lookup(email, password);
*/

echo ("\nFull E-Mail Lookup(Pro):\n");
print_r($ds->full_email_lookup('roeun0531@gmail.com'));

// Full E-mail & Password Lookup
/*
Description: This call checks an e-mail and passwords against the database providing a full report on both e-mail+password matching, the e-mail address, and password
When to use: When risk for an e-mail and password is required and the bare password is known. (ie: e-mail & password on logins(after password is verified by system to reduce bot abuse), registrations, and password change attempts)
API URL: https://api.darksources.com/v1/pro_epl/

Required fields:
	* api_key - Your API key from your access subscription
	* email - The plain text or SHA1 hash of the e-mail address to be looked up
	* password - This can either be the plain text password or a SHA512 hashed version of the password
	* web_host - (required for bot checking) The hostname of the password was just submitted from. Bot checking requires that the bot check data submittion happens first.

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [password] => ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413
            [email] => f4b0ace4e24d84fef265f4ca7242562bdfeb8937
            [password_rank] => 1
            [password_leaks] => 18787815
            [ep_queries] => Array
                (
                    [0] => 2018-10-08 06:24:23.171119-07
                )

            [p_queries] => Array
                (
                    [0] => 2018-10-08 06:24:23.171119-07
                )

            [email_known] => 1
            [password_known] => 1
            [bot_id] => ds_f4b0ace4e24d84fef265f4ca7242562bdfeb8937
        )
)

Data Fields:
	* password - The SHA512 hash of the submitted password
	* email - The SHA1 hash of the e-mail address queried
	* password_rank - This is the ranking of the password where 1 is the most common used password
	* password_leaks - This is the number of e-mail addresses that have this password associated
	* ep_queries - The latest date the password and e-mail pair was submitted from another customer
	* p_queries - The latest date the password was submitted from another customer
	* email_known - 1 means the address is known to our database while 0 means there wasn't a match
	* email_password - 1 means the password matches one known to hackers while 0 means no match was found
	* bot_id - A unique identifier if a the request was found to likely be a login hack bot. Empty if no bot was found.

API Function:
$ds->full_email_password_lookup(email, password);
*/

echo ("\nFull E-Mail and Password Lookup(Pro):\n");
print_r($ds->full_email_password_lookup('foo@foo.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413'));

// E-Mail and Encrypted Password Lookup
/*
Description: This call checks a submitted hash against passwords known for an e-mail addresss
When to use: This call is intended to be used to access risk to already stored passwords associated with an e-mail address. (ie: regular password scrubs)
API URL: https://api.darksources.com/v1/pro_eh/

Required fields:
	* api_key - Your API key from your access subscription
	* email - The plain text or SHA1 hash of the e-mail address to be looked up
	* hash_type - The hash type the password hash is encoded with. Please refer to the library for allowed hash types
	* hash - The password hash to query against

Optional fields:
	* salt - If the hash is salted and the salt is external then submit it here.

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [email] => f4b0ace4e24d84fef265f4ca7242562bdfeb8937
            [email_known] => 1
            [ep_query_count] => 0
            [password_match] => 1
            [p_query_count] => 0
        )
)

Data Fields:
	* email - The SHA1 hash of the e-mail address queried
	* email_known - 1 means the address is known to our database while 0 means there wasn't a match
	* ep_query_count - The number of customers that have queried both the matching e-mail and password 
	* password_match - 1 means the password inside the submitted hash matches one known to hackers while 0 means no match was found
	* p_query_count - The number of customers that have queried the matching password


API Function:
$ds->email_hash_lookup(email, hash_type, hash, salt);
*/

echo ("\nE-Mail Hash Lookup(Pro):\n");
print_r($ds->email_hash_lookup('foo@foo.com', 'e10adc3949ba59abbe56e057f20f883e'));

// API Status Lookup
/*
Description: This call pulls information for the current plan. 
When to use: Anytime plan information is required.
API URL: https://api.darksources.com/v1/pro_keystats/

Note: This query is free

Required fields:
	* api_key - Your API key from your access subscription

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
            [next_rebill] => 2018-11-03
            [plan_monthly_queries] => 60
            [plan_overage_price] => 1.35
            [plan_overage_queries] => 15
            [queries_left_before_rebill] => 20
        )

)

Data Fields:
	* next_rebill - The date the plan is set to rebill and reset monthly plan query counts
	* plan_monthly_queries - The number of total queries plan is given each month
	* plan_overage_price - The price of overages for the key plan (please note overages are autobilled at 90% usage to allow volume bursts)
	* plan_overage_queries - The number of queries added per overage charge
	* queries_left_before_rebill - The number of queries left for key

API Function:
$ds->keystats();
*/

echo ("\nAPI Plan Stats(Pro):\n");
print_r($ds->keystats());


// Bot 
/*
Description: This call submits information for the purpose of password bot protection.
When to use: At login and registration page submissions.
API URL: https://api.darksources.com/v1/pro_botsubmit/

Note: This query is free
Special thanks to WebIron (https://www.webiron.com/) for licensing a light version of their technology to help control the credential stuffing bots. We _HIGHLY_ recommend their full filtering service.

Required fields:
	* api_key - Your API key from your access subscription

Output:
Array
(
    [status_code] => 0
    [status_msg] => OK
    [data] => Array
        (
        )

)

Data Fields:
	N/A

API Function:
$ds->bot_check_submit();
*/

echo ("\nBot Info Submit(Pro):\n");
print_r($ds->bot_check_submit());
?>
