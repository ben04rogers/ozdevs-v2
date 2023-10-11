# Reverse Job Board for Developers in Australia

OzDevs is a reverse job board for developers in Australia! This platform is designed to help software developers find jobs in the tech industry across Australia.

## Features

- Developer Profiles: Create detailed developer profiles with your location, bio, skills, experience, and contact information
- Messaging System: Communicate with potential employers within the platform.
- Search Profiles: Filter developer profiles by keywords, state, and experience level.

## Getting Started

### Installation

1. Clone this repository to your local machine:

```sh
git clone https://github.com/your-repo-name.git
```        

2. Install project dependencies using Composer:

```
composer install
```

3. Create a copy of the .env.example file and name it .env:

```
cp .env.example .env
```

3. Generate a unique application key:
   
```
php artisan key:generate
```

4. Update the .env file with your database configuration. Set the DB_DATABASE, DB_USERNAME, and DB_PASSWORD to match your local database setup
   
6. Run database migrations to create the necessary tables:
   
```
php artisan migrate
```

### Running the Application

1. Run the backend

```
php artisan serve
```

2. Compile and bundle front end assets

```
npm run dev
```

