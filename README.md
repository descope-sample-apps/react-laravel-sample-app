# React Laravel Sample App

This project is a sample of using Laravel as a backend for a project using Descope. 
Laravel is a PHP web application framework so this uses our PHP SDK.

## Configure Environment Variables

Create react-client/.env from react-client/.env.example and set the REACT_APP_DESCOPE_PROJECT_ID to the ID of your project found in the [Descope Console](https://app.descope.com/settings/project).

Create server/.env from server/.env.example and set the DESCOPE_PROJECT_ID to the ID of your project found in the [Descope Console](https://app.descope.com/settings/project). If you want to use management functions provided by the SDK, create a management key in the [Company](https://app.descope.com/settings/company/managementkeys) page of the Console and also include it in the .env file.

## Running the App Locally

### Start Client

```sh title='Terminal'
cd react-client
npm start
```

### Start Server
```sh title='Terminal'
cd server
composer run dev
```

## Included Server Endpoints
These endpoints have been built already for the sample app, used for session validation and some basic management functions
- /verify: used for session management, validates the user's JWT by using their session token
- /create: used for user management, can create a new user in the project (Requires Management Key)
- /delete: used for user management, deletes an existing user in the project (Requires Management Key)

### Additional Resources
Read more about setting up the SDK [here](https://docs.descope.com/getting-started/php) and read more about available management functions [here](https://docs.descope.com/management). You can also view the Github repository of the [PHP SDK](https://github.com/descope/descope-php) for more information.


