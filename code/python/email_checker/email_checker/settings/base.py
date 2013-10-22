import os.path

ROOT_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', '..'))
def ABS_PATH(*path):
    return os.path.abspath(os.path.join(ROOT_DIR, *path))

DEBUG = False
TEMPLATE_DEBUG = DEBUG

ADMINS = (
    ('Senko Rasic', 'senko.rasic@goodcode.io'),
)

MANAGERS = ADMINS

import dj_database_url

DATABASES = {
    'default': dj_database_url.config(default='sqlite://:memory:')
}

ALLOWED_HOSTS = []
TIME_ZONE = 'Europe/Zagreb'
LANGUAGE_CODE = 'en-us'
SITE_ID = 1
USE_I18N = False
USE_L10N = False
USE_TZ = False

MEDIA_ROOT = ABS_PATH('media')
MEDIA_URL = '/media/'
STATIC_ROOT = ABS_PATH('static')
STATIC_URL = '/static/'
STATICFILES_DIRS = (
)

STATICFILES_FINDERS = (
    'django.contrib.staticfiles.finders.FileSystemFinder',
    'django.contrib.staticfiles.finders.AppDirectoriesFinder',
)

SECRET_KEY = 'o9o1br26s7bzr*^o56ck=h=89zeo$yv3i4b7)y0&=d_%xl#@nc'

TEMPLATE_LOADERS = (
    'django.template.loaders.filesystem.Loader',
    'django.template.loaders.app_directories.Loader',
)

MIDDLEWARE_CLASSES = (
    'django.middleware.common.CommonMiddleware',
    'django.contrib.sessions.middleware.SessionMiddleware',
    'django.middleware.csrf.CsrfViewMiddleware',
    'django.contrib.auth.middleware.AuthenticationMiddleware',
    'django.contrib.messages.middleware.MessageMiddleware',
)

ROOT_URLCONF = 'email_checker.urls'
WSGI_APPLICATION = 'email_checker.wsgi.application'
TEMPLATE_DIRS = (
)

INSTALLED_APPS = (
    'django.contrib.auth',
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.sites',
    'django.contrib.messages',
    'django.contrib.staticfiles',
    'checker'
)

SESSION_SERIALIZER = 'django.contrib.sessions.serializers.JSONSerializer'

LOGGING = {
    'version': 1,
    'disable_existing_loggers': False,
    'filters': {
        'require_debug_false': {
            '()': 'django.utils.log.RequireDebugFalse'
        }
    },
    'handlers': {
        'mail_admins': {
            'level': 'ERROR',
            'filters': ['require_debug_false'],
            'class': 'django.utils.log.AdminEmailHandler'
        }
    },
    'loggers': {
        'django.request': {
            'handlers': ['mail_admins'],
            'level': 'ERROR',
            'propagate': True,
        },
    }
}
