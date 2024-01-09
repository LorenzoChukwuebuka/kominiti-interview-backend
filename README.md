 # Getting Started

-   ### Step 1: Clone the repository <br>

    On your terminal and in your preferred folder, run `https://github.com/LorenzoChukwuebuka/kominiti-interview-backend`

    If you don't have git installed in your local system 

    
-   ### Step 2: Install the dependencies <br>

    Navigate into the cloned project directory and install the laravel dependencies using `composer install`.  <br>
    If you don't have composer installed. Kindly install PHP and Composer. 

-   ### Step 3: Copy and update environment variables <br>

     from the .env.example copy to  the environment variables from the example .env file

-   ### Step 4: Generate APP_KEY  <br>

    Run `php artisan key:generate` to generate the key which will be copied instantly to the .env file and then run 

    ### Step 5:  Setup Database
    Make sure that you have an RDBMS installed MYSQL,PGSQL OR SQLITE

    in the .env section update the following variables with your own settings
    
     DB_CONNECTION=mysql <br>
     DB_HOST=127.0.0.1 <br>
     DB_PORT=3306 <br>
     DB_DATABASE=interview_app <br>
     DB_USERNAME=root <br>
     DB_PASSWORD=   <br>

     then run `php artisan migrate` to migrate the database tables 

    
     ### 7: Test

     ## NB: 

       I am not so good with integration tests. I tried learning it for the purpose of this interview.<br>

    
