Requirements:
    Docker  
    PHP (incl. req ext)  
    Composer  
    Node & NPM  
    Docker-compose  

Breakdown:  
    backend folder = Laravel API thats interacting with the PHP SDK Client  
    frontend folder = Vue SPA to display teacher schedules dynamically  
    project is containerised using docker, and the entire stack can be spun up with docker-compose

Makefile:  
    To set-up utilise the make commands from makefile, make set-up will get you started. The makefile is also set-up for running the tests for frontend and backend.
