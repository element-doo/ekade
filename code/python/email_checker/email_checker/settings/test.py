from .base import *

DEBUG = False
TEMPLATE_DEBUG = DEBUG

CACHES = {
    'default': {
        'BACKEND': 'django.core.cache.backends.dummy.DummyCache',
    }
}
