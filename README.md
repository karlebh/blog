 
## Blog

Blog is a social media built with laravel with best practices in mind. It is constantly being updated with new and exicting features.

Blog's functionalities include:

- User's Registration and login
- User's Profile
- Post Categories
- Comment and Reply System
- View Counter
- Mailing System
- Favourite or Like System
- Search with TntSearch
- Stripe's Payment Gateway (Coming Soon)
- Notifications
- Friendship System
- Admin System (Coming Soon)
- Follow and Unfollow System 
- Queue System
- Laravel Broadcasting
- Vue and Vue Component
- PHPunit Tests (Updating)

I will update it with new features as frequently as I can.

## Important

Blog should only be used for learning purposes.

## Installation

- Install (Update) the composer dependencies\
	`composer install`

- Install node modules\
	`npm install`

- Setup database

- Setup mailing system

- Install Laravel Scout

- Install your favourite search provider, in my case I used tnt_search. You could use Algolia, or just search you database without any search provider. Setup the `SCOUT_DRIVER` environment variable if you are using one.

- Install Pusher and setup it's environment variable.

- Install and Setup Stripe's environment variables, in my case, I used Cashier.

- Install the UI and Authentication Scalfolding.\
	`php artisan ui vue`\
	`php artisan ui auth`

- Install npm\
	`npm install && npm run dev`

- To seed it, use factory (Optional).

- Learn! 


