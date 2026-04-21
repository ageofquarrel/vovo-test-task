Локальный запуск

1. Выполните docker compose up -d --build и дождитесь сборки образа приложения и запуска контейнеров.
2. docker compose exec app php artisan key:generate если в .env пустой APP_KEY.
3. docker compose exec app php artisan migrate для применения миграций.
4. docker compose exec app php artisan db:seed для заполнения базы тестовыми данными.
5. Эндпоинт списка товаров: GET http://localhost:8000/api/goods с обязательными параметрами запроса page и items_per_page.
