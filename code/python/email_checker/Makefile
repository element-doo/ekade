
all:
	@echo "Usage: make [server|devserver|test|testreport|install]"

server:
	gunicorn -w4 email_checker.wsgi:application -b 0.0.0.0:8000

devserver:
	python manage.py runserver 0.0.0.0:8000

test:
	coverage run --source=checker manage.py test \
		--settings=email_checker.settings.test checker

testreport:
	coverage report

install:
	pip install -r requirements.txt
