import os
os.environ.setdefault("DJANGO_SETTINGS_MODULE", "email_checker.settings")
from django.core.wsgi import get_wsgi_application
application = get_wsgi_application()
