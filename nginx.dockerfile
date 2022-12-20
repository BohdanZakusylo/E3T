FROM nginx:latest

COPY nginx.conf /etc/nginx/conf.d/app.conf
COPY ../E3T%202 /app/