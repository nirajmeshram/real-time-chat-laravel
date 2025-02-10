
# Real-Time Chat Application (Laravel)

This is a Real-Time Chat Application built with Laravel, utilizing Laravel Reverb for real-time broadcasting and Laravel Echo for listening to events on the client side. Users can register, log in, and start chatting by clicking the "Let's Chat" button. The application functions as a group chat, allowing users to communicate with each other in real time

## Installation & Setup

Follow these steps to set up the project on your local machine.

### 1. Clone the Repository
```sh
git clone https://github.com/your-username/real-time-chat-laravel.git
cd real-time-chat-laravel
```

### 2. Install Dependencies
#### Install PHP Dependencies:
```sh
composer install
```

#### Install JavaScript Dependencies:
```sh
npm install
npm run dev
```

### 3. Configure the Environment
Copy the `.env.example` file to `.env`:
```sh
cp .env.example .env
```
Then, generate the application key:
```sh
php artisan key:generate
```

### 4. Set Up Database & Migrations
Ensure you have a database configured in your `.env` file, then run:
```sh
php artisan migrate
```

### 5. Configure Broadcasting (Reverb)
Make sure your `.env` file includes the correct configuration for broadcasting:
```env
BROADCAST_DRIVER=reverb

REVERB_CONNECTION=pusher
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
```
> **Note:** Replace `your_app_id`, `your_app_key`, `your_app_secret`, and `your_cluster` with your actual Pusher credentials or Reverb settings.

### 6. Start the Application
Start the Laravel development server:
```sh
php artisan serve
```

Start Reverb for real-time communication:
```sh
php artisan reverb:start
```

## Additional Notes
- Ensure your `.env` file has the correct Reverb configuration.
- If you face any issues, try clearing the config cache:
  ```sh
  php artisan config:clear
  php artisan cache:clear
  ```

## License
This project is open-source and available under the [MIT License](LICENSE).

