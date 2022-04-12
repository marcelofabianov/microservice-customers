alias ms.="cat .docker/alias.sh"
alias ms.l="source .docker/alias.sh"
alias ms.bash="docker exec -it microservice_account_php /bin/bash"
alias ms.exec="docker exec microservice_account_php"
alias ms.php="ms.exec php"
alias ms.composer="ms.exec composer"
alias ms.art="ms.php artisan"
alias ms.rmigrate="ms.art migrate:refresh"
alias ms.cache="ms.art config:cache && ms.art route:cache && ms.art view:cache && ms.art event:cache"
alias ms.clear="ms.art cache:clear && ms.art route:clear && ms.art view:clear && ms.art config:clear && ms.art event:clear"
alias ms.t="ms.php vendor/bin/phpunit --colors=always tests"
alias ms.containers="docker container ls | grep ms."
alias ms.refresh="docker-compose down && docker-compose up -d"
alias ms.logs="docker-compose logs"
alias ms.route="ms.art route:list"
alias ms.watch="docker-compose up"
alias ms.up="ms.watch -d"
alias ms.down="docker-compose down"
alias ms.tup="ms.up && ms.test"
alias ms.stop="docker stop $(docker ps -q)"
alias ms.phpcs="ms.exec ./vendor/bin/phpcs --standard=PSR2"
alias ms.phpcbf="ms.exec ./vendor/bin/phpcbf --standard=PSR2"
alias ms.git.add="ms.phpcbf app && clear && git add . && git status"
alias ms.du=" ms.composer dump-autoload"
alias ms.token="ms.art passport:install"
alias ms.git="git log --graph --oneline --decorate"