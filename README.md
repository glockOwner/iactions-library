Перед запуском проекта необходимо установить:
* docker-desktop или docker и docker-compose

**Для развертывания проекта необходимо скачать проект в папку с названием "***iactions-library***" запустить bash-скрипт ```bash deploy-project.sh```**

Если в конце процесса выполнения скрипта появилась ошибка psql: error: connection to server on socket "/var/run/postgresql/.s.PGSQL.5432" failed: No such file or directory, Нужно запустить скрипт повторно

Скрипт деплоя загрузит дамп БД с тестовыми данными.

Проект работает на домене **localhost:88**
